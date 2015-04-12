<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
class IndexController extends HomeBaseController {
    // 定义categorys和tags数据
    private $categorys;
    private $tags;

    // 构造函数 实例化Category、Tag
    public function __construct(){
        parent::__construct();
        $this->categorys=D('Category')->getAllData();
        $this->tags=D('Tag')->getAllData();
    }

    // 显示首页
    public function index(){
    	$articles=D('Article')->getPageData();

    	$this->assign('categorys',$this->categorys);
    	$this->assign('tags',$this->tags);
    	$this->assign('articles',$articles['data']);
    	$this->assign('page',$articles['page']);
        $this->display();
    }

    // 显示分类页
    public function category(){
        $cid=I('get.cid',0,'intval');
        $articles=D('Article')->getPageData($cid);

        $this->assign('categorys',$this->categorys);
        $this->assign('tags',$this->tags);
        $this->assign('articles',$articles['data']);
        $this->assign('page',$articles['page']);
        $this->display();
    }

    // 显示标签页
    public function tag(){
        $tid=I('get.tid',0,'intval');
        $articles=D('Article')->getPageData('all',$tid);
        $tname=D('Tag')->getFieldByTid($tid,'tname');

        $this->assign('categorys',$this->categorys);
        $this->assign('tags',$this->tags);
        $this->assign('tname',$tname);
        $this->assign('articles',$articles['data']);
        $this->assign('page',$articles['page']);
        $this->display();
    }

    // 显示文章内容页
    public function article(){
        $aid=I('get.aid',0,'intval');
        $article=D('Article')->getDataByAid($aid);

        $this->assign('categorys',$this->categorys);
        $this->assign('tags',$this->tags);
        $this->assign('tname',$tname);
        $this->assign('article',$article);
        $this->display();
    }



}