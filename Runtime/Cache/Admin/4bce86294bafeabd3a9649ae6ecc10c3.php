<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>全部用户</title>
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
			<th width="5%">id</th>
			<th width="10%">来源</th>
			<th width="15%">用户名</th>
			<th width="15%">创建时间</th>
			<th width="30%">最后登录时间</th>
			<th width="15%">登录次数</th>
		</tr>
	</thead>
	<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
			<td><?php echo ($v['id']); ?></td>
			<td><?php echo ($v['type']); ?></td>
			<td><?php echo ($v['nickname']); ?></td>
			<td><?php echo date('Y-m-d H:i:s',$v['create_time']);?></td>
			<td><?php echo date('Y-m-d H:i:s',$v['last_login_time']);?></td>
			<th><?php echo ($v['login_times']); ?></th>
		</tr><?php endforeach; endif; ?>
</table>
<div style="text-align: center;">
	<?php echo ($page); ?>
</div>
<script type="text/javascript" src="/Public/static/js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="/Public/static/bootstrap-3.3.4/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/js/html5shiv.min.js"></script>
<script type="text/javascript" src="/Public/static/js/respond.min.js"></script>
<![endif]-->
</body>
</html>