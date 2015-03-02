<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>分类列表</title>
<script type="text/javascript" src="/thinkbjy/Public/static/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bootstrap-3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bootstrap-3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bjy.css">
<script type="text/javascript" src="/thinkbjy/Public/static/bootstrap-3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th width="10%">cid</th>
			<th width="10%">排序</th>
			<th width="20%">分类名</th>
			<th width="25%">关键词</th>
			<th width="25%">描述</th>
			<th width="10%">操作</th>			
		</tr>
	</thead>
	<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
			<td><?php echo ($v['cid']); ?></td>
			<td>
				<input class="form-control" type="text" value="<?php echo ($v['sort']); ?>">
			</td>
			<td><?php echo ($v['_name']); ?></td>
			<td><?php echo ($v['keyword']); ?></td>
			<td><?php echo ($v['des']); ?></td>
			<td>
				<a href="<?php echo U('Admin/Category/edit',array('cid'=>$v['cid']));?>">修改</a> | 
				<a href="javascript:if(confirm('确定要删除吗?')) location='<?php echo U('Admin/Category/delete',array('cid'=>$v['cid']));?>'">删除</a>				
			</td>
		</tr><?php endforeach; endif; ?>
</table>
</body>
</html>