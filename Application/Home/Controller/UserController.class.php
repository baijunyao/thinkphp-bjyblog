<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
class UserController extends HomeBaseController {
	// 定义数据
	private $db;

	// 构造函数 实例化OauthUser
	public function __construct(){
		parent::__construct();
		$this->db=D('OauthUser');
	}

	// 第三平台登陆
	public function oauth_login(){
		$data=I('post.');
		$user_data=$this->db->getDataByOpenid($data['openid']);
		if(empty($user_data)){
			$id=$this->db->addData();
		}else{
			$id=$this->db->editData();
		}
		$data['id']=$id;
		$user_info=array(
			'id'=>$data['id'],
			'head_img'=>$data['head_img'],
			'nickname'=>$data['nickname'],
			);
		session('user',$user_info);
	}

	// 第三方平台推出
	public function logout(){
		session('user',null);
	}
}