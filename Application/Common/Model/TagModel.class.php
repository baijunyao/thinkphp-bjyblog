<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
* 标签model
*/
Class TagModel extends BaseModel{
    // 添加标签
    public function addData(){
        $str=I('post.tnames');
        if(empty($str)){
            $this->error='标签名不能为空';
            return false;
        }else{
            $str=nl2br(trim($str));
            $tnames=explode("<br />", $str);
            foreach ($tnames as $k => $v) {
                $v=trim($v);
                if(!empty($v)){
                    $data['tname']=$v;
                    $this->add($data);
                }
            }
            return true;
        }

    }

    // 修改数据
    public function editData(){
        $tid=I('post.tid');
        $data['tname']=I('post.tname');
        if(empty($data)){
            $this->error='标签名不能为空';
            return false;
        }else{
            return $this->where(array('tid'=>$tid))->save($data);
        }
    }

    // 删除数据
    public function deleteData(){
        $tid=I('get.tid',0,'intval');
        if($this->where(array('tid'=>$tid))->delete()){
            return true;
        }else{
            return false;
        }
    }

    //获得全部数据
    public function getAllData(){
        $data=$this->select();
        foreach ($data as $k => $v) {
            $data[$k]['count']=M('Article_tag')->where(array('tid'=>$v['tid']))->count();
        }
        return $data;
    }

    // 根据tid获取单条数据
    public function getDataByTid($tid,$field='all'){
        if($field=='all'){
            return $this->where(array('tid'=>$tid))->find();
        }else{
            return $this->getFieldByTid($tid,'tname');
        }
    }

    /**
     * 获取tname
     * @param array $tids 文章id
     * @return array $tnames 标签名
     */
    public function getTnames($tids){
        foreach ($tids as $k => $v) {
            $tnames[]=$this->where(array('tid'=>$v))->getField('tname');
        }
        return $tnames;
    }



}
