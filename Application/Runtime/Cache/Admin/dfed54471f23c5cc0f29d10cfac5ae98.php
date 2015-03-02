<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改分类</title>
<script type="text/javascript" src="/Public/static/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="/Public/static/bjy.css">
<script type="text/javascript" src="/Public/static/bootstrap-3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<table class="table table-bordered table-hover">
	<form class="form-gropu" action="<?php echo U('Admin/Category/edit');?>" method="post">
		<input type="hidden" name="cid" value="<?php echo ($onedata['cid']); ?>">
		<tr>
			<th>分类名</th>
			<td><input class="form-control modal-sm" type="text" name="cname" value="<?php echo ($onedata['cname']); ?>"></td>
		</tr>
		<tr>
			<th>所属栏目</th>
			<td>
				<select class="form-control modal-sm" name="pid">
					<option value="0">顶级栏目</option>
					<?php if(is_array($data)): foreach($data as $k=>$v): ?><option value="<?php echo ($v['cid']); ?>" <?php if($onedata['pid'] == $v['cid']): ?>selected="selected"<?php endif; ?> ><?php echo ($v['_name']); ?></option><?php endforeach; endif; ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>排序</th>
			<td><input class="form-control modal-sm" type="text" name="sort" value="<?php echo ($onedata['sort']); ?>"></td>
		</tr>
		<tr>
			<th>关键词</th>
			<td><input class="form-control modal-sm" type="text" name="keyword" value="<?php echo ($onedata['keyword']); ?>"></td>
		</tr>
		<tr>
			<th>描述</th>
			<td>
				<textarea class="form-control modal-sm bjy-noresize" name="des"><?php echo ($onedata['des']); ?></textarea>
			</td>
		</tr>
		<tr>
			<th></th>
			<td><input class="btn btn-default" type="submit" value="提交"></td>
		</tr>
	</form>
</table>


</body>
</html>