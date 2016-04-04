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
        /**
         * 判断是否开启了rewrite 设置URL_MODEL
         * 此处设置的意义在于如果apache开启了rewrite模块；
         * U函数生成的链接不带index.php/
         * 如果没有开启rewrite则U函数生成带index.php的链接
         * 如下是URL_MODEL:1和2时 生成的链接对比
         * URL_MODEL:1  http://localhost/index.php/Home/Index/article/aid/17
         * URL_MODEL:2  http://localhost/article/17
         */
        
        // in_array('mod_rewrite', apache_get_modules()) ? C('URL_MODEL',2) : C('URL_MODEL',1);
        
        /**
         * 因发现一些环境有mod_rewrite模块 
         * 但是AllowOverride设置的为None
         * 所以暂时将上面这行mod_wreite的判断 注释掉了
         * 2016.4.4
         */
    }



}

