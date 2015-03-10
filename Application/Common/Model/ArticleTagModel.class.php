<?php  
namespace Common\Model;
use Think\Model;

class ArticleTagModel extends Model{

	/**
	 * 添加数据
	 * @param string $aid 文章id
	 * @param array $tids 标签id
	 */
	public function addData($aid,$tids){
		foreach ($tids as $k => $v) {
			$tag_data=array(
				'aid'=>$aid,
				'tid'=>$v,
				);
			$this->add($tag_data);
		}
		return true;
	}

	// 传递aid删除对应的tid
	public function deleteData($aid){
		$this->where("aid=$aid")->delete();
		return true;
	}


	// 传递aid获取tid数组
	public function getDataByAid($aid){
		return $this->where("aid=$aid")->getField('tid',true);
	}



}




