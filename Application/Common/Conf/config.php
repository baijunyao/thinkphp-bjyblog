<?php
return array(
//*************************************数据库设置开始*************************************
    'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  'localhost',  // 服务器地址
    'DB_NAME'               =>  'thinkbjy',   // 数据库名
    'DB_USER'               =>  'root',       // 用户名
    'DB_PWD'                =>  '',           // 密码
    'DB_PORT'               =>  '3306',       // 端口
    'DB_PREFIX'             =>  'bjy_',       // 数据库表前缀
//*************************************附加设置**************************************
    'TAGLIB_BUILD_IN'       =>  'cx,Common\Tag\My',//加载自定义标签
	'LOAD_EXT_CONFIG'       =>  'webconfig',       //加载网站设置文件
	'TMPL_PARSE_STRING'		=> array(			   //定义常用目录
	    '__HOME_CSS__'		=> trim(TMPL_PATH,'.').'Home/Public/css',
	    '__HOME_JS__'		=> trim(TMPL_PATH,'.').'Home/Public/js',
	    '__HOME_IMAGES__'	=> trim(TMPL_PATH,'.').'Home/Public/images',
	    '__ADMIN_CSS__'		=> trim(TMPL_PATH,'.').'Admin/Public/css',
	    '__ADMIN_JS__'		=> trim(TMPL_PATH,'.').'Admin/Public/js',
	    '__ADMIN_IMAGES__'	=> trim(TMPL_PATH,'.').'Admin/Public/images',
		),
//*************************************水印设置****************************************
	'WATER_TYPE'            => '3',           //水印类型 0:不使用水印 1:文字水印 2:图片水印 3:文字和图片水印同时使用
	'TEXT_WATER_WORD'       => 'thinkbjy',    //文字水印内容
	'TEXT_WATER_TTF_PTH'    => './Public/static/font/ariali.ttf',  //文字水印字体路径
	'TEXT_WATER_FONT_SIZE'  => '15',    	  //文字水印文字字号
	'TEXT_WATER_COLOR'      => '#008CBA',     //文字水印文字颜色
	'TEXT_WATER_ANGLE'      => '0',    		  //文字水印文字倾斜程度
	'TEXT_WATER_LOCATE'     => '9',  	      //文字水印位置 1：上左 2：上中 3：上右 4：中左 5：中中 6：中右 7：下左 8：下中 9：下右
	'IMAGE_WATER_PIC_PTAH'	=> './Upload/image/logo/logo.png', //图片水印 水印路径
	'IMAGE_WATER_LOCATE'	=> '9', //图片水印 水印位置 1：上左 2：上中 3：上右 4：中左 5：中中 6：中右 7：下左 8：下中 9：下右
	'IMAGE_WATER_ALPHA'		=> '80', //图片水印 水印透明度：0-100 

);