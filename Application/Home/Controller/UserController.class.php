<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
class UserController extends HomeBaseController {

	// 第三方平台登陆
	public function oauth_login(){
		$type=I('get.type');
		import("Org.ThinkSDK.ThinkOauth");
		$sdk=\ThinkOauth::getInstance($type);
		redirect($sdk->getRequestCodeURL());
	}

	// 第三方平台退出
	public function logout(){
		session('user',null);
		if(session('?this_url')){
			redirect(session('this_url'));
		}else{
			redirect(U('Home/Index/index'));
		}
	}

	// 保存登陆或者退出时的url
	public function save_login_url(){
		$url=I('post.url');
		session('this_url',$url);
	}

	// 判断是否登陆
	public function check_login(){
		if(isset($_SESSION['user']['id'])){
			echo 1;
		}else{
			echo 0;
		}
	}


}
