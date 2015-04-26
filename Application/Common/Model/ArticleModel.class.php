<?php  
namespace Common\Model;
use Think\Model;
/**
* 文章model
*/
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
		array('is_delete',0),
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
					if(C('WATER_TYPE')!=0){
						foreach ($image_path as $k => $v) {
							add_water('.'.$v);
						}
					}
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
				if(C('WATER_TYPE')!=0){
					foreach ($image_path as $k => $v) {
						add_water('.'.$v);
					}
				}
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
		return $this->where("aid=$aid")->setField('is_delete',1);
	}

	// 彻底删除
	public function deleteData(){
		$aid=I('get.aid',0,'intval');
		D('ArticlePic')->deleteData($aid);
		D('ArticleTag')->deleteData($aid);
		$this->where("aid=$aid")->delete();
		return true;
	}

	/**
	 * 获得文章分页数据
	 * @param strind $cid 分类id 'all'为全部分类
	 * @param strind $tid 标签id 'all'为全部标签
	 * @param strind $is_delete 状态 1为删除 0为正常
	 * @param strind $limit 分页条数
	 * @return array $data 分页样式 和 分页数据
	 */
	public function getPageData($cid='all',$tid='all',$is_delete=0,$limit=15){
		if($cid=='all' && $tid=='all'){
			$where=array(
				'is_delete'=>$is_delete,
				);
			$list=$this->where($where)->order('addtime desc')->limit($page->firstRow.','.$page->listRows)->select();
			$count=count($list);
		}elseif ($cid=='all' && $tid!='all') {
			$list=M('article_tag')->alias('at')->join('__ARTICLE__ a ON at.aid=a.aid')->where(array('at.tid'=>$tid,'a.is_delete'=>$is_delete))->order('a.addtime desc')->select();
			$count=count($list);
		}elseif ($cid!='all' && $tid=='all') {
			$where=array(
				'cid'=>$cid,
				'is_delete'=>$is_delete,
				);
			$list=$this->where($where)->order('addtime desc')->limit($page->firstRow.','.$page->listRows)->select();
			$count=count($list);
		}
		$page=new \Think\Page($count,$limit);
		$show=$page->show();
		foreach ($list as $k => $v) {
			$list[$k]['tag']=D('ArticleTag')->getDataByAid($v['aid'],'all');
			$list[$k]['pic_path']=D('ArticlePic')->getDataByAid($v['aid']);
			$list[$k]['category']=current(D('Category')->getDataByCid($v['cid'],'cid,cid,cname'));
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
		$data['tag']=D('ArticleTag')->getDataByAid($data['aid'],'all');
		$data['category']=current(D('Category')->getDataByCid($data['cid'],'cid,cid,cname,keywords'));
		$data['content']=htmlspecialchars_decode($data['content']);
		return $data;
	}

	// 传递cid获得此分类下面的文章数据
	// is_all为true时获取全部数据 false时不获取is_show为0 和is_delete为1的数据
	public function getDataByCid($cid,$is_all=false){
		if($is_delete){
			return $this->order('addtime desc')->elect();
		}else{
			$where=array(
				'cid'=>$cid,
				'is_show'=>1,
				'is_delete'=>0,
			);
			return $this->where($where)->order('addtime desc')->select();
		}
		
	}

}

