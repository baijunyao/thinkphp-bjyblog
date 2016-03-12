<?php
namespace Api\Controller;
use Common\Controller\HomeBaseController;

class IndexController extends HomeBaseController{

    public function oauth(){
        $type=I('get.type');
        $code=I('get.code');
        //加载ThinkOauth类并实例化一个对象
        import("Org.ThinkSDK.ThinkOauth");
        $sns  = \ThinkOauth::getInstance($type);
        //腾讯微博需传递的额外参数
        $extend = null;
        if($type == 'tencent'){
            $extend = array('openid' => $this->_get('openid'), 'openkey' => $this->_get('openkey'));
        }
        $token = $sns->getAccessToken($code , $extend);
        //获取当前登录用户信息
        if(is_array($token)){
            // 获取第三方账号数据
            $user_info = $this->$type($token);
            $data=array(
                'uid'=>0,
                'type'=>$user_info['type'],
                'nickname'=>$user_info['nickname'],
                'head_img'=>$user_info['head_img'],
                'openid'=>$token['openid'],
                'access_token'=>$token['access_token'],
                );
            // 获取本地数据库的用户数据
            $user_data=D('OauthUser')->getDataByOpenid($data['openid']);
            // 如果登陆过 则覆盖；没有登陆这添加数据
            if(empty($user_data)){
                $id=D('OauthUser')->addData($data);
            }else{
                $id=D('OauthUser')->editData($data);
            }
            // 组合存session的数据
            $login_info=array(
                'id'=>$id,
                'head_img'=>$data['head_img'],
                'nickname'=>$data['nickname'],
                );
            session('user',$login_info);
            // 如果此账号是admin 则设置后台登陆状态
            if ($user_data['is_admin']==1) {
                session('admin','is_login');
            }
            // 跳转到登陆前的页面
            $_COOKIE['this_url']=empty($_COOKIE['this_url']) ? '/' : cookie('this_url');
            redirect(cookie('this_url'));
        }
    }

    //登录成功，获取腾讯QQ用户信息
    public function qq($token){
        import("Org.ThinkSDK.ThinkOauth");
        $qq   = \ThinkOauth::getInstance('qq', $token);
        $data = $qq->call('user/get_user_info');
        if($data['ret'] == 0){
            $userInfo['type'] = 1;
            $userInfo['name'] = $data['nickname'];
            $userInfo['nickname'] = $data['nickname'];
            $userInfo['head_img'] = $data['figureurl_2'];
            return $userInfo;
        } else {
            throw_exception("获取腾讯QQ用户信息失败：{$data['msg']}");
        }
    }

    //登录成功，获取腾讯微博用户信息
    public function tencent($token){
        import("Org.ThinkSDK.ThinkOauth");
        $tencent = \ThinkOauth::getInstance('tencent', $token);
        $data    = $tencent->call('user/info');
        if($data['ret'] == 0){
            $userInfo['type'] = 'TENCENT';
            $userInfo['name'] = $data['data']['name'];
            $userInfo['nickname'] = $data['data']['nick'];
            $userInfo['head_img'] = $data['data']['head'];
            return $userInfo;
        } else {
            throw_exception("获取腾讯微博用户信息失败：{$data['msg']}");
        }
    }

    //登录成功，获取新浪微博用户信息
    public function sina($token){
        $sina = \ThinkOauth::getInstance('sina', $token);
        $data = $sina->call('users/show', "uid={$sina->openid()}");
        if($data['error_code'] == 0){
            $userInfo['type'] = 2;
            $userInfo['name'] = $data['name'];
            $userInfo['nickname'] = $data['screen_name'];
            $userInfo['head_img'] = $data['avatar_large'];
            return $userInfo;
        } else {
            throw_exception("获取新浪微博用户信息失败：{$data['error']}");
        }
    }

    //登录成功，获取网易微博用户信息
    public function t163($token){
        $t163 = \ThinkOauth::getInstance('t163', $token);
        $data = $t163->call('users/show');
        if($data['error_code'] == 0){
            $userInfo['type'] = 'T163';
            $userInfo['name'] = $data['name'];
            $userInfo['nickname'] = $data['screen_name'];
            $userInfo['head_img'] = str_replace('w=48&h=48', 'w=180&h=180', $data['profile_image_url']);
            return $userInfo;
        } else {
            throw_exception("获取网易微博用户信息失败：{$data['error']}");
        }
    }

    //登录成功，获取人人网用户信息
    public function renren($token){
        $renren = \ThinkOauth::getInstance('renren', $token);
        $data   = $renren->call('user/get');
        if(!isset($data['error'])){
            $userInfo['type'] = 4;
            $userInfo['name'] = $data['response']['name'];
            $userInfo['nickname'] = $data['response']['name'];
            $userInfo['head_img'] = $data['response']['avatar'][3]['url'];
            return $userInfo;
        } else {
            throw_exception("获取人人网用户信息失败：{$data['error_msg']}");
        }
    }

    //登录成功，获取360用户信息
    public function x360($token){
        $x360 = \ThinkOauth::getInstance('x360', $token);
        $data = $x360->call('user/me');
        if($data['error_code'] == 0){
            $userInfo['type'] = 'X360';
            $userInfo['name'] = $data['name'];
            $userInfo['nickname'] = $data['name'];
            $userInfo['head_img'] = $data['avatar'];
            return $userInfo;
        } else {
            throw_exception("获取360用户信息失败：{$data['error']}");
        }
    }

