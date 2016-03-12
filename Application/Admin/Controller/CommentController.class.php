<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 评论管理
 */
class CommentController extends AdminBaseController{
    // 定义数据
    private $db;

    public function __construct(){
        parent::__construct();
        $this->db=D('Comment');
    }

    // 评论列表
    public function index(){
        $data=$this->db->getDataByState(0);
        $this->assign($data);
        $this->display();
    }

    // 通过或者取消审核
    public function change_status(){
        $cmtid=I('get.cmtid',0,'intval');
        $status=I('get.status',0,'intval');
        M('Comment')->where(array('cmtid'=>$cmtid))->setField('status',$status);
        $this->success('操作成功');
    }


}



