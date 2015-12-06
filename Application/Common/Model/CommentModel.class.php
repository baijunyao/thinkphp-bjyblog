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
		$is_admin=M('Oauth_user')->getFieldById($ouid,'is_admin');
		$data['content']=htmlspecialchars_decode($data['content']);
		// 删除除img外的其他标签
		$comment_content=trim(strip_tags($data['content'],'<img>'));
		if (empty($comment_content)) {
			return false;
		}
		$comment=array(
			'ouid'=>$ouid,
			'type'=>$type,
			'aid'=>$data['aid'],
			'pid'=>$data['pid'],
			'content'=>$comment_content,
			'date'=>time(),
			'status'=>1
			);
		$cmtid=$this->add($comment);
		// 发送通知邮件
		if(C('COMMENT_SEND_EMAIL') && $is_admin==0){
			$address=C('EMAIL_RECEIVE');
			if(!empty($address)){
				$nickname=M('Oauth_user')->getFieldById($ouid,'nickname');
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
		$page=new \Org\Bjy\Page($count,10);
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
			->field('c.*,ou.nickname,ou.head_img')
			->alias('c')
			->join('__OAUTH_USER__ ou ON c.ouid=ou.id')
			->where($where)
			->order('date desc')
			->select();
		foreach ($data as $k => $v) {
			// 删除除img外的其他标签
			$v['content']=htmlspecialchars_decode($v['content']);
			$data[$k]['content']=strip_tags($v['content'],'<img>');
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



}