    //登录成功，获取豆瓣用户信息
    public function douban($token){
        $douban = \ThinkOauth::getInstance('douban', $token);
        $data   = $douban->call('user/~me');
        if(empty($data['code'])){
            $userInfo['type'] = 3;
            $userInfo['name'] = $data['name'];
            $userInfo['nickname'] = $data['name'];
            $userInfo['head_img'] = $data['avatar'];
            return $userInfo;
        } else {
            throw_exception("获取豆瓣用户信息失败：{$data['msg']}");
        }
    }

    //登录成功，获取Github用户信息
    public function github($token){
        $github = \ThinkOauth::getInstance('github', $token);
        $data   = $github->call('user');
        if(empty($data['code'])){
            $userInfo['type'] = 'GITHUB';
            $userInfo['name'] = $data['login'];
            $userInfo['nickname'] = $data['name'];
            $userInfo['head_img'] = $data['avatar_url'];
            return $userInfo;
        } else {
            throw_exception("获取Github用户信息失败：{$data}");
        }
    }

    //登录成功，获取Google用户信息
    public function google($token){
        $google = \ThinkOauth::getInstance('google', $token);
        $data   = $google->call('userinfo');
        if(!empty($data['id'])){
            $userInfo['type'] = 'GOOGLE';
            $userInfo['name'] = $data['name'];
            $userInfo['nickname'] = $data['name'];
            $userInfo['head_img'] = $data['picture'];
            return $userInfo;
        } else {
            throw_exception("获取Google用户信息失败：{$data}");
        }
    }

    //登录成功，获取Google用户信息
    public function msn($token){
        $msn  = \ThinkOauth::getInstance('msn', $token);
        $data = $msn->call('me');
        if(!empty($data['id'])){
            $userInfo['type'] = 'MSN';
            $userInfo['name'] = $data['name'];
            $userInfo['nickname'] = $data['name'];
            $userInfo['head_img'] = '微软暂未提供头像URL，请通过 me/picture 接口下载';
            return $userInfo;
        } else {
            throw_exception("获取msn用户信息失败：{$data}");
        }
    }

    //登录成功，获取点点用户信息
    public function diandian($token){
        $diandian  = \ThinkOauth::getInstance('diandian', $token);
        $data      = $diandian->call('user/info');
        if(!empty($data['meta']['status']) && $data['meta']['status'] == 200){
            $userInfo['type'] = 'DIANDIAN';
            $userInfo['name'] = $data['response']['name'];
            $userInfo['nickname'] = $data['response']['name'];
            $userInfo['head_img'] = "https://api.diandian.com/v1/blog/{$data['response']['blogs'][0]['blogUuid']}/avatar/144";
            return $userInfo;
        } else {
            throw_exception("获取点点用户信息失败：{$data}");
        }
    }

    //登录成功，获取淘宝网用户信息
    public function taobao($token){
        $taobao = \ThinkOauth::getInstance('taobao', $token);
        $fields = 'user_id,nick,sex,buyer_credit,avatar,has_shop,vip_info';
        $data   = $taobao->call('taobao.user.buyer.get', "fields={$fields}");
        if(!empty($data['user_buyer_get_response']['user'])){
            $user = $data['user_buyer_get_response']['user'];
            $userInfo['type'] = 'TAOBAO';
            $userInfo['name'] = $user['user_id'];
            $userInfo['nickname'] = $user['nick'];
            $userInfo['head_img'] = $user['avatar'];
            return $userInfo;
        } else {
            throw_exception("获取淘宝网用户信息失败：{$data['error_response']['msg']}");
        }
    }

    //登录成功，获取百度用户信息
    public function baidu($token){
        $baidu = \ThinkOauth::getInstance('baidu', $token);
        $data  = $baidu->call('passport/users/getLoggedInUser');
        if(!empty($data['uid'])){
            $userInfo['type'] = 'BAIDU';
            $userInfo['name'] = $data['uid'];
            $userInfo['nickname'] = $data['uname'];
            $userInfo['head_img'] = "http://tb.himg.baidu.com/sys/portrait/item/{$data['portrait']}";
            return $userInfo;
        } else {
            throw_exception("获取百度用户信息失败：{$data['error_msg']}");
        }
    }

    //登录成功，获取开心网用户信息
    public function kaixin($token){
        $kaixin = \ThinkOauth::getInstance('kaixin', $token);
        $data   = $kaixin->call('users/me');
        if(!empty($data['uid'])){
            $userInfo['type'] = 5;
            $userInfo['name'] = $data['uid'];
            $userInfo['nickname'] = $data['name'];
            $userInfo['head_img'] = $data['logo50'];
            return $userInfo;
        } else {
            throw_exception("获取开心网用户信息失败：{$data['error']}");
        }
    }

    //登录成功，获取搜狐用户信息
    public function sohu($token){
        $sohu = \ThinkOauth::getInstance('sohu', $token);
        $data = $sohu->call('user/get_info');
        if('success' == $data['message'] && !empty($data['data'])){
            $userInfo['type'] = 'SOHU';
            $userInfo['name'] = $data['data']['open_id'];
            $userInfo['nickname'] = $data['data']['nick'];
            $userInfo['head_img'] = $data['data']['icon'];
            return $userInfo;
        } else {
            throw_exception("获取搜狐用户信息失败：{$data['message']}");
        }
    }



}
