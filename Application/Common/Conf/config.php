<?php
return array(

//*************************************附加设置**************************************
	'SHOW_PAGE_TRACE' 		=>	false,
    'TAGLIB_BUILD_IN'       =>  'Cx,Common\Tag\My',   //加载自定义标签
	'LOAD_EXT_CONFIG'       =>  'db,webconfig',       //加载网站设置文件
	'TMPL_PARSE_STRING'		=> 	array(			      //定义常用路径
	    '__HOME_CSS__'		=> 	__ROOT__.trim(TMPL_PATH,'.').'Home/Public/css',
	    '__HOME_JS__'		=> 	__ROOT__.trim(TMPL_PATH,'.').'Home/Public/js',
	    '__HOME_IMAGE__'	=> 	__ROOT__.trim(TMPL_PATH,'.').'Home/Public/image',
	    '__ADMIN_CSS__'		=> 	__ROOT__.trim(TMPL_PATH,'.').'Admin/Public/css',
	    '__ADMIN_JS__'		=> 	__ROOT__.trim(TMPL_PATH,'.').'Admin/Public/js',
	    '__ADMIN_IMAGE__'	=> 	__ROOT__.trim(TMPL_PATH,'.').'Admin/Public/image',
	),
//***********************************SESSION设置**************************************
	'SESSION_AUTO_START'    =>  false,				//禁止自动开启session
	'SESSION_OPTIONS'       =>  array(
		'name'				=>	'BJYSESSION',		//设置session名
		// 'domain'			=>	'baijunyao.com',	//设置session作用域
	),

);