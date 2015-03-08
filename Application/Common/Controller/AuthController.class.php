<?php  
namespace Common\Controller;
use Think\Controller;

class AuthController extends Controller{
	public function __construct(){
		parent::__construct();
		if(isset($_SESSION['admin'])){
			$this->error('请登录');
		}
	}
}




?>