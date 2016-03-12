<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * 后台基类Controller
 */
class AdminBaseController extends BaseController{
    /**
     * 初始化方法
     */
    public function _initialize(){
        parent::_initialize();
        if(session('admin')!='is_login'){
            // 判断第三方登陆账号中是否有admin
            $oauth_has_admin=M('Oauth_user')->where(array('is_admin'=>1))->count();
            // 如果有第三方账号有admin  则要求用第三方登陆 否则用常规登陆
            if ($oauth_has_admin) {
                die('请在前台页面通过第三方账号登陆');
            }else{
                redirect(U('Admin/Login/login'));
            }
        }
    }


}

