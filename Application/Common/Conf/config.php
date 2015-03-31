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
//*************************************数据库设置结束**************************************
    'TAGLIB_BUILD_IN'       =>  'cx,Common\Tag\My',//加载自定义标签
	'LOAD_EXT_CONFIG'       =>  'webconfig',       //加载网站设置文件
	// 'DEFAULT_THEME'  		=>  'default',         //默认主题
	// 'TMPL_DETECT_THEME'		=>  true,              // 自动侦测模板主题
	
);