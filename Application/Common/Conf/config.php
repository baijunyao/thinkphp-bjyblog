<?php
return array(

//*********************************附加设置***********************************
    'SHOW_PAGE_TRACE'       =>  false,                        //关闭Trace信息
    'TAGLIB_BUILD_IN'       =>  'Cx,Common\Tag\My',           //加载自定义标签
    'LOAD_EXT_CONFIG'       =>  'db,webconfig,oauth',         //加载网站设置文件
    'TMPL_PARSE_STRING'     =>  array(                        //定义常用路径
        '__HOME_CSS__'      =>  __ROOT__.trim(TMPL_PATH,'.').'Home/Public/css',
        '__HOME_JS__'       =>  __ROOT__.trim(TMPL_PATH,'.').'Home/Public/js',
        '__HOME_IMAGE__'    =>  __ROOT__.trim(TMPL_PATH,'.').'Home/Public/image',
        '__ADMIN_CSS__'     =>  __ROOT__.trim(TMPL_PATH,'.').'Admin/Public/css',
        '__ADMIN_JS__'      =>  __ROOT__.trim(TMPL_PATH,'.').'Admin/Public/js',
        '__ADMIN_IMAGE__'   =>  __ROOT__.trim(TMPL_PATH,'.').'Admin/Public/image',
    ),
//***********************************URL设置*********************************
    'MODULE_ALLOW_LIST'     =>  array('Home','Admin','Api'),  //允许访问列表
    'TMPL_EXCEPTION_FILE'   =>  APP_DEBUG ? THINK_PATH.'Tpl/think_exception.tpl' : './Template/default/Home/Public/404.html',                                    //404设置
//***********************************SESSION设置*****************************
    'SESSION_OPTIONS'       =>  array(
        'name'              =>  'BJYSESSION',                 //设置session名
        'expire'            =>  24*3600*15,                   //SESSION保存15天
        'use_trans_sid'     =>  1,                            //跨页传递
        'use_only_cookies'  =>  0,                            //是否只开启基于cookies的session的会话方式
    ),
//***********************************URL*************************************
    'URL_MODEL'             =>  1,                            // 为了兼容性更好而设置成1 如果确认服务器开启了mod_rewrite 请设置为 2
    'URL_CASE_INSENSITIVE'  =>  false,                        // 区分url大小写
//***********************************其他设置*********************************
    'THINK_INFORMATION'     =>  '1.1',                        // bjyblog版本
);
