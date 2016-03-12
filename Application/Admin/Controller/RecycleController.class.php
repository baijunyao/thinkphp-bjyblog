<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 回收管理
 */
class RecycleController extends AdminBaseController{
    //空操作 自动载入当前模板
    public function _empty($name){
        $this->display($name);
    }

    // 回收站首页
    public function index(){
        $this->display();
    }

    // 已删文章
    public function article(){
        $data=D('Article')->getPageData('all','all','all',1);
        $this->assign('data',$data['data']);
        $this->assign('page',$data['page']);
        // p($data);die;
        $this->display();
    }

    // 已删评论
    public function comment(){
        $data=D('Comment')->getDataByState(1);
        $this->assign('data',$data['data']);
        $this->assign('page',$data['page']);
        // p($data);
        // die;
        $this->display();
    }

    // 已删友情链接
    public function link(){
        $data=D('Link')->getDataByState(1);
        $this->assign('data',$data);
        // p($data);die;
        $this->display();
    }

    // 已删随言碎语
    public function chat(){
        $data=D('Chat')->getDataByState(1);
        $this->assign('data',$data);
        // p($data);die;
        $this->display();
    }

    // 根据$_GET数组放入回收站
    public function recycle(){
        $data=I('get.');
        M($data['table_name'])->where(array($data['id_name']=>$data['id_number']))->setField('is_delete',1);
        $this->success('放入回收站成功');
    }

    // 根据$_GET数组恢复删除
    public function recover(){
        $data=I('get.');
        M($data['table_name'])->where(array($data['id_name']=>$data['id_number']))->setField('is_delete',0);
        $this->success('恢复成功');
    }

    // 根据$_GET数组彻底删除
    public function delete(){
        $data=I('get.');
        M($data['table_name'])->where(array($data['id_name']=>$data['id_number']))->delete();
        $this->success('删除成功');
    }



}





