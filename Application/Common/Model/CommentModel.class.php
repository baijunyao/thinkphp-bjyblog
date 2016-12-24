<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
* 评论model
*/
class CommentModel extends BaseModel{
    private $child=array();

    /**
     * 添加数据
     * @param integer $type 1：文章评论
     */
    public function addData($type){
        $data=I('post.');
        $ouid=$_SESSION['user']['id'];
        $nickname=$_SESSION['user']['nickname'];
        $is_admin=M('Oauth_user')->getFieldById($ouid,'is_admin');
        $data['content']=htmlspecialchars_decode($data['content']);
        // 删除除img外的其他标签
        $comment_content=trim(strip_tags($data['content'],'<img>'));
        $content=htmlspecialchars($comment_content);
        if (empty($content)) {
            return false;
        }
        $comment=array(
            'ouid'=>$ouid,
            'type'=>$type,
            'aid'=>$data['aid'],
            'pid'=>$data['pid'],
            'content'=>$content,
            'date'=>time(),
            'status'=>1
            );
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        // 如果用户输入邮箱；则将邮箱记录入oauth_user表中
        if (preg_match($pattern, $data['email'])) {
            D('Oauth_user')->where(array('id'=>$_SESSION['user']['id']))->setField('email',$data['email']);
        }
        // 添加数据
        $cmtid=$this->add($comment);

        // 给站长发送通知邮件
        if(C('COMMENT_SEND_EMAIL') && $is_admin==0){
            $address=C('EMAIL_RECEIVE');
            if(!empty($address)){
                $title=M('Article')->getFieldByAid($data['aid'],'title');
                $url=U('Home/Index/article',array('aid'=>$data['aid']),'',true);
                $date=date('Y-m-d H:i:s');
                $content=<<<html
站长你好：<br>
&emsp; $nickname $date 评论了您的文章 <a href="$url">$title</a> 内容如下:<br>
$comment_content

html;
                send_email($address,$nickname.'评论了 '.$title,$content);
            }
        }
        // 给用户发送邮件通知
        if (C('COMMENT_SEND_EMAIL') && $data['pid']!=0) {
            $parent_uid=$this->getFieldByCmtid($data['pid'],'ouid');
            $parent_data=M('Oauth_user')->field('nickname,email')->find($parent_uid);
            $parent_address=$parent_data['email'];
            if (!empty($parent_address)) {
                $parent_name=$parent_data['nickname'];
                $title=M('Article')->getFieldByAid($data['aid'],'title');
                $url=U('Home/Index/article',array('aid'=>$data['aid']),'',true);
                $date=date('Y-m-d H:i:s');
                $parent_content=<<<html
$parent_name你好：<br>
&emsp; $nickname $date 回复了您对 <a href="$url">$title</a> 的评论  内容如下:<br>
$comment_content

html;
                send_email($parent_address,$nickname.'回复了 '.$title,$parent_content);                
            }

        }
        return $cmtid;
    }

    /**
     * 获取分页数据供后台使用
     * @param  int   是否删除
     * @return array 评论数据
     */
    public function getDataByState($is_delete){
        $count=$this
            ->alias('c')
            ->join('__ARTICLE__ a ON a.aid=c.aid')
            ->join('__OAUTH_USER__ ou ON ou.id=c.ouid')
            ->where(array('c.is_delete'=>$is_delete))
            ->count();
        $page=new \Org\Bjy\Page($count,15);
        $list=$this
            ->field('c.*,a.title,ou.nickname')
            ->alias('c')
            ->join('__ARTICLE__ a ON a.aid=c.aid')
            ->join('__OAUTH_USER__ ou ON ou.id=c.ouid')
            ->where(array('c.is_delete'=>$is_delete))
            ->limit($page->firstRow.','.$page->listRows)
            ->order('date desc')
            ->select();
        $data=array(
            'data'=>$list,
            'page'=>$page->show()
            );

        return $data;
    }

    /**
     * 传递文章id获取树状结构的评论
     * @param  int $aid 文章id
     * @return array    树状结构数组
     */
    public function getChildData($aid){
        // 组合where条件
        $status=C('COMMENT_REVIEW') ? array('c.status'=>1) : array();
        $other=array(
            'c.aid'=>$aid,
            'c.pid'=>0,
            'c.is_delete'=>0
            );
        $where=array_merge($status,$other);
        // 关联第三方用户表获取一级评论
        $data=$this
            ->alias('c')
            ->field('c.*,ou.nickname,ou.head_img')
            ->join('__OAUTH_USER__ ou ON c.ouid=ou.id')
            ->where($where)
            ->order('date desc')
            ->select();
        foreach ($data as $k => $v) {
            $data[$k]['content']=htmlspecialchars_decode($v['content']);
            // 获取二级评论
            $this->child=array();
            $this->getTree($v);
            $child=$this->child;
            if(!empty($child)){
                // 按评论时间asc排序
                uasort($child,'comment_sort');
                foreach ($child as $m => $n) {
                    // 获取被评论人id
                    $reply_user_id=$this->getFieldByCmtid($n['pid'],'ouid');
                    // 获取被评论人昵称
                    $child[$m]['reply_name']=D('OauthUser')->getFieldById($reply_user_id,'nickname');
                }
            }
            $data[$k]['child']=$child;
        }
        return $data;
    }
    // 递归获取树状结构
    public function getTree($data){
        $child=$this
            ->field('c.*,ou.nickname,ou.head_img')
            ->alias('c')
            ->join('__OAUTH_USER__ ou ON c.ouid=ou.id')
            ->where(array('pid'=>$data['cmtid']))
            ->select();
        if(!empty($child)){
            foreach ($child as $k => $v) {
                $v['content']=htmlspecialchars_decode($v['content']);
                $this->child[]=$v;
                $this->getTree($v);
            }
        }

    }

    /**
     * 获取最新的评论
     */
    public function getNewComment(){
        // 获取后台管理员
        $uids=M('Oauth_user')
            ->where(array('is_admin'))
            ->getField('id',true);
        // 如果没有设置管理员；显示全部评论
        if (empty($uids)) {
            $map=array(
                'c.is_delete'=>0
                );
        }else{
            // 设置了管理员；则不显示管理员的评论
            $map=array(
                'ou.id'=>array('notin',$uids),
                'c.is_delete'=>0
                );
        }
        $data=$this
            ->field('c.content,c.date,a.title,a.aid,ou.nickname,ou.head_img')
            ->alias('c')
            ->join('__ARTICLE__ a ON c.aid=a.aid')
            ->join('__OAUTH_USER__ ou ON c.ouid=ou.id')
            ->where($map)
            ->order('c.date desc')
            ->limit(20)
            ->select();
        foreach ($data as $k => $v) {
            $data[$k]['date']=word_time($v['date']);
            // 截取文章标题
            $data[$k]['title']=re_substr($v['title'],0,20);
            // 处理有表情时直接截取会把img表情截断的问题
            $content=strip_tags(htmlspecialchars_decode($v['content']));
            if (mb_strlen($content)>10) {
                $data[$k]['content']=re_substr($content,0,40);
            }else{
                $data[$k]['content']=htmlspecialchars_decode($v['content']);
            }
        }
        return $data;
    }


}
