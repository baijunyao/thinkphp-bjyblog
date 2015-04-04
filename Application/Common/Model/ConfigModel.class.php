<?php
namespace Common\Model;
use Think\Model;

class ConfigModel extends Model{

	// 修改数据
	public function editData(){
		$data=I('post.');
		if(empty($data['ADMIN_PASSWORD'])){
			$this->error='后台登陆密码不能为空';
		}else{
			$data['ADMIN_PASSWORD']=md5($data['$ADMIN_PASSWORD']);
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
}
