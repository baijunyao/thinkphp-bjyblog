<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 友情链接管理
 */
class LinkController extends AdminBaseController{
	// 定义数据
	private $db;

	public function __construct(){
		parent::__construct();
		$this->db=D('Link');
	}

	// 友情链接列表
	public function index(){
		$data=$this->db->getDataByState(0);
		$this->assign('data',$data);
		$this->display();
	}

	// 添加友情链接
	public function add(){
		if(IS_POST){
			if($this->db->addData()){
				$this->success('友情链接添加成功',U('Admin/Link/index'));
			}else{
				$this->error($this->db->getError());
			}
		}else{
			$this->display();	
		}

	}

	// 修改友情链接
	public function edit(){
		if(IS_POST){
			if($this->db->editData()){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}else{
			$lid=I('get.lid');
			$data=$this->db->getDataByLid($lid);
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

	// 彻底删除
	public function delete(){
		if($this->db->deleteData()){
			$this->success('彻底删除成功');
		}else{
			$this->error('彻底删除失败');
		}
	}


}



