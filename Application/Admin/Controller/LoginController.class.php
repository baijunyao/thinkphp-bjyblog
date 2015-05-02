<?php
namespace Admin\Controller;
use Common\Controller\PublicBaseController;
/**
 * 后台登陆
 */
class LoginController extends PublicBaseController{
	// 登陆页面
	public function login(){
		if(IS_POST){
			$data=I('post.');
			if(check_verify($data['verify'])){
				$password=M('config')->getFieldByName('ADMIN_PASSWORD','value');
				if(md5($data['ADMIN_PASSWORD'])==$password){
					session('admin','is_login');
					// p($_SESSION);die;
					$this->success('登陆成功',U('Admin/Index/index'));
				}else{
					$this->error('密码输入错误');
				}
			}else{
				$this->error('验证码输入错误');
			}
			
		}else{
			$this->display();
		}
	}

	// 退出登录
	public function logout(){
		session('admin',null);
		$this->success('退出成功',U('Admin/Login/login'));
	}

	// 生成验证码
	public function showVerify(){
		// $config=
		show_verify();
	}

}