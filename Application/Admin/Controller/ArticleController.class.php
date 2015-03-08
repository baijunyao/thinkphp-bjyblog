<?php  
namespace Admin\Controller;
use Common\Controller\AuthController;

class ArticleController extends AuthController{
	// 定义数据表
	private $db;
	private $viewDb;

	// 构造函数 实例化ArticleModel表
	public function __construct(){
		parent::__construct();
		$this->db=D('Article');
		$this->viewDb=D('ArticleView');
	}

	//文章列表
	public function index(){
		$data=$this->db->getAllData();
		$this->assign('data',$data);
		p($data);
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

		}else{
			$this->display();
		}
	}
}



?>