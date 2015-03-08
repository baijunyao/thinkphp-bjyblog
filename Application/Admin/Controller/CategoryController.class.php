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
		$this->categoryData=$this->db->getAllData();
	}

	//分类列表首页
	public function index(){
		$this->assign('data',$this->categoryData);
		// p($data);die;
		$this->display();
	}

	// 添加分类
	public function add(){
		// $data=$this->db->getAllData('cname');
		// p($data);die;
		if(IS_POST){
			if($this->db->addData()){
				$this->success('分类添加成功');
			}else{
				$this->error($this->db->getError());
			}
		}else{
			$cid=I('get.cid',0,'intval');
			if($cid){
				$this->assign('cid',$cid);
			}
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
			$data=$this->categoryData;
			$childs=$this->db->getChildData($cid);
			foreach ($data as $k => $v) {
				if(in_array($v['cid'], $childs)){
					$data[$k]['_html']=" disabled='disabled' style='background:#F0F0F0'";
				}else{
					$data[$k]['_html']=" ";
				}
			}
			$this->assign('data',$data);
			$this->assign('onedata',$onedata);
			$this->display();
		}
	}

	// 删除分类
	public function delete(){
		$cid=I('cid',0,'intval');
		$child=$this->db->getChildData($cid);
		if(!empty($child)){
			$this->error('请先删除子栏目');
		}

		// p($cid);
		// p($data);
		// p($child);die;
		
		if($this->db->deleteData()){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}

	}



}




