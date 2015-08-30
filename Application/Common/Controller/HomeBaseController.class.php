<?php
namespace Common\Controller;
use Think\Controller;

class HomeBaseController extends Controller{
	public function __construct(){
		parent::__construct();
		// 设置session
		if(C('WEB_STATUS')==1){
			if(!isset($_SESSION['session_status'])){
				$lifeTime = 3600;
				session_set_cookie_params($lifeTime);
				session('[start]');
				session('session_status',1);
			}
		}else{
			$this->display('Public/web_close');
			die;
		}
		// 分配常用数据
		$assign=array(
			'categorys'=>D('Category')->getAllData(),
			'tags'=>D('Tag')->getAllData(),
			'links'=>D('Link')->getDataByState(0,1),
			);
		$this->assign($assign);
		// 判断是否开启了rewrite 设置URL_MODEL
		in_array('mod_rewrite', apache_get_modules()) ? C('URL_MODEL',2) : C('URL_MODEL',1);
	}




}

