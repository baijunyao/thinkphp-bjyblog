<?php
namespace Common\Controller;
use Think\Controller;
/**
 * 基类Controller
 */
class BaseController extends Controller{
	/**
	 * 初始化方法
	 */
	public function _initialize(){
		// 判断是否开启session
		if(!isset($_SESSION['session_status'])){
			$lifeTime = 3600;
			session_set_cookie_params($lifeTime);
			session('[start]');
			session('session_status',1);
		}

		// 判断是否开启了rewrite 设置URL_MODEL
		in_array('mod_rewrite', apache_get_modules()) ? C('URL_MODEL',2) : C('URL_MODEL',1);
	}



}

