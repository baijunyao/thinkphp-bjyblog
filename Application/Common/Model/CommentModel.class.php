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
		$array_data=json_decode($data,true);
		$comment['cmtid']=$array_data['comments']['0']['cmtid'];
		$comment['content']=$array_data['comments']['0']['content'];
		$this->add($comment);
	}

	// 获取全部数据
	public function getAllData(){
		return $this->select();
	}



}
