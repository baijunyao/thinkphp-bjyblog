<?php  
namespace Common\Model;
use Think\Model;

class ArticleTagModel extends Model{

	/**
	 * 添加数据
	 * @param strind $aid 文章id
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




}




