<?php
namespace Admin\Controller;
use Common\Controller\PublicBaseController;
/**
 * 后台登陆
 */
class LoginController extends PublicBaseController{
    // 登陆页面
    public function login(){
        // 判断第三方登陆账号中是否有admin
        $oauth_has_admin=M('Oauth_user')->where(array('is_admin'=>1))->count();
        // 如果有第三方账号有admin  则要求用第三方登陆 否则用常规登陆
        if ($oauth_has_admin) {
            die('请在前台页面通过第三方账号登陆');
        }
        if(IS_POST){
            $data=I('post.');
            if(check_verify($data['verify'])){
                $password=M('config')->getFieldByName('ADMIN_PASSWORD','value');
                if(md5($data['ADMIN_PASSWORD'])==$password){
                    session('admin','is_login');
                    session('ADMIN_PASSWORD',null);
                    $this->success('登陆成功',U('Admin/Index/index'));
                }else{
                    $this->success('密码输入错误',U('Admin/Login/login'));
                }
            }else{
                session('ADMIN_PASSWORD',$data['ADMIN_PASSWORD']);
                $this->success('验证码输入错误',U('Admin/Login/login'));
            }

        }else{
            $this->display();
        }
    }

    // 退出登录
    public function logout(){
        session('admin',null);
        $this->success('退出成功',U('Admin/Login/login'));
    }

    // 生成验证码
    public function showVerify(){
        show_verify();
    }

}
