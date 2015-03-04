<?php  
namespace Admin\Controller;
use Common\Controller\AuthController;
class CategoryController extends AuthController{
	//定义数据表
	private $db;

	//定义category表数
	private $categoryData;

	//构造函数 实例化CategoryModel 并获得整张表的数据
	public function __construct(){
		parent::__construct();
		//初始化时实例化category model
		$this->db=D('Category');
		//获取category数据并赋值给$categoryData
		$this->categoryData=$this->db->getData();
	}

	//分类列表首页
	public function index(){
		$this->assign('data',$this->categoryData);
		// p($data);die;
		$this->display();
	}

	// 添加分类
	public function add(){
		// $data=$this->db->getData('cname');
		// p($data);die;
		if(IS_POST){
			if($this->db->addData()){
				$this->success('分类添加成功');
			}else{
				$this->error($this->db->getError());
			}
		}else{
			$this->assign('data',$this->categoryData);
			$this->display();
		}
	}

	// 修改分类
	public function edit(){
		if(IS_POST){
			if($this->db->editData()){
				$this->success('修改成功');
			}else{
				$this->error($this->db->getError());
			}
		}else{
			$cid=I('get.cid',0,'intval');
			$onedata=$this->db->getDataByCid($cid);
			$this->assign('data',$this->categoryData);
			$this->assign('onedata',$onedata);
			// p($onedata);die;
			$this->display();
		}
	}

	// 删除分类
	public function delete(){
		if($this->db->deleteData()){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}

	}



}




