<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
/**
* 随言碎语
*/
class ChatController extends HomeBaseController{
	// 首页
	public function index(){
		$assign=array(
			'data'=>D('Chat')->getDataByState(0,1),
			'cid'=>'chat'
			);
		$this->assign($assign);
		$this->display();
	}
}
