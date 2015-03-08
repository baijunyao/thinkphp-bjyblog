<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加标签</title>
<bootstrap/>
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