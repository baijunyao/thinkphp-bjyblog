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
         */
        in_array('mod_rewrite', apache_get_modules()) ? C('URL_MODEL',2) : C('URL_MODEL',1);
    }



}

