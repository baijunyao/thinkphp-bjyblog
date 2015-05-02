<?php  
namespace Common\Controller;
use Think\Controller;

class AdminBaseController extends Controller{
	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['session_status'])){
			$lifeTime = 3600;
			session_set_cookie_params($lifeTime);
			session('[start]');
			session('session_status',1);
		}
		if(session('admin')!='is_login'){
			redirect(U('Admin/Login/login'));
		}
	}


	
}

