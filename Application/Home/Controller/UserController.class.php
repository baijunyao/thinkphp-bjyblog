<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
class UserController extends HomeBaseController {

	// 第三方平台登陆
	public function oauth_login(){
		$type=I('get.type');
		import("ORG.ThinkSDK.ThinkOauth");
		$sdk=\ThinkOauth::getInstance($type);
		redirect($sdk->getRequestCodeURL());
	}

	// 第三方平台推出
	public function logout(){
		session('user',null);
		$this->success('退出成功',session('this_url'));
	}

	public function save_login_url(){
		$url=I('post.url');
		session('this_url',$url);
	}



}