<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
* 文章图片关联表model
*/
class ArticlePicModel extends BaseModel{

    /**
     * 添加数据
     * @param strind $aid 文章id
     * @param array $tids 图片路径
     */
    public function addData($aid,$image_path){
        foreach ($image_path as $k => $v) {
            $pic_data=array(
                'aid'=>$aid,
                'path'=>$v,
                );
            $this->add($pic_data);
        }
        return true;
    }

    // 传递aid删除相关图片
    public function deleteData($aid){
        $this->where(array('aid'=>$aid))->delete();
        return true;
    }

    // 传递aid获取第一条数据作为文章的封面图片
    public function getDataByAid($aid){
        $data=$this
            ->field('path')
            ->where(array('aid'=>$aid))
            ->order('ap_id asc')
            ->limit(1)
            ->select();
        $root_path=rtrim($_SERVER['SCRIPT_NAME'],'/index.php');
        $data[0]['path']=$root_path.$data[0]['path'];
        return $data[0]['path'];
    }

}




