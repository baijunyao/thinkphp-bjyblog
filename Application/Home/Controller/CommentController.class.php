<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
class CommentController extends HomeBaseController {

	// 畅言获取信息接口
	public function user_info(){
		if(session('?name')){
			$data=array(
			'is_login'=>1,
			'user'=>array(
				'img_url'=>session('user.head_img'),
				'nickname'=>session('user.nickname'),
				),
			
			);
		}else{
			$data=array(
			'is_login'=>0,
				);
		}
		
	}
}