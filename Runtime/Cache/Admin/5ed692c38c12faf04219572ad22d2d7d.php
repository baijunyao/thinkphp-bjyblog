<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>分类列表</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.4/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/font-awesome-4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/css/bjy.css">
</head>
<body>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th width="10%">cid</th>
			<th width="10%">排序</th>
			<th width="15%">分类名</th>
			<th width="25%">关键词</th>
			<th width="25%">描述</th>
			<th width="15%">操作</th>			
		</tr>
	</thead>
	<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
			<td><?php echo ($v['cid']); ?></td>
			<td>
				<input class="form-control" type="text" value="<?php echo ($v['sort']); ?>">
			</td>
			<td><?php echo ($v['_name']); ?></td>
			<td><?php echo ($v['keywords']); ?></td>
			<td><?php echo ($v['description']); ?></td>
			<td>
				<a href="<?php echo U('Admin/Category/add',array('cid'=>$v['cid']));?>">添加子分类</a> | 
				<a href="<?php echo U('Admin/Category/edit',array('cid'=>$v['cid']));?>">修改</a> | 
				<a href="javascript:if(confirm('确定要删除吗?')) location='<?php echo U('Admin/Category/delete',array('cid'=>$v['cid']));?>'">删除</a>				
			</td>
		</tr><?php endforeach; endif; ?>
</table>
<script type="text/javascript" src="/Public/static/js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="/Public/static/bootstrap-3.3.4/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/js/html5shiv.min.js"></script>
<script type="text/javascript" src="/Public/static/js/respond.min.js"></script>
<![endif]-->
</body>
</html>