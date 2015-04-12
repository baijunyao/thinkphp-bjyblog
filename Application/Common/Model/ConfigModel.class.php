<?php
namespace Common\Model;
use Think\Model;
/**
* 配置项model
*/
class ConfigModel extends Model{

	// // 自动验证
	// protected $_validate=array(
	// 	array('old_password','require','原密码不能为空'),
	// 	array('ADMIN_PASSWORD','require','新密码不能为空'),
	// 	array('re_password','require','重复密码不能为空'),
	// 	array('re_password','ADMIN_PASSWORD','两次密码不一致',0,'confirm'),
	// 	);

	// 修改数据
	public function editData(){
		$data=I('post.');
		if(empty($data['ADMIN_PASSWORD'])){
			$this->error='后台登陆密码不能为空';
		}else{
			foreach ($data as $k => $v) {
				$this->where(array('name'=>$k))->setField('value',$v);
			}
			return true;
		}
	}

	// 获取全部数据
	public function getAllData(){
		return $this->getField('name,value');
	}

	// 修改密码
	public function changePassword(){
		$data=I('post.');
		if($data['ADMIN_PASSWORD']==$data['re_password']){
			$old_password=$this->getFieldByName('ADMIN_PASSWORD','value');
			if(md5($data['old_password'])==$old_password){
				$password=md5($data['ADMIN_PASSWORD']);
				// p($old_password);
				// p($password);die;
				$this->where(array('name'=>'ADMIN_PASSWORD'))->setField('value',$password);
				return true;
			}else{
				$this->error='原密码输入错误';
			}
		}else{
			$this->error='两次密码不一致';
			return false;
		}
		// if($this->create()){
		// 	$data=I('post.');
		// 	$password=md5($data['$ADMIN_PASSWORD']);
		// 	$old_password=$this->getFieldByName('ADMIN_PASSWORD','value');
		// 	p($password);
		// 	p($old_password);die;
		// 	$this->where('name=ADMIN_PASSWORD')->setField('value',$password);
		// 	return true;
		// }else{
		// 	return false;
		// }

	}
}
