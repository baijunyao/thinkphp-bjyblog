<?php
namespace Common\Model;
use Think\Model;
/**
* 闲言碎语model
*/
class ChatModel extends Model{
	// 定义自动验证规则
	protected $_vachidate=array(
		array('content','require','内容必填'),
		);

	// 添加数据
	public function addData(){
		$data=I('post.');
		if($this->create($data)){
			$data['date']=time();
			$data['is_delete']=0;
			$chid=$this->add($data);
			return $chid;
		}else{
			return false;
		}
	}

	// 修改数据
	public function editData(){
		$data=I('post.');
		if($this->create($data)){
			$this->where(array('chid'=>$data['chid']))->save($data);
			return true;
		}else{
			return false;
		}
	}

	// 放入回收站
	public function recycleData(){
		$chid=I('get.chid',0,'intval');
		return $this->where(array('chid'=>$chid))->setField('is_delete',1);
	}

	// 彻底删除
	public function deleteData(){
		$chid=I('get.chid',0,'intval');
		$this->where(array('chid'=>$chid))->delete();
		return true;
	}

	// 传递is_delete和is_show获取对应数据
	public function getDataByState($is_delete='all',$is_show='all'){
		$is_delete=$is_delete==='all' ? '' : "is_delete=$is_delete";
		$is_show=$is_show==='all' ? '' : "is_show=$is_show";
		$where=trim(trim($is_delete.' and '.$is_show,' '),'and');
		return $this->where($where)->order('date desc')->select();
	}

	// 传递chid获取单条数据
	public function getDataByLid($chid){
		return $this->where(array('chid'=>$chid))->find();
	}
}
