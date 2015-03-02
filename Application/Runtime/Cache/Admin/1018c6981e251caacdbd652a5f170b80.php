<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加标签</title>
<script type="text/javascript" src="/thinkbjy/Public/static/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bootstrap-3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bootstrap-3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bjy.css">
<script type="text/javascript" src="/thinkbjy/Public/static/bootstrap-3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<table class="table table-bordered table-striped table-hover table-condensed">
	<form action="<?php echo U('Admin/Tag/edit');?>" method="post">
		<input type="hidden" name="tid" value="<?php echo ($data['tid']); ?>">
		<tr>
			<th>标签名</th>
			<td>
				<input class="form-control modal-sm" type="text" name="tname" value="<?php echo ($data['tname']); ?>">
			</td>
		</tr>
		<tr>
			<th></th>
			<td>
				<input class="btn btn-default" type="submit" value="修改">
			</td>
		</tr>
	</form>
</table>
</body>
</html>