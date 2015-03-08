<?php  
namespace Common\Model;
use Think\Model;
class ArticleModel extends Model{
	// 自动验证
	protected $_validate=array(
		array('tid','require','必须选择栏目'),
		array('title','require','文章标题必填'),
		array('author','require','作者必填'),
		array('content','require','文章内容必填'),
		);
	// 添加数据
	public function addData(){
		
	}
}



?>