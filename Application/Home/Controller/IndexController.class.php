<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
class IndexController extends HomeBaseController {

	// 构造函数 实例化Category、Tag
	public function __construct(){
		parent::__construct();
		$assign=array(
			'categorys'=>D('Category')->getAllData(),
			'tags'=>D('Tag')->getAllData(),
			'links'=>D('Link')->getDataByState(0,1),
			);
		$this->assign($assign);
	}

	// 显示首页
	public function index(){
		$articles=D('Article')->getPageData();
		$assign=array(
			'articles'=>$articles['data'],
			'page'=>$articles['page'],
			);
		$this->assign($assign);
		$this->display();
	}

	// 显示分类页
	public function category(){
		$cid=I('get.cid',0,'intval');
		$articles=D('Article')->getPageData($cid);
		$assign=array(
			'category'=>D('Category')->getDataByCid($cid),
			'articles'=>$articles['data'],
			'page'=>$articles['page'],
			);
		$this->assign($assign);
		$this->display();
	}

	// 显示标签页
	public function tag(){
		$tid=I('get.tid',0,'intval');
		$articles=D('Article')->getPageData('all',$tid);
		$tname=D('Tag')->getFieldByTid($tid,'tname');
		$assign=array(
			'articles'=>$articles['data'],
			'page'=>$articles['page'],
			'title'=>$tname,
			'title_word'=>'拥有<span class="highlight">'.$tname.'</span>标签的文章',
			);
		$this->assign($assign);
		$this->display();
	}

	// 显示文章内容页
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
				$map=array('title'=>array('like',"%$search_word%"));
				break;
		}
        $article=D('Article')->getDataByAid($aid,$map);
        // 获取评论数据
        $comment=D('Comment')->getChildData($aid);
        $assign=array(
            'article'=>$article,
            'comment'=>$comment
            );
        $this->assign($assign);
		$this->display();
	}

	// 站内搜索
	public function search(){
		$search_word=I('get.search_word');
		$articles=D('Article')->getDataByTitle($search_word);
		$assign=array(
			'articles'=>$articles['data'],
			'page'=>$articles['page'],
			'title'=>$search_word,
			'title_word'=>'搜索到的与<span class="highlight">'.$search_word.'</span>相关的文章',
			);
		$this->assign($assign);
		$this->display('tag');
	}

	// 随言碎语
	public function chat(){
		$this->assign('data',D('Chat')->getDataByState(0,1));
		$this->display();
	}

	// 文章评论
	function ajax_comment(){
		$data=I('post.');
		if(empty($data['content']) || !isset($_SESSION['user']['id'])){
			die('未登陆,或内容为空');
		}else{
			$cmtid=D('Comment')->addData($type);
            echo $cmtid;
		}
	}


}
