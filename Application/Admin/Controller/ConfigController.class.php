<?php 
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 网站设置
 */
class ConfigController extends AdminBaseController{
	// 定义数据表
	private $db;
	
	// 构造函数 实例化TagModel
	public function __construct(){
		parent::__construct();
		$this->db=D('Config');
	}

	// 网站配置首页
	public function index(){
		if(IS_POST){
			if($this->db->editData()){
				$this->success('修改成功',U('Admin/Config/index'));
			}else{
				$this->error('修改失败');
			}
		}else{
			$data=$this->db->getAllData();
			$this->assign('data',$data);
			$this->display();			
		}
	}

	public function config(){
		$this->display();
	}


}




