<?php
namespace Common\Model;
use Think\Model;

class LinkModel extends Model{
	// 定义自动验证规则
	protected $_validate=array(
		array('lname','require','链接名称必填'),
		array('url','require','链接必填'),
		array('sort','require','排序必填'),
		);

	// 修改数据
	public function addData(){
		$data=I('post.');
		if($this->create($data)){
			$data['url']='http://'.trim($data['url'],'http://');
			$lid=$this->add($data);
			return $lid;
		}
	}

	// 修改数据
	public function editData(){
		$data=I('post.');
		if($this->create($data)){
			$data['url']='http://'.trim($data['url'],'http://');
			$this->where(array('lid'=>$data['lid']))->save($data);
			return true;
		}
	}

	// 放入回收站
	public function recycleData(){
		$lid=I('get.lid',0,'intval');
		return $this->changeStatus($lid,'is_delete',1);
	}

	// 彻底删除
	public function deleteData(){
		$lid=I('get.lid',0,'intval');
		$this->where("lid=$lid")->delete();
		return true;
	}

	// 传递is_delete和is_show获取对应数据
	public function getDataByState($is_delete=0,$is_show='all'){
		$show=$is_show=='all' ? '' : $is_show;
		if($is_show=='all'){
			$where=array(
				'is_delete'=>$is_delete,
				);
		}else{
			$where=array(
				'is_delete'=>$is_delete,
				'is_show'=>$is_show,
				);
		}
		return $this->where($where)->order('sort')->select();
	}

	// 传递lid获取单条数据
	public function getDataByLid($lid){
		return $this->where("lid=$lid")->find();
	}
}
