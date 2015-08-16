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
			$this->display('./Template/default/Home/Public/web_close.html');
			die;
		}
		// 分配常用数据
		$assign=array(
			'categorys'=>D('Category')->getAllData(),
			'tags'=>D('Tag')->getAllData(),
			'links'=>D('Link')->getDataByState(0,1),
			);
		$this->assign($assign);
	}




}

