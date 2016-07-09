<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 文章管理
 */
class ArticleController extends AdminBaseController{
    // 定义数据表
    private $db;
    private $viewDb;

    // 构造函数 实例化ArticleModel表
    public function __construct(){
        parent::__construct();
        $this->db=D('Article');
    }

    //文章列表
    public function index(){
        $data=$this->db->getPageData('all','all','all',0,15);
        $this->assign('data',$data['data']);
        $this->assign('page',$data['page']);
        $this->display();
    }

    // 添加文章
    public function add(){
        if(IS_POST){
            if($aid=$this->db->addData()){
                $baidu_site_url=C('BAIDU_SITE_URL');
                if(!empty($baidu_site_url)){
                    $this->baidu_site($aid);
                }
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

    // 向同步百度推送
    public function baidu_site($aid){
        $urls=array();
        $urls[]=U('Home/Index/article',array('aid'=>$aid),'',true);
        $api=C('BAIDU_SITE_URL');
        $ch=curl_init();
        $options=array(
            CURLOPT_URL=>$api,
            CURLOPT_POST=>true,
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_POSTFIELDS=>implode("\n", $urls),
            CURLOPT_HTTPHEADER=>array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result=curl_exec($ch);
        $msg=json_decode($result,true);
        if($msg['code']==500){
            curl_exec($ch);
        }
        curl_close($ch);
    }

    // 修改文章
    public function edit(){
        if(IS_POST){
            if($this->db->editData()){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }else{
            $aid=I('aid');
            $data=$this->db->getDataByAid($aid);
            $allCategory=D('Category')->getAllData();
            $allTag=D('Tag')->getAllData();
            $this->assign('allCategory',$allCategory);
            $this->assign('allTag',$allTag);
            $this->assign('data',$data);
            $this->display();
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
