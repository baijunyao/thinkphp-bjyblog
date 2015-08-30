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



}
