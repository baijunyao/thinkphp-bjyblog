<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$category=D('Category')->getAllData();
    	$tags=D('Tag')->getAllData();
    	$this->assign('category',$category);
    	$this->assign('tags',$tags);
    	// p($category);die;
        $this->display();
    }
}