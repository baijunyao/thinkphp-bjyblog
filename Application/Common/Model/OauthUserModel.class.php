<?php
namespace Common\Model;
use Think\Model;
/**
* 第三方登陆model
*/
class OauthUserModel extends Model{
	// 自动验证
	protected $_validate=array(
		array('type','require','类型必填'),
		array('nickname','require','昵称必填'),
		array('head_img','require','头像必填'),
		array('openid','require','openid必填'),
		array('access_token','require','access_token必填'),
		array('test','require','test'),
		);

	// 自动完成
	protected $_auto=array(
		array('create_time','time',1,'function'),
		array('last_login_time','time',3,'function'),
		array('last_login_ip','getLoginIp',3,'callback'),
		array('login_times',1),
		array('status',1),
		);

	// 获得登陆ip
	function getLoginIp(){
		$ip=get_client_ip();
		return $ip;
	}

	// 添加数据
	public function addData(){
		if($this->create()){
			$id=$this->add();
			return $id;
		}
	}

	// 修改数据
	public function editData(){
		$openid=I('post.openid');
		if($data=$this->create()){
			$data['login_times']=array('exp','login_times+1');
			unset($data['status']);
			unset($data['create_time']);
			$id=$this->where(array('openid'=>$openid))->save($data);
			return $id;
		}
	}

	// 传递openid获取单条数据
	public function getDataByOpenid($openid){
		return $this->where(array('openid'=>$openid))->find();
	}

}