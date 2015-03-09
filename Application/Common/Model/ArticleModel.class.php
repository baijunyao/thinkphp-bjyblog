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
		$data=$this->where('is_delete=0')->order('addtime')->select();
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

	// 获得分页数据
	public function getPageData($limit=10){
		$count=$data=$this->where('is_delete=0')->count();
		$page=new \Think\Page($count,$limit);
		$show=$page->show();
		$list=$this->where('is_delete=0')->order('addtime')->limit($page->firstRow.','.$page->listRows)->select();
		// p($list);die;
		foreach ($list as $k => $v) {
			$tids=M('article_tag')->where(array('aid'=>$v['aid']))->getField('tid',true);
			if(empty($tids)){
				$list[$k]['tnames']='';
			}else{
				$tnames=D('Tag')->getTnames($tids);
				$list[$k]['tnames']=implode('、', $tnames);
			}
			$list[$k]['cname']=D('Category')->getDataByCid($v['cid'],'cname');
		}
		$data=array(
			'page'=>$show,
			'data'=>$list,
			);
		return $data;
	}

	// 传递aid获取单条全部数据
	public function getDataByAid($aid){
		$data=$this->where("aid=$aid")->find();
		$data['tids']=D('ArticleTag')->getDataByAid($aid);
		return $data;
	}


}

