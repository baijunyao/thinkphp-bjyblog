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
				return $aid;
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
	public function getPageData($cid='all',$tid='all',$is_show='1',$is_delete=0,$limit=10){
		if($cid=='all' && $tid=='all'){
			if($is_show=='all'){
				$where=array(
					'is_delete'=>$is_delete
					);				
			}else{
				$where=array(
					'is_delete'=>$is_delete,
					'is_show'=>$is_show
					);					
			}
			$count=$this->where($where)->count();
			$page=new \Org\Bjy\Page($count,$limit);
			$list=$this->where($where)->order('addtime desc')->limit($page->firstRow.','.$page->listRows)->select();
		}elseif ($cid=='all' && $tid!='all') {
			if($is_show=='all'){
				$where=array(
					'at.tid'=>$tid,
					'a.is_delete'=>$is_delete
					);				
			}else{
				$where=array(
					'at.tid'=>$tid,
					'a.is_delete'=>$is_delete,
					'a.is_show'=>$is_show
					);					
			}
			$count=M('article_tag')->alias('at')->join('__ARTICLE__ a ON at.aid=a.aid')->where($where)->count();
			$page=new \Org\Bjy\Page($count,$limit);
			$list=M('article_tag')->alias('at')->join('__ARTICLE__ a ON at.aid=a.aid')->where($where)->order('a.addtime desc')->select();
		}elseif ($cid!='all' && $tid=='all') {
			if($is_show=='all'){
				$where=array(
					'cid'=>$cid,
					'is_delete'=>$is_delete,
					);				
			}else{
				$where=array(
					'cid'=>$cid,
					'is_delete'=>$is_delete,
					'is_show'=>$is_show
					);					
			}
			$count=$this->where($where)->count();
			$page=new \Org\Bjy\Page($count,$limit);
			$list=$this->where($where)->order('addtime desc')->limit($page->firstRow.','.$page->listRows)->select();
		}
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

	// 传递aid获取单条全部数据 $map 主要为前台页面上下页使用
	public function getDataByAid($aid,$map=''){
		if($map==''){
			$data=$this->where("aid=$aid")->find();
			$data['tids']=D('ArticleTag')->getDataByAid($aid);
			$data['tag']=D('ArticleTag')->getDataByAid($aid,'all');
			$data['category']=current(D('Category')->getDataByCid($data['cid'],'cid,cid,cname,keywords'));
			$data['content']=htmlspecialchars_decode($data['content']);
		}else{
			if(isset($map['tid'])){
				$prev_map['at.tid']=$map['tid'];
				$prev_map[]=array('a.is_show'=>1);
				$prev_map[]=array('a.is_delete'=>0);	
				$next_map=$prev_map;
				$prev_map['a.aid']=array('gt',$aid);
				$next_map['a.aid']=array('lt',$aid);
				$data['prev']=$this->field('a.aid,a.title')->alias('a')->join('__ARTICLE_TAG__ at ON a.aid=at.aid')->where($prev_map)->limit(1)->find();
				$data['next']=$this->field('a.aid,a.title')->alias('a')->join('__ARTICLE_TAG__ at ON a.aid=at.aid')->where($next_map)->order('a.aid desc')->limit(1)->find();
			}else{
				$prev_map=$map;
				$prev_map[]=array('is_show'=>1);
				$prev_map[]=array('is_delete'=>0);	
				$next_map=$prev_map;
				$prev_map['aid']=array('gt',$aid);
				$next_map['aid']=array('lt',$aid);
				$data['prev']=$this->field('aid,title')->where($prev_map)->limit(1)->find();
				$data['next']=$this->field('aid,title')->where($next_map)->order('aid desc')->limit(1)->find();
			}
			$data['current']=$this->where(array('aid'=>$aid))->find();
				$data['current']['tids']=D('ArticleTag')->getDataByAid($aid);
				$data['current']['tag']=D('ArticleTag')->getDataByAid($aid,'all');
				$data['current']['category']=current(D('Category')->getDataByCid($data['current']['cid'],'cid,cid,cname,keywords'));
				$data['current']['content']=htmlspecialchars_decode($data['current']['content']);
		}
		return $data;
	}

	// 传递文章adi 点击数+1
	public function add_click($aid){
		$this->where(array('aid'=>$aid))->setInc('click',1);
		return true;
	}

	// 传递搜索词获取数据
	public function getDataByTitle($search_word){
		$map=array(
			'title'=>array('like',"%$search_word%")
			);
		$count=$this->where($map)->count();
		$page=new \Org\Bjy\Page($count,10);
		$list=$this->where($map)->order('addtime desc')->limit($page->firstRow.','.$page->lastRows)->select();
		$show=$page->show();
		$data=array(
			'page'=>$show,
			'data'=>$list
			);
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

