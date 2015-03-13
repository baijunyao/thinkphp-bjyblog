<?php 
namespace Common\Model;
use Think\Model;

class ArticlePicModel extends Model{

	/**
	 * 添加数据
	 * @param strind $aid 文章id
	 * @param array $tids 图片路径
	 */
	public function addData($aid,$image_path){
		foreach ($image_path as $k => $v) {
			$pic_data=array(
				'aid'=>$aid,
				'path'=>$v,
				);
			$this->add($pic_data);
		}
		return true;
	}

	// 传递aid删除相关图片
	public function deleteData($aid){
		$paths=$this->where("aid=$aid")->getField('path',true);
		foreach ($paths as $k => $v) {
			unlink('.'.$v);
		}
		$this->where("aid=$aid")->delete();
		return true;
	}



}




