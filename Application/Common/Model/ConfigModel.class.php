<?php
namespace Common\Model;
use Think\Model;
/**
* 配置项model
*/
class ConfigModel extends Model{

	// // 自动验证
	// protected $_validate=array(
	// 	array('old_password','require','原密码不能为空'),
	// 	array('ADMIN_PASSWORD','require','新密码不能为空'),
	// 	array('re_password','require','重复密码不能为空'),
	// 	array('re_password','ADMIN_PASSWORD','两次密码不一致',0,'confirm'),
	// 	);

	// 修改数据
	public function editData(){
		$data=I('post.');
		// p($data);die;
		foreach ($data as $k => $v) {
			$this->where(array('name'=>$k))->setField('value',$v);
		}
		$str=<<<php
<?php
return array(
//*************************************网站设置****************************************
	'WEB_STATUS'			=>	'{$data['WEB_STATUS']}',	       //网站状态1:开启 0:关闭
	'WEB_CLOSE_WORD'		=>	'{$data['WEB_CLOSE_WORD']}',	   //网站关闭时提示文字
	'WEB_ICP_NUMBER'		=>	'{$data['WEB_ICP_NUMBER']}',	   // 网站ICP备案号
	'ADMIN_EMAIL'			=>	'{$data['ADMIN_EMAIL']}',		   // 站长邮箱

//*************************************优化推广****************************************
	'WEB_NAME'				=>	'{$data['WEB_NAME']}',		 	   //网站名：
	'WEB_KEYWORDS'			=>	'{$data['WEB_KEYWORDS']}',	       //网站关键字
	'WEB_DESCRIPTION'		=>	'{$data['WEB_DESCRIPTION']}',	   //网站描述
	'COPYRIGHT_WORD'		=>	'{$data['COPYRIGHT_WORD']}',	   //文章保留版权提示

//*************************************水印设置****************************************
	'WATER_TYPE'            =>	'{$data['WATER_TYPE']}',           //水印类型 0:不使用水印 1:文字水印 2:图片水印 3:文字和图片水印同时使用
	'TEXT_WATER_WORD'       =>	'{$data['TEXT_WATER_WORD']}',      //文字水印内容
	'TEXT_WATER_TTF_PTH'    =>	'{$data['TEXT_WATER_TTF_PTH']}',   //文字水印字体路径
	'TEXT_WATER_FONT_SIZE'  =>	'{$data['TEXT_WATER_FONT_SIZE']}', //文字水印文字字号
	'TEXT_WATER_COLOR'      =>	'{$data['TEXT_WATER_COLOR']}',     //文字水印文字颜色
	'TEXT_WATER_ANGLE'      =>	'{$data['TEXT_WATER_ANGLE']}',     //文字水印文字倾斜程度
	'TEXT_WATER_LOCATE'     =>	'{$data['TEXT_WATER_LOCATE']}',    //文字水印位置 1：上左 2：上中 3：上右 4：中左 5：中中 6：中右 7：下左 8：下中 9：下右
	'IMAGE_WATER_PIC_PTAH'	=>	'{$data['IMAGE_WATER_PIC_PTAH']}', //图片水印 水印路径
	'IMAGE_WATER_LOCATE'	=>	'{$data['IMAGE_WATER_LOCATE']}',   //图片水印 水印位置 1：上左 2：上中 3：上右 4：中左 5：中中 6：中右 7：下左 8：下中 9：下右
	'IMAGE_WATER_ALPHA'		=>	'{$data['IMAGE_WATER_ALPHA']}',    //图片水印 水印透明度：0-100 

//*************************************水印设置****************************************
	'QQ_APPID'				=>	'{$data['QQ_APPID']}',				// QQ登陆APPID
	'CHANGYAN_APPID'		=>	'{$data['CHANGYAN_APPID']}',		// 畅言评论APPID
	'CHANGYAN_CONF'			=>	'{$data['CHANGYAN_CONF']}',		//畅言评论设置

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
