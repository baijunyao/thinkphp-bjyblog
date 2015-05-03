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
		$comment['cmtid']=$data['comments']['0']['cmtid'];
		$comment['content']=$data['comments']['0']['content'];
		$this->add($comment);
	}

	// 获取全部数据
	public function getAllData(){
		return $this->select();
	}



}
