<?php  
namespace Common\Controller;
use Think\Controller;

class AdminBaseController extends Controller{
	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['admin'])){
			$this->error('请登录',U('Admin/User/Login'));
		}
	}



	
}

