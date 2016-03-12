<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
* 配置项model
*/
class ConfigModel extends BaseModel{

    // // 自动验证
    // protected $_validate=array(
    //  array('old_password','require','原密码不能为空'),
    //  array('ADMIN_PASSWORD','require','新密码不能为空'),
    //  array('re_password','require','重复密码不能为空'),
    //  array('re_password','ADMIN_PASSWORD','两次密码不一致',0,'confirm'),
    //  );

    // 修改数据
    public function editData(){
        $data=I('post.');
        // p($data);die;
        foreach ($data as $k => $v) {
            $this->where(array('name'=>$k))->setField('value',$v);
            $data[$k]=htmlspecialchars_decode($v);
        }
        $data['WEB_STATISTICS']=str_replace( "'",'"',$data['WEB_STATISTICS']);
        $data['CHANGYAN_COMMENT']=str_replace( "'",'"',$data['CHANGYAN_COMMENT']);
        $data['CHANGYAN_COMMENT']=str_replace( '<div id="SOHUCS"></div>','',$data['CHANGYAN_COMMENT']);
        $str=<<<php
<?php
return array(
//此配置项为自动生成请勿直接修改；如需改动请在后台网站设置
//*************************************网站设置****************************************
    'WEB_STATUS'                =>  '{$data['WEB_STATUS']}',           //网站状态1:开启 0:关闭
    'WEB_CLOSE_WORD'            =>  '{$data['WEB_CLOSE_WORD']}',       //网站关闭时提示文字
    'WEB_ICP_NUMBER'            =>  '{$data['WEB_ICP_NUMBER']}',       // 网站ICP备案号
    'ADMIN_EMAIL'               =>  '{$data['ADMIN_EMAIL']}',          // 站长邮箱

//*************************************优化推广****************************************
    'WEB_NAME'                  =>  '{$data['WEB_NAME']}',             //网站名：
    'WEB_KEYWORDS'              =>  '{$data['WEB_KEYWORDS']}',         //网站关键字
    'WEB_DESCRIPTION'           =>  '{$data['WEB_DESCRIPTION']}',      //网站描述
    'AUTHOR'                    =>  '{$data['AUTHOR']}',               //默认作者
    'COPYRIGHT_WORD'            =>  '{$data['COPYRIGHT_WORD']}',       //文章保留版权提示
    'IMAGE_TITLE_ALT_WORD'      =>  '{$data['IMAGE_TITLE_ALT_WORD']}', //图片默认title和alt

//*************************************水印设置****************************************
    'WATER_TYPE'                =>  '{$data['WATER_TYPE']}',           //水印类型 0:不使用水印 1:文字水印 2:图片水印 3:文字和图片水印同时使用
    'TEXT_WATER_WORD'           =>  '{$data['TEXT_WATER_WORD']}',      //文字水印内容
    'TEXT_WATER_TTF_PTH'        =>  '{$data['TEXT_WATER_TTF_PTH']}',   //文字水印字体路径
    'TEXT_WATER_FONT_SIZE'      =>  '{$data['TEXT_WATER_FONT_SIZE']}', //文字水印文字字号
    'TEXT_WATER_COLOR'          =>  '{$data['TEXT_WATER_COLOR']}',     //文字水印文字颜色
    'TEXT_WATER_ANGLE'          =>  '{$data['TEXT_WATER_ANGLE']}',     //文字水印文字倾斜程度
    'TEXT_WATER_LOCATE'         =>  '{$data['TEXT_WATER_LOCATE']}',    //文字水印位置 1：上左 2：上中 3：上右 4：中左 5：中中 6：中右 7：下左 8：下中 9：下右
    'IMAGE_WATER_PIC_PTAH'      =>  '{$data['IMAGE_WATER_PIC_PTAH']}', //图片水印 水印路径
    'IMAGE_WATER_LOCATE'        =>  '{$data['IMAGE_WATER_LOCATE']}',   //图片水印 水印位置 1：上左 2：上中 3：上右 4：中左 5：中中 6：中右 7：下左 8：下中 9：下右
    'IMAGE_WATER_ALPHA'         =>  '{$data['IMAGE_WATER_ALPHA']}',    //图片水印 水印透明度：0-100

//*************************************第三方登录****************************************
    'QQ_APP_ID'                 =>  '{$data['QQ_APP_ID']}',            // QQ登陆APP D
    'QQ_APP_KEY'                =>  '{$data['QQ_APP_KEY']}',           // QQ登陆APP KEY
    'SINA_API_KEY'              =>  '{$data['SINA_API_KEY']}',         // 新浪登陆API KEY
    'SINA_SECRET'               =>  '{$data['SINA_SECRET']}',          // 新浪登陆SECRET
    'DOUBAN_API_KEY'            =>  '{$data['DOUBAN_API_KEY']}',       // 豆瓣登陆API KEY
    'DOUBAN_SECRET'             =>  '{$data['DOUBAN_SECRET']}',        // 豆瓣登陆SECRET
    'RENREN_API_KEY'            =>  '{$data['RENREN_API_KEY']}',       // 人人登陆API KEY
    'RENREN_SECRET'             =>  '{$data['RENREN_SECRET']}',        // 人人登陆SECRET
    'KAIXIN_API_KEY'            =>  '{$data['KAIXIN_API_KEY']}',       // 开心网登陆API KEY
    'KAIXIN_SECRET'             =>  '{$data['KAIXIN_SECRET']}',        // 开心网登陆SECRET
    'GITHUB_CLIENT_ID'          =>  '{$data['GITHUB_CLIENT_ID']}',     // github登陆API KEY
    'GITHUB_CLIENT_SECRET'      =>  '{$data['GITHUB_CLIENT_SECRET']}', // github登陆SECRET
    'SOHU_API_KEY'              =>  '{$data['SOHU_API_KEY']}',         // 搜狐网登陆API KEY
    'SOHU_SECRET'               =>  '{$data['SOHU_SECRET']}',          // 搜狐网登陆SECRT
//***********************************其他第三方接口****************************************
    'WEB_STATISTICS'            =>  '{$data['WEB_STATISTICS']}',       // 第三方统计代码
    'BAIDU_SITE_URL'            =>  '{$data['BAIDU_SITE_URL']}',       // 百度推送site提交接
//***********************************邮箱设置***********************************************
    'EMAIL_SMTP'                =>  '{$data['EMAIL_SMTP']}',           //  SMTP服务器
    'EMAIL_USERNAME'            =>  '{$data['EMAIL_USERNAME']}',       //  邮箱用户名
    'EMAIL_PASSWORD'            =>  '{$data['EMAIL_PASSWORD']}',       //  邮箱密码
    'EMAIL_FROM_NAME'           =>  '{$data['EMAIL_FROM_NAME']}',      //  发件名
//***********************************评论管理***********************************************
    'COMMENT_REVIEW'            =>  '{$data['COMMENT_REVIEW']}',       // 评论审核1:开启 0:关闭
    'COMMENT_SEND_EMAIL'        =>  '{$data['COMMENT_SEND_EMAIL']}',   // 被评论邮件通知1:开启 0:关闭
    'EMAIL_RECEIVE'             =>  '{$data['EMAIL_RECEIVE']}',        // 接收评论通知邮箱

);
php;
        file_put_contents('./Application/Common/Conf/webconfig.php', $str);
        return true;
    }

    // 获取全部数据
    public function getAllData(){
        return $this->getField('name,value');
    }

    // 修改密码
    public function changePassword(){
        $data=I('post.');
        if($data['ADMIN_PASSWORD']==$data['re_password']){
            $old_password=$this->getFieldByName('ADMIN_PASSWORD','value');
            if(md5($data['old_password'])==$old_password){
                $password=md5($data['ADMIN_PASSWORD']);
                $this->where(array('name'=>'ADMIN_PASSWORD'))->setField('value',$password);
                return true;
            }else{
                $this->error='原密码输入错误';
            }
        }else{
            $this->error='两次密码不一致';
            return false;
        }
    }
}
