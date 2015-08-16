<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 友情链接管理
 */
class CommentController extends AdminBaseController{
	// 定义数据
	private $db;

	public function __construct(){
		parent::__construct();
		$this->db=D('Comment');
	}

	// 评论列表
	public function index(){
		$data=$this->db->getPageData();
		$this->assign($data);
		$this->display();
	}

}



