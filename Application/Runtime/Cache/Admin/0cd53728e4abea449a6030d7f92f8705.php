<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>已删文章</title>
<script type="text/javascript" src="/Public/static/js/jquery-2.0.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="/Public/static/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/Public/static/css/bjy.css">
<script type="text/javascript" src="/Public/static/bootstrap-3.3.2/js/bootstrap.min.js"></script>
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
table {
    word-break:break-all;
    word-wrap:break-word;
}
</style>
</head>
<body>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th width="5%">aid</th>
			<th width="15%">所属分类</th>
			<th width="20%">作者</th>
			<th width="30%">标题</th>
			<th width="30%">操作</th>
		</tr>
	</thead>
	<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
			<td><?php echo ($v['aid']); ?></td>
			<td><?php echo ($v['cname']); ?></td>
			<td><?php echo ($v['author']); ?></td>
			<td><?php echo ($v['title']); ?></td>
			<td>
				<a href="<?php echo U('Admin/Article/recover',array('aid'=>$v['aid']));?>">恢复</a>
				<a href="javascript:if(confirm('确定要删除吗?')) location='<?php echo U('Admin/Article/delete',array('aid'=>$v['aid']));?>'">彻底删除</a>
			</td>
		</tr><?php endforeach; endif; ?>
</table>
</body>
</html>