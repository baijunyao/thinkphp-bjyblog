<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>网站信息</title>
<script type="text/javascript" src="/Public/static/js/jquery-2.0.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="/Public/static/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/Public/static/css/bjy.css">
<script type="text/javascript" src="/Public/static/bootstrap-3.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/static/iCheck-1.0.2/icheck.min.js"></script>
<link rel="stylesheet" href="/Public/static/iCheck-1.0.2/skins/all.css">
<script>
$(document).ready(function(){
  $('.icheck').iCheck({
    checkboxClass: "icheckbox_square-blue",
    radioClass: "iradio_square-blue",
    increaseArea: "20%"
  });
});
</script>
</head>
<body>
<form action="<?php echo U('Admin/Config/config');?>" method="post">
	<table class="table table-bordered table-hover">
		<tr>
			<th>网站名：</th>
			<td>
				<input class="form-control modal-sm" type="text" name="WEB_NAME" >
			</td>
		</tr>
		<tr>
			<th>关键字</th>
			<td>
				<textarea class="form-control modal-sm bjy-noresize" name="WEB_KEYWORD" rows="5" placeholder=""></textarea>
			</td>
		</tr>
		<tr>
			<th>描述</th>
			<td>
				<textarea class="form-control modal-sm bjy-noresize" name="WEB_KEYWORD" rows="5" placeholder=""></textarea>
			</td>
		</tr>
		<tr>
			<th>网站状态</th>
			<td>
				<span class="inputword">开启</span>
				<input class="icheck" type="radio" name="WEB_STATUS" value="1" checked="checked">
				<span class="inputword">关闭</span>
				<input class="icheck" type="radio" name="WEB_STATUS" value="0">
			</td>
		</tr>
	</table>
</form>
</body>
</html>