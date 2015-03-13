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

	// 自动完成
	protected $_auto=array(
		array('click',0),
		array('addtime','time',1,'function'),
		array('description','getDescription',3,'callback'),
		);

	// 获得描述；供自动完成调用
	protected function getDescription($description){
		if(!empty($description)){
			return $description;
		}else{
			$data=I('post.content');
			$des=htmlspecialchars_decode($data);
			$des=re_substr(strip_tags($des),0,200,false);
			return $des;
		}
	}

	// 添加数据
	public function addData(){
		$data=I('post.');
		if($this->create($data)){
			$image_path=get_ueditor_image_path($data['content']);//获取文章内容图片
			if($aid=$this->add()){
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
		$data=I('post.');
		if($this->create($data)){
			$aid=$data['aid'];
			$this->where(array('aid'=>$aid))->save();
			$image_path=get_ueditor_image_path($data['content']);
			D('ArticleTag')->deleteData($aid);
			if(isset($data['tids'])){
				D('ArticleTag')->addData($aid,$data['tids']);
			}
			D('ArticlePic')->deleteData($aid);
			if(!empty($image_path)){
				D('ArticlePic')->addData($aid,$image_path);
			}
			return true;
		}else{
			return false;
		}
	}

	// 放入回收站
	public function recycleData(){
		$aid=I('get.aid',0,'intval');
		return $this->changeStatus($aid,'is_delete',1);
	}

	// 恢复删除
	public function recoverData($aid=0){
		$aid=I('get.aid','intval');
		// echo $aid;die;
		return $this->changeStatus($aid,'is_delete',0);
	}

	// 彻底删除
	public function deleteData(){
		$aid=I('get.aid',0,'intval');
		D('ArticlePic')->deleteData($aid);
		D('ArticleTag')->deleteData($aid);
		$this->where("aid=$aid")->delete();
		// echo 123;die;
		return true;
	}

	/**
	 * 更改状态
	 * @param strind $aid 文章id
	 * @param strind $field 更改的字段
	 * @param array $value 更改的内容
	 */
	public function changeStatus($aid,$field,$value){
		if($this->where("aid=$aid")->setField($field,$value)){
			return true;
		}else{
			return false;
		}
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
	public function getPageData($status=0,$limit=15){
		$count=$this->where(array('is_delete'=>$status))->count();
		$page=new \Think\Page($count,$limit);
		$show=$page->show();
		$list=$this->where(array('is_delete'=>$status))->order('addtime')->limit($page->firstRow.','.$page->listRows)->select();
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
		$data['content']=htmlspecialchars_decode($data['content']);
		return $data;
	}

	// 传递cid获得此分类下面的文章数据
	// is_all为true时获取全部数据 false时不获取is_show为0 和is_delete为1的数据
	public function getDataByCid($cid,$is_all=false){
		if($is_delete){
			return $this->select();
		}else{
			$where=array(
				'cid'=>$cid,
				'is_show'=>1,
				'is_delete'=>0,
			);
			return $this->where($where)->select();
		}
		
	}

}

