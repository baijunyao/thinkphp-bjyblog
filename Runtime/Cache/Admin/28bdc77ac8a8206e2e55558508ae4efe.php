<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加友情链接</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="/Public/static/js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="/Public/static/js/jquery.cookie.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.4/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="/Public/static/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/Public/static/css/bjy.css">
<script type="text/javascript" src="/Public/static/bootstrap-3.3.4/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/js/html5shiv.min.js"></script>
<script type="text/javascript" src="/Public/static/js/respond.min.js"></script>
<![endif]-->
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
<form class="form-group" action="<?php echo U('Admin/Link/add');?>" method="post">
	<table class="table table-bordered table-striped table-hover table-condensed">
		<tr>
			<th>链接名</th>
			<td>
				<input class="form-control modal-sm" type="text" name="lname">
			</td>
		</tr>
		<tr>
			<th>链接地址</th>
			<td>
				<input class="form-control modal-sm" type="text" name="url">
			</td>
		</tr>
		<tr>
			<th>排序</th>
			<td>
				<input class="form-control modal-sm" type="text" name="sort">
			</td>
		</tr>
		<tr>
			<th>是否显示</th>
			<td>
				<span class="inputword">是</span>
				<input id="test" class="icheck" type="radio" name="is_show" value="1" checked="checked">
				&emsp;
				<span class="inputword">否</span>
				<input class="icheck" type="radio" name="is_show" value="0">				
			</td>
		</tr>
		<tr>
			<th></th>
			<td>
				<input class="btn btn-default" type="submit" value="添加">
			</td>
		</tr>
	</table>
</form>
</body>
</html>