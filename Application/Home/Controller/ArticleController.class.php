<?php 
namespace Home\Controller;
use Think\Controller;

class ArticleController extends Controller{

	// 分类列表
	public function index(){
		$cid=I('get.cid');

		$categorys=D('Category')->getAllData();
    	$tags=D('Tag')->getAllData();
    	$articles=D('Article')->getPageData($cid);

    	$this->assign('categorys',$categorys);
    	$this->assign('tags',$tags);
    	$this->assign('articles',$articles['data']);
    	$this->assign('page',$articles['page']);
		p($articles);
		$this->display();
	}





}








