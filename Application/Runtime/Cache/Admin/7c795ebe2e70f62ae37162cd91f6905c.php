<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>标签列表</title>
<script type="text/javascript" src="/thinkbjy/Public/static/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bootstrap-3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bootstrap-3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bjy.css">
<script type="text/javascript" src="/thinkbjy/Public/static/bootstrap-3.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/thinkbjy/Public/static/iCheck-1.0.2/icheck.min.js"></script>
<link rel="stylesheet" href="/thinkbjy/Public/static/iCheck-1.0.2/skins/all.css">
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
			<th>tid</th>
			<th>标签名</th>
			<th>操作</th>
		</tr>
	</thead>
	<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
			<td><?php echo ($v['tid']); ?></td>
			<td><?php echo ($v['tname']); ?></td>
			<td>
				<a href="<?php echo U('Admin/Tag/edit',array('tid'=>$v['tid']));?>">修改</a> | 
				<a href="javascript:if(confirm('确定要删除吗?')) location='<?php echo U('Admin/Tag/delete',array('tid'=>$v['tid']));?>'">删除</a>
			</td>
		</tr><?php endforeach; endif; ?>
</table>
</body>
</html>