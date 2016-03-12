<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 标签管理
 */
class TagController extends AdminBaseController{
    // 定义数据表
    private $db;
    
    // 构造函数 实例化TagModel
    public function __construct(){
        parent::__construct();
        $this->db=D('Tag');
    }

    // 标签首页
    public function index(){
        $data=$this->db->getAllData();
        $this->assign('data',$data);
        $this->display();
    }

    // 添加标签
    public function add(){
        if(IS_POST){
            if($this->db->addData()){
                $this->success('标签添加成功');
            }else{
                $this->error($this->db->getError());
            }
        }else{
            $this->display();
        }
    }

    // 修改标签
    public function edit(){
        if(IS_POST){
            if($this->db->editData()){
                $this->success('修改成功');
            }else{
                $this->error($this->db->getError());
            }           
        }else{
            $tid=I('get.tid',0,'intval');
            $data=$this->db->getDataByTid($tid);
            // p($data);
            $this->assign('data',$data);
            $this->display();
        }
    }
    
    // 删除标签
    public function delete(){
        if($this->db->deleteData()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}




