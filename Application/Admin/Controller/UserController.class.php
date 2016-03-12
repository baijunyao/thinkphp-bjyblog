<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台登陆
 */
class UserController extends AdminBaseController{

    // 全部用户
    public function index(){
        $assign=D('OauthUser')->getPageData();
        $this->assign($assign);
        $this->display();
    }

    // 后台用户退出
    public function logout(){
        session('admin',null);
        $this->success('退出成功',U('Admin/User/login'));
    }

    // 标记站长或取消
    public function is_admin(){
        $id=I('get.id');
        $is_admin=I('get.is_admin');
        $is_admin=$is_admin==1 ? 0 : 1;
        $result=M('Oauth_user')->where(array('id'=>$id))->setField('is_admin',$is_admin);
        if ($result) {
            $this->success('操作成功',U('Admin/User/index'));
        }else{
            $this->error('操作失败');
        }
    }


}
