<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
/**
 * 网站首页
 */
class IndexController extends HomeBaseController {

    // 首页
    public function index(){
        $articles=D('Article')->getPageData();
        $assign=array(
            'articles'=>$articles['data'],
            'page'=>$articles['page'],
            'cid'=>'index'
            );
        $this->assign($assign);
        $this->display();
    }

    // 分类
    public function category(){
        $cid=I('get.cid',0,'intval');
        $articles=D('Article')->getPageData($cid);
        $assign=array(
            'category'=>D('Category')->getDataByCid($cid),
            'articles'=>$articles['data'],
            'page'=>$articles['page'],
            'cid'=>$cid
            );
        $this->assign($assign);
        $this->display();
    }

    // 标签
    public function tag(){
        $tid=I('get.tid',0,'intval');
        $articles=D('Article')->getPageData('all',$tid);
        $tname=D('Tag')->getFieldByTid($tid,'tname');
        $assign=array(
            'articles'=>$articles['data'],
            'page'=>$articles['page'],
            'title'=>$tname,
            'title_word'=>'拥有<span class="b-highlight">'.$tname.'</span>标签的文章',
            'cid'=>'index'
            );
        $this->assign($assign);
        $this->display();
    }

    // 文章内容
    public function article(){
        $cid=I('get.cid',0,'intval');
        $tid=I('get.tid',0,'intval');
        $aid=I('get.aid',0,'intval');
        // 文章点击量+1
        M('Article')->where(array('aid'=>$aid))->setInc('click',1);
        // 获取文章数据
        $search_word=I('get.search_word',0);
        switch(true){
            case $cid==0 && $tid==0 && $search_word==(string)0:
                $map=array();
                break;
            case $cid!=0:
                $map=array('cid'=>$cid);
                break;
            case $tid!=0:
                $map=array('tid'=>$tid);
                break;
            case $search_word!==0:
                $map=array('title'=>$search_word);
                break;
        }
        $article=D('Article')->getDataByAid($aid,$map);
        // 获取评论数据
        $comment=D('Comment')->getChildData($aid);
        $assign=array(
            'article'=>$article,
            'comment'=>$comment,
            'cid'=>$article['current']['cid']
            );
        if (!empty($_SESSION['user']['id'])) {
            $assign['user_email']=M('Oauth_user')->getFieldById($_SESSION['user']['id'],'email');
        }
        $this->assign($assign);
        $this->display();
    }

    // 随言碎语
    public function chat(){
        $assign=array(
            'data'=>D('Chat')->getDataByState(0,1),
            'cid'=>'chat'
            );
        $this->assign($assign);
        $this->display();
    }

    // 站内搜索
    public function search(){
        $search_word=I('get.search_word');
        $search_word=urldecode($search_word);
        $articles=D('Article')->getDataByTitle($search_word);
        $assign=array(
            'articles'=>$articles['data'],
            'page'=>$articles['page'],
            'title'=>$search_word,
            'title_word'=>'搜索到的与<span class="b-highlight">'.$search_word.'</span>相关的文章',
            'cid'=>'index'
            );
        $this->assign($assign);
        $this->display('tag');
    }

    // ajax评论文章
    public function ajax_comment(){
        $data=I('post.');
        if(empty($data['content']) || !isset($_SESSION['user']['id'])){
            die('未登陆,或内容为空');
        }else{
            $cmtid=D('Comment')->addData(1);
            echo $cmtid;
        }
    }

    // 产生一个登陆状态的用户用以测试
    public function test_login(){
        echo 'error';
        die;
        $_SESSION['user']=array(
            'id'=>1,
            'head_img'=>'http://qzapp.qlogo.cn/qzapp/101206152/F16ABCFCE42A66BA9049DA0D95593D19/100',
            'nickname'=>'云淡风晴'
            );
    }

}
