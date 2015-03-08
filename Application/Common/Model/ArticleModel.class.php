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
		$data=I('post.');
		$data['addtime']=time();
		$data['click']=0;
		if($this->create($data)){
			$content=$data['content'];
			$image_path=get_ueditor_image_path($content);//获取文章内容图片
			if(empty($data['description'])){
				$des=htmlspecialchars_decode($content);
				$des=re_substr(strip_tags($des),0,200,false);
				$data['description']=$des;
			}
			if($aid=$this->add($data)){
				if(isset($data['tids'])){
					D('ArticleTag')->addData($aid,$data['tids']);
				}
				if(!empty($image_path)){
					D('ArticlePic')->addData($aid,$image_path);
				}
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	// 修改数据
	public function editData(){

	}

	//删除数据
	public function deleteData(){

	}

	// 获得全部数据
	public function getAllData(){
		$data=$this->order('addtime')->select();
		foreach ($data as $k => $v) {
			$tids=M('article_tag')->where(array('aid'=>$v['aid']))->getField('tid',true);
			if(empty($tids)){
				$data[$k]['tnames']='';
			}else{
				$tnames=D('Tag')->getTnames($tids);
				$data[$k]['tnames']=implode('、', $tnames);
			}
			$data[$k]['cname']=D('Category')->getDataByCid($v['cid'],'cname');
		}
		return $data;
	}




}

