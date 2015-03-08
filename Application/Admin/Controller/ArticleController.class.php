<?php  
namespace Admin\Controller;
use Common\Controller\AuthController;

class ArticleController extends AuthController{
	// 定义数据表
	private $db;

	// 构造函数 实例化ArticleModel表
	public function __construct(){
		parent::__construct();
		$this->db=D('Article');
	}

	//文章列表
	public function index(){
		$this->display();
	}

	// 添加文章
	public function add(){
		if(IS_POST){
			$data=I('post.');
			p($data);
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