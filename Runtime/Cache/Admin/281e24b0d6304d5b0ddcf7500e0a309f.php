<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>网站信息</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.4/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/font-awesome-4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/css/bjy.css">
		<link rel="stylesheet" href="/Public/static/iCheck-1.0.2/skins/all.css">
</head>
<body>
<form action="<?php echo U('Admin/Config/index');?>" method="post">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#basic" data-toggle="tab">网站设置</a>
		</li>
		<li>
			<a href="#seo" data-toggle="tab">优化推广</a>
		</li>
		<li>
			<a href="#water" data-toggle="tab">文章水印</a>
		</li>
		<li>
			<a href="#oauth" data-toggle="tab">第三方登录</a>
		</li>
		<li>
			<a href="#other" data-toggle="tab">其他第三方接口</a>
		</li>
		<li>
			<a href="#email" data-toggle="tab">邮箱设置</a>
		</li>
		<li>
			<a href="#comment" data-toggle="tab">评论设置</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade in active" id="basic">
			<table class="table table-bordered table-hover">
				<tr>
					<th>网站状态：</th>
					<td>
						<span class="inputword">开启</span>
						<input class="icheck" type="radio" name="WEB_STATUS" value="1" <?php if(($data['WEB_STATUS']) == "1"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">关闭</span>
						<input class="icheck" type="radio" name="WEB_STATUS" value="0" <?php if(($data['WEB_STATUS']) == "0"): ?>checked="checked"<?php endif; ?> >
					</td>
				</tr>
				<tr>
					<th>网站关闭时提示文字：</th>
					<td>
						<textarea class="form-control modal-sm" name="WEB_CLOSE_WORD" rows="5" placeholder=""><?php echo ($data['WEB_CLOSE_WORD']); ?></textarea>
					</td>
				</tr>
				<tr>
					<th>备案号：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="WEB_ICP_NUMBER" value="<?php echo ($data['WEB_ICP_NUMBER']); ?>" >
					</td>
				</tr>
				<tr>
					<th>站长邮箱：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="ADMIN_EMAIL" value="<?php echo ($data['ADMIN_EMAIL']); ?>" >
					</td>
				</tr>
			</table>
		</div>
		<div class="tab-pane fade" id="seo">
			<table class="table table-bordered table-hover">
				<tr>
					<th>网站名：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="WEB_NAME" value="<?php echo ($data['WEB_NAME']); ?>" >
					</td>
				</tr>
				<tr>
					<th>网站关键字：</th>
					<td>
						<textarea class="form-control modal-sm" name="WEB_KEYWORDS" rows="5" placeholder=""><?php echo ($data['WEB_KEYWORDS']); ?></textarea>
					</td>
				</tr>
				<tr>
					<th>网站描述：</th>
					<td>
						<textarea class="form-control modal-sm" name="WEB_DESCRIPTION" rows="5" placeholder=""><?php echo ($data['WEB_DESCRIPTION']); ?></textarea>
					</td>
				</tr>
				<tr>
					<th>默认作者：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="AUTHOR" value="<?php echo ($data['AUTHOR']); ?>" >
					</td>
				</tr>
				<tr>
					<th>文章保留版权提示：</th>
					<td>
						<textarea class="form-control modal-sm" name="COPYRIGHT_WORD" rows="5" placeholder=""><?php echo ($data['COPYRIGHT_WORD']); ?></textarea>
					</td>
				</tr>
				<tr>
					<th>文章图片title和alt内容：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="IMAGE_TITLE_ALT_WORD" value="<?php echo ($data['IMAGE_TITLE_ALT_WORD']); ?>" >
					</td>
				</tr>
			</table>
		</div>
		<div class="tab-pane fade" id="water">
			<table class="table table-bordered table-hover">
				<tr>
					<th>水印类型：</th>
					<td>
						<span class="inputword">文字水印</span>
						<input class="icheck" type="radio" name="WATER_TYPE" value="1" <?php if(($data['WATER_TYPE']) == "1"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">图片水印</span>
						<input class="icheck" type="radio" name="WATER_TYPE" value="2" <?php if(($data['WATER_TYPE']) == "2"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">关闭水印</span>
						<input class="icheck" type="radio" name="WATER_TYPE" value="0" <?php if(($data['WATER_TYPE']) == "0"): ?>checked="checked"<?php endif; ?> >
					</td>
				</tr>
				<tr>
					<th>文字水印内容：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="TEXT_WATER_WORD" value="<?php echo ($data['TEXT_WATER_WORD']); ?>" >
					</td>
				</tr>
				<tr>
					<th>文字水印字体路径：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="TEXT_WATER_TTF_PTH" value="<?php echo ($data['TEXT_WATER_TTF_PTH']); ?>" >
					</td>
				</tr>
				<tr>
					<th>文字水印文字字号：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="TEXT_WATER_FONT_SIZE" value="<?php echo ($data['TEXT_WATER_FONT_SIZE']); ?>" >
					</td>
				</tr>
				<tr>
					<th>文字水印文字颜色：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="TEXT_WATER_COLOR" value="<?php echo ($data['TEXT_WATER_COLOR']); ?>" >
					</td>
				</tr>
				<tr>
					<th>文字水印文字倾斜程度：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="TEXT_WATER_ANGLE" value="<?php echo ($data['TEXT_WATER_ANGLE']); ?>" >
					</td>
				</tr>
				<tr>
					<th>文字水印位置：</th>
					<td>
						<span class="inputword">上左</span>
						<input class="icheck" type="radio" name="TEXT_WATER_LOCATE" value="1" <?php if(($data['TEXT_WATER_LOCATE']) == "1"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">上中</span>
						<input class="icheck" type="radio" name="TEXT_WATER_LOCATE" value="2" <?php if(($data['TEXT_WATER_LOCATE']) == "2"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">上右</span>
						<input class="icheck" type="radio" name="TEXT_WATER_LOCATE" value="3" <?php if(($data['TEXT_WATER_LOCATE']) == "3"): ?>checked="checked"<?php endif; ?> >
						<br>
						<span class="inputword">中左</span>
						<input class="icheck" type="radio" name="TEXT_WATER_LOCATE" value="4" <?php if(($data['TEXT_WATER_LOCATE']) == "4"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">中中</span>
						<input class="icheck" type="radio" name="TEXT_WATER_LOCATE" value="5" <?php if(($data['TEXT_WATER_LOCATE']) == "5"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">中右</span>
						<input class="icheck" type="radio" name="TEXT_WATER_LOCATE" value="6" <?php if(($data['TEXT_WATER_LOCATE']) == "6"): ?>checked="checked"<?php endif; ?> >
						<br>
						<span class="inputword">下左</span>
						<input class="icheck" type="radio" name="TEXT_WATER_LOCATE" value="7" <?php if(($data['TEXT_WATER_LOCATE']) == "7"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">下中</span>
						<input class="icheck" type="radio" name="TEXT_WATER_LOCATE" value="8" <?php if(($data['TEXT_WATER_LOCATE']) == "8"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">下右</span>
						<input class="icheck" type="radio" name="TEXT_WATER_LOCATE" value="9" <?php if(($data['TEXT_WATER_LOCATE']) == "9"): ?>checked="checked"<?php endif; ?> >
					</td>
				</tr>
				<tr>
					<th>图片水印来源路径：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="IMAGE_WATER_PIC_PTAH" value="<?php echo ($data['IMAGE_WATER_PIC_PTAH']); ?>" >
					</td>
				</tr>
				<tr>
					<th>图片水印位置：</th>
					<td>
						<span class="inputword">上左</span>
						<input class="icheck" type="radio" name="IMAGE_WATER_LOCATE" value="1" <?php if(($data['IMAGE_WATER_LOCATE']) == "1"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">上中</span>
						<input class="icheck" type="radio" name="IMAGE_WATER_LOCATE" value="2" <?php if(($data['IMAGE_WATER_LOCATE']) == "2"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">上右</span>
						<input class="icheck" type="radio" name="IMAGE_WATER_LOCATE" value="3" <?php if(($data['IMAGE_WATER_LOCATE']) == "3"): ?>checked="checked"<?php endif; ?> >
						<br>
						<span class="inputword">中左</span>
						<input class="icheck" type="radio" name="IMAGE_WATER_LOCATE" value="4" <?php if(($data['IMAGE_WATER_LOCATE']) == "4"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">中中</span>
						<input class="icheck" type="radio" name="IMAGE_WATER_LOCATE" value="5" <?php if(($data['IMAGE_WATER_LOCATE']) == "5"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">中右</span>
						<input class="icheck" type="radio" name="IMAGE_WATER_LOCATE" value="6" <?php if(($data['IMAGE_WATER_LOCATE']) == "6"): ?>checked="checked"<?php endif; ?> >
						<br>
						<span class="inputword">下左</span>
						<input class="icheck" type="radio" name="IMAGE_WATER_LOCATE" value="7" <?php if(($data['IMAGE_WATER_LOCATE']) == "7"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">下中</span>
						<input class="icheck" type="radio" name="IMAGE_WATER_LOCATE" value="8" <?php if(($data['IMAGE_WATER_LOCATE']) == "8"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">下右</span>
						<input class="icheck" type="radio" name="IMAGE_WATER_LOCATE" value="9" <?php if(($data['IMAGE_WATER_LOCATE']) == "9"): ?>checked="checked"<?php endif; ?> >
					</td>
				</tr>
				<tr>
					<th>图片水印透明度：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="IMAGE_WATER_ALPHA" value="<?php echo ($data['IMAGE_WATER_ALPHA']); ?>" >
					</td>
				</tr>
			</table>
		</div>
		<div class="tab-pane fade" id="oauth">
			<table class="table table-bordered table-hover">
				<tr>
					<th>QQ登陆APP ID：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="QQ_APP_ID" value="<?php echo ($data['QQ_APP_ID']); ?>" >
					</td>
				</tr>
				<tr>
					<th>QQ登陆APP KEY：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="QQ_APP_KEY" value="<?php echo ($data['QQ_APP_KEY']); ?>" >
					</td>
				</tr>
				<tr>
					<th>新浪微博登陆API KEY：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="SINA_API_KEY" value="<?php echo ($data['SINA_API_KEY']); ?>" >
					</td>
				</tr>
				<tr>
					<th>新浪微博登陆SECRET：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="SINA_SECRET" value="<?php echo ($data['SINA_SECRET']); ?>" >
					</td>
				</tr>
				<tr>
					<th>豆瓣登陆API KEY：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="DOUBAN_API_KEY" value="<?php echo ($data['DOUBAN_API_KEY']); ?>" >
					</td>
				</tr>
				<tr>
					<th>豆瓣登陆SECRET：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="DOUBAN_SECRET" value="<?php echo ($data['DOUBAN_SECRET']); ?>" >
					</td>
				</tr>
				<tr>
					<th>人人登陆API KEY：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="RENREN_API_KEY" value="<?php echo ($data['RENREN_API_KEY']); ?>" >
					</td>
				</tr>
				<tr>
					<th>人人登陆SECRET：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="RENREN_SECRET" value="<?php echo ($data['RENREN_SECRET']); ?>" >
					</td>
				</tr>
				<tr>
					<th>开心网登陆API KEY：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="KAIXIN_API_KEY" value="<?php echo ($data['KAIXIN_API_KEY']); ?>" >
					</td>
				</tr>
				<tr>
					<th>开心网登陆SECRET：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="KAIXIN_SECRET" value="<?php echo ($data['KAIXIN_SECRET']); ?>" >
					</td>
				</tr>
				<tr>
					<th>github Client ID：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="GITHUB_CLIENT_ID" value="<?php echo ($data['GITHUB_CLIENT_ID']); ?>" >
					</td>
				</tr>
				<tr>
					<th>github Client Secret：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="GITHUB_CLIENT_SECRET" value="<?php echo ($data['GITHUB_CLIENT_SECRET']); ?>" >
					</td>
				</tr>
				<tr>
					<th>搜狐登录API KEY：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="SOHU_API_KEY" value="<?php echo ($data['SOHU_API_KEY']); ?>" >
					</td>
				</tr>
				<tr>
					<th>搜狐登录SECRET：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="SOHU_SECRET" value="<?php echo ($data['SOHU_SECRET']); ?>" >
					</td>
				</tr>
			</table>
		</div>
		<div class="tab-pane fade" id="other">
			<table class="table table-bordered table-hover">
				<tr>
					<th>百度推送site提交链接：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="BAIDU_SITE_URL" value="<?php echo ($data['BAIDU_SITE_URL']); ?>" >
					</td>
				</tr>
				<tr>
					<th>第三方统计代码：</th>
					<td>
						<textarea class="form-control modal-sm" name="WEB_STATISTICS" rows="5" placeholder=""><?php echo ($data['WEB_STATISTICS']); ?></textarea>
					</td>
				</tr>
			</table>
		</div>
		<div class="tab-pane fade" id="email">
			<table class="table table-bordered table-hover">
				<tr>
					<th>SMTP服务器：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="EMAIL_SMTP" value="<?php echo ($data['EMAIL_SMTP']); ?>" >
					</td>
				</tr>
				<tr>
					<th>邮箱账号：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="EMAIL_USERNAME" value="<?php echo ($data['EMAIL_USERNAME']); ?>" >
					</td>
				</tr>
				<tr>
					<th>邮箱密码：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="EMAIL_PASSWORD" value="<?php echo ($data['EMAIL_PASSWORD']); ?>" >
					</td>
				</tr>
				<tr>
					<th>发件人名称：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="EMAIL_FROM_NAME" value="<?php echo ($data['EMAIL_FROM_NAME']); ?>" >
					</td>
				</tr>
			</table>
		</div>
		<div class="tab-pane fade" id="comment">
			<table class="table table-bordered table-hover">
				<tr>
					<th>开启评论审核：</th>
					<td>
						<span class="inputword">开启</span>
						<input class="icheck" type="radio" name="COMMENT_REVIEW" value="1" <?php if(($data['COMMENT_REVIEW']) == "1"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">关闭</span>
						<input class="icheck" type="radio" name="COMMENT_REVIEW" value="0" <?php if(($data['COMMENT_REVIEW']) == "0"): ?>checked="checked"<?php endif; ?> >
					</td>
				</tr>
				<tr>
					<th>发送被评论邮件：</th>
					<td>
						<span class="inputword">开启</span>
						<input class="icheck" type="radio" name="COMMENT_SEND_EMAIL" value="1" <?php if(($data['COMMENT_SEND_EMAIL']) == "1"): ?>checked="checked"<?php endif; ?> >
						<span class="inputword">关闭</span>
						<input class="icheck" type="radio" name="COMMENT_SEND_EMAIL" value="0" <?php if(($data['COMMENT_SEND_EMAIL']) == "0"): ?>checked="checked"<?php endif; ?> >
					</td>
				</tr>
				<tr>
					<th>接收评论通知邮箱：</th>
					<td>
						<input class="form-control modal-sm" type="text" name="EMAIL_RECEIVE" value="<?php echo ($data['EMAIL_RECEIVE']); ?>" >
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div>
		<input class="btn btn-default" type="submit" value="提交">
	</div>
</form>
<script type="text/javascript" src="/Public/static/js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="/Public/static/bootstrap-3.3.4/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/js/html5shiv.min.js"></script>
<script type="text/javascript" src="/Public/static/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="/Public/static/iCheck-1.0.2/icheck.min.js"></script>
<script>
$(document).ready(function(){
	$('.icheck').iCheck({
		checkboxClass: "icheckbox_square-blue",
		radioClass: "iradio_square-blue",
		increaseArea: "20%"
	});
});
</script>
</body>
</html>