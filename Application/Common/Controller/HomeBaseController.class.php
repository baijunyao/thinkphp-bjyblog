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
        // 分配常用数据
        $assign=array(
            'categorys'=>D('Category')->getAllData(),
            'tags'=>D('Tag')->getAllData(),
            'links'=>D('Link')->getDataByState(0,1),
            );
        $this->assign($assign);
    }




}

