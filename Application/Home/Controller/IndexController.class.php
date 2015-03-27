<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$categorys=D('Category')->getAllData();
    	$tags=D('Tag')->getAllData();
    	$articles=D('Article')->getIndexPageData();

    	$this->assign('categorys',$categorys);
    	$this->assign('tags',$tags);
    	$this->assign('articles',$articles['data']);
    	$this->assign('page',$articles['page']);
    	// p($articles);die;
        $this->display();
    }
}