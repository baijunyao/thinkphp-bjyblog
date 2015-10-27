<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>已删碎言</title>
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
			<th width="5%">cmtid</th>
			<th width="10%">评论用户</th>
			<th width="15%">评论时间</th>
			<th width="50%">内容</th>
			<th width="10%">是否审核</th>
			<th width="10%">操作</th>
		</tr>
	</thead>
	<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
			<td><?php echo ($v['cmtid']); ?></td>
			<td><?php echo ($v['nickname']); ?></td>
			<td><?php echo (date('Y-m-d H:i:s',$v['date'])); ?></td>
			<td><?php echo ($v['content']); ?></td>
			<th>
				<?php if(($v['status']) == "1"): ?>✔
				<?php else: ?>
					✘<?php endif; ?>
			</th>
			<td>
				<a href="<?php echo U('Admin/Recycle/recover',array('table_name'=>'Comment','id_name'=>'cmtid','id_number'=>$v['cmtid']));?>">恢复</a> |
				<a href="javascript:if(confirm('确定要删除吗?')) location='<?php echo U('Admin/Recycle/delete',array('table_name'=>'Comment','id_name'=>'cmtid','id_number'=>$v['cmtid']));?>'">彻底删除</a>
			</td>
		</tr><?php endforeach; endif; ?>
</table>
<?php echo ($page); ?>
<script type="text/javascript" src="/Public/static/js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="/Public/static/bootstrap-3.3.4/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/js/html5shiv.min.js"></script>
<script type="text/javascript" src="/Public/static/js/respond.min.js"></script>
<![endif]-->
</body>
</html>