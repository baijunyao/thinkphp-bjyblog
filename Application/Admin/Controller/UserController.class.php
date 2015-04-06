<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台登陆
 */
class UserController extends AdminBaseController{

	// 退出
	public function logout(){
		session('admin',null);
		$this->success('退出成功',U('Admin/User/login'));
	}
}