<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 随言碎语管理
 */
class ChatController extends AdminBaseController{
    // 定义数据
    private $db;

    public function __construct(){
        parent::__construct();
        $this->db=D('Chat');
    }

    // 随言碎语列表
    public function index(){
        $data=$this->db->getDataByState(0,'all');
        $this->assign('data',$data);
        $this->display();
    }

    // 添加随言碎语
    public function add(){
        if(IS_POST){
            if($this->db->addData()){
                $this->success('随言碎语发表成功',U('Admin/Chat/add'));
            }else{
                $this->error($this->db->getError());
            }
        }else{
            $this->display();
        }

    }

    // 修改随言碎语
    public function edit(){
        if(IS_POST){
            if($this->db->editData()){
                $this->success('修改成功');
            }else{
                $this->error($this->db->getError());
            }
        }else{
            $chid=I('get.chid');
            $data=$this->db->getDataByLid($chid);
            $this->assign('data',$data);
            $this->display();
        }
    }


}



