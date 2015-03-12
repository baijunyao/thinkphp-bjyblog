<?php  
namespace Admin\Controller;
use Common\Controller\AuthController;
/**
 * 文章管理
 */
class ArticleController extends AuthController{
	// 定义数据表
	private $db;
	private $viewDb;

	// 构造函数 实例化ArticleModel表
	public function __construct(){
		parent::__construct();
		$this->db=D('Article');
	}

	//文章列表
	public function index(){
		$data=$this->db->getPageData();
		$this->assign('data',$data['data']);
		$this->assign('page',$data['page']);
		$this->display();
	}

	// 添加文章
	public function add(){
		if(IS_POST){
			if($this->db->addData()){
				$this->success('文章添加成功',U('Admin/Article/index'));
			}else{
				$this->error($this->db->getError());
			}
		}else{
			$allCategory=D('Category')->getAllData();
			if(empty($allCategory)){
				$this->error('请先添加分类');
			}
			$allTag=D('Tag')->getAllData();
			$this->assign('allCategory',$allCategory);
			$this->assign('allTag',$allTag);
			$this->display();	
		}

	}

	// 修改文章
	public function edit(){
		if(IS_POST){
			if($this->db->editData()){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}else{
			$aid=I('aid');
			$data=$this->db->getDataByAid($aid);
			$allCategory=D('Category')->getAllData();
			$allTag=D('Tag')->getAllData();
			$this->assign('allCategory',$allCategory);
			$this->assign('allTag',$allTag);
			$this->assign('data',$data);
			$this->display();
		}
	}
	
	// 放入回收站
	public function recycle(){
		if($this->db->recycleData()){
			$this->success('放入回收站成功');
		}else{
			$this->error('放入回收站失败');
		}
	}

	// 恢复删除
	public function recover(){
		if($this->db->recoverData()){
			$this->success('放入回收站成功');
		}else{
			$this->error('放入回收站失败');
		}
	}

	// 彻底删除
	public function delete(){
		if($this->db->deleteData()){
			$this->success('彻底删除成功');
		}else{
			$this->error('彻底删除失败');
		}
	}




}