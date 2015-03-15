<?php
namespace Common\Model;
use Think\Model;

class ConfigModel extends Model{

	// 修改数据
	public function editData(){
		$data=I('post.');
		foreach ($data as $k => $v) {
			$this->where(array('name'=>$k))->setField('value',$v);
		}
		return true;
	}

	// 获取全部数据
	public function getAllData(){
		return $this->getField('name,value');
	}
}
