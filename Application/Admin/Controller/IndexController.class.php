<?php  
namespace Admin\Controller;
use Common\Controller\AuthController;
/**
 * 后台首页
 */
class IndexController extends AuthController{
	// 后台首页
	public function index(){
		$this->display();
	}
	// 欢迎页面
	public function welcome(){
		$this->display();
	}

}




?>