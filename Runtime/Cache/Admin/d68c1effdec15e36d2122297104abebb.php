<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文章列表</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<script type="text/javascript" src="/Public/static/js/jquery-2.0.0.min.js"></script>
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

<style type="text/css">
</style>
</head>
<body>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th width="3%">aid</th>
			<th width="9%">所属栏目</th>
			<th width="20%">标题</th>
			<th width="8%">作者</th>
			<th width="22%">标签</th>
			<th width="4%">原创</th>
			<th width="4%">显示</th>
			<th width="4%">置顶</th>
			<th width="5%">点击数</th>
			<th width="13%">发布时间</th>
			<th width="8%">操作</th>
		</tr>
	</thead>
	<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
			<td><?php echo ($v['aid']); ?></td>
			<td><?php echo ($v['category']['cname']); ?></td>
			<td><a href="/article/<?php echo ($v['aid']); ?>" target="_blank"><?php echo ($v['title']); ?></a></td>
			<td><?php echo ($v['author']); ?></td>
			<td>
				<?php if(is_array($v['tag'])): foreach($v['tag'] as $key=>$n): echo ($n['tname']); ?>&nbsp;<?php endforeach; endif; ?>
			</td>
			<td>
				<?php if($v['is_original'] == 1): ?>✔
				<?php else: ?>
					✘<?php endif; ?>
			</td>
			<td>
				<?php if($v['is_show'] == 1): ?>✔
				<?php else: ?>
					✘<?php endif; ?>
			</td>
			<td>
				<?php if($v['is_top'] == 1): ?>✔
				<?php else: ?>
					✘<?php endif; ?>
			</td>
			<td><?php echo ($v['click']); ?></td>
			<td><?php echo (date('Y-m-d H:i:s',$v['addtime'])); ?></td>
			<td>
				<a href="<?php echo U('Admin/Article/edit',array('aid'=>$v['aid']));?>">修改</a> |
				<a href="javascript:if(confirm('确定要删除吗?')) location='<?php echo U('Admin/Recycle/recycle',array('table_name'=>'Article','id_name'=>'aid','id_number'=>$v['aid']));?>'">删除</a>
			</td>
		</tr><?php endforeach; endif; ?>
</table>
<div style="text-align: center;">
	<?php echo ($page); ?>
</div>

</body>
</html>