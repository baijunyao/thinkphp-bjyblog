<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 后台登陆
 */
class UserController extends Controller{
	// 登陆页面
	public function login(){
		if(IS_POST){
			$password=M('config')->getFieldByName('ADMIN_PASSWORD','value');
			if($_POST['ADMIN_PASSWORD']==$password){
				$_SESSION['admin']='admin';
				$this->success('登陆成功',U('Admin/Index/index'));
			}else{
				$this->error('密码输入错误');
			}
		}else{
			$this->display();
		}
	}

}