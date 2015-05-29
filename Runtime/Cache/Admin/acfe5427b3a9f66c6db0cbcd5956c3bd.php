<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>已删碎言</title>
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

</head>
<body>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th width="5%">chid</th>
			<th width="20%">发表时间</th>
			<th width="60%">内容</th>
			<th width="5%">显示</th>
			<th width="10%">操作</th>			
		</tr>
	</thead>
	<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
			<td><?php echo ($v['chid']); ?></td>
			<td><?php echo (date('Y-m-d H:i:s',$v['time'])); ?></td>
			<td><?php echo ($v['content']); ?></td>
			<th>
				<?php if($v['is_show'] == 1): ?>✔
				<?php else: ?>
					✘<?php endif; ?>
			</th>
			<td>
				<a href="<?php echo U('Admin/Chat/edit',array('chid'=>$v['chid']));?>">修改</a> | 
				<a href="javascript:if(confirm('确定要删除吗?')) location='<?php echo U('Admin/Chat/delete',array('chid'=>$v['chid']));?>'">删除</a>				
			</td>
		</tr><?php endforeach; endif; ?>
</table>
</body>
</html>