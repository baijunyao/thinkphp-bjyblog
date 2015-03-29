<?php  
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 回收管理
 */
class RecycleController extends AdminBaseController{
	//空操作 自动载入当前模板
	public function _empty($name){
		$this->display($name);
	}

	// 回收站首页
	public function index(){
		$this->display();
	}

	// 已删文章
	public function article(){
		$data=D('Article')->getPageData('all','admin',1);
		$this->assign('data',$data['data']);
		$this->assign('page',$data['page']);
		// p($data);die;
		$this->display();
	}


}





