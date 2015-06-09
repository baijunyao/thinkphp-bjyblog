<?php
namespace Common\Model;
use Think\Model;
/**
* 评论model
*/
class CommentModel extends Model{

	// 添加数据
	public function addData(){
		$data=I('post.data');
		$array_data=json_decode($_POST['data'],true);
		$comment['cmtid']=$array_data['comments']['0']['cmtid'];
		$comment['content']=$data;
		$this->add($comment);
	}

	// 获取全部数据
	public function getPageData(){
		$count=$this->count();
		$page=new \Think\Page($count,15);
		$data['page']=$page->show();
		$data['list']=$this->order('cmtid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		return $data;
	}

	// 传递$map获取count数据
	public function getCountData($map=array()){
		return $this->where($map)->count();
	}

}
