<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * 其他通用基类Controller
 */
class PublicBaseController extends BaseController{
    /**
     * 初始化方法
     */
    public function _initialize(){
        parent::_initialize();
        // 分配常用数据
        $assign=array(
            'categorys'=>D('Category')->getAllData(),
            'tags'=>D('Tag')->getAllData(),
            'links'=>D('Link')->getDataByState(0,1),
            );
        $this->assign($assign);

    }




}

