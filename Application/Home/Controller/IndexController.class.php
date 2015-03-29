<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    // 显示首页
    public function index(){
    	$categorys=D('Category')->getAllData();
    	$tags=D('Tag')->getAllData();
    	$articles=D('Article')->getPageData();

    	$this->assign('categorys',$categorys);
    	$this->assign('tags',$tags);
    	$this->assign('articles',$articles['data']);
    	$this->assign('page',$articles['page']);
        $this->display();
    }

    // 显示分类页
    public function category(){
        $cid=I('get.cid',0,'intval');
        $categorys=D('Category')->getAllData();
        $tags=D('Tag')->getAllData();
        $articles=D('Article')->getPageData($cid);

        $this->assign('categorys',$categorys);
        $this->assign('tags',$tags);
        $this->assign('articles',$articles['data']);
        $this->assign('page',$articles['page']);
        $this->display();
    }

    // 显示标签页
    public function tag(){
        $tid=I('get.tid',0,'intval');
        $categorys=D('Category')->getAllData();
        $tags=D('Tag')->getAllData();
        $tname=D('Tag')->getDataByTid($tid,'tname');
        $articles=D('Article')->getPageData('all',$tid);

        $this->assign('categorys',$categorys);
        $this->assign('tags',$tags);
        $this->assign('tname',$tname);
        $this->assign('articles',$articles['data']);
        $this->assign('page',$articles['page']);
        $this->display();
    }




}