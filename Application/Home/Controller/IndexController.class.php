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
    	$articles=D('Article')->getPageData('all','all',1,0,1);
        $assign=array(
            'articles'=>$articles['data'],
            'page'=>$articles['page'],
            );
        // p($assign);die;
        // p(D('Link')->getDataByState(0,1));
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
            'tname'=>$tname,
            );
        $this->assign($assign);
        $this->display();
    }

    // 显示文章内容页
    public function article(){
        $aid=I('get.aid',0,'intval');
        $article=D('Article')->getDataByAid($aid);
        $this->assign('article',$article);
        $this->display();
    }



}