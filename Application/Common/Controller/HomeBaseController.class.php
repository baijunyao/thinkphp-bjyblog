<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * 前台基类Controller
 */
class HomeBaseController extends BaseController{
    /**
     * 初始化方法
     */
    public function _initialize(){
        parent::_initialize();
        if(C('WEB_STATUS')!=1){
            $this->display('Public/web_close');
            die;
        }
        $recommend_map=array(
            'is_show'=>1,
            'is_delete'=>0,
            'is_top'=>1
            );
        $recommend=M('Article')
            ->field('aid,title')
            ->where($recommend_map)
            ->order('aid desc')
            ->select();
        // 分配常用数据
        $assign=array(
            'categorys'=>D('Category')->getAllData(),
            'tags'=>D('Tag')->getAllData(),
            'links'=>D('Link')->getDataByState(0,1),
            'recommend'=>$recommend
            );
        $this->assign($assign);
    }




}

