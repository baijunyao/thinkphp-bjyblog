<?php  

namespace Think\Template\TagLib;
use Think\Template\TagLib;

class My extends TagLib {
	protected $tags=array(
		'jquery'=>array('attr'=>'','close'=>0),
		'bjycss'=>array('attr'=>'','close'=>0),
		'bootstrap'=>array('attr'=>'','close'=>0),
		

		);
	//引入jquery
	public function _jquery($tag,$content){
		return '<script type="text/javascript" src="__PUBLIC__/static/jquery-1.7.2.min.js"></script>';
	}
	//引入bootstrap的css组件
	public function _bjycss($tag,$content){
		return '<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/bjy.css">';
	}
	//引入jquery、bootstrap css组件、bootstrap js组件
	public function _bootstrap($tag,$content){
		$link=<<<php
<script type="text/javascript" src="__PUBLIC__/static/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/bootstrap-3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/bootstrap-3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/bjy.css">
<script type="text/javascript" src="__PUBLIC__/static/bootstrap-3.3.2/js/bootstrap.min.js"></script>
php;
		return $link;
	}





}




?>