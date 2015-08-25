<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>欢迎页面</title>
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

<link rel="stylesheet" href="/Template/default/Admin/Public/css/index.css">
</head>
<body>
<div id="welcome">
	<div class="block">
		<h3 class="title">文章统计</h3>
		<ul class="content">
			<li>文章总数：<?php echo ($all_article); ?></li>
			<li>已删文章数：<?php echo ($delete_article); ?></li>
			<li>不显示的文章数：<?php echo ($hide_article); ?></li>
		</ul>
	</div>
	<div class="block">
		<h3 class="title">随言碎语统计</h3>
		<ul class="content">
			<li>随言总数：<?php echo ($all_chat); ?></li>
			<li>已删随言数：<?php echo ($delete_chat); ?></li>
			<li>不显示的随言数：<?php echo ($hide_chat); ?></li>
		</ul>
	</div>
	<div class="block">
		<h3 class="title">评论统计</h3>
		<ul class="content">
			<li>评论总数：<?php echo ($all_comment); ?></li>
		</ul>
	</div>
	<div class="block">
		<h3 class="title">其他数据</h3>
		<table>
			<tr>
				<th>P H P 版 本：</th>
				<td><?php echo PHP_VERSION;?></td>
			</tr>
			<tr>
				<th>MySQL版本：</th>
				<td><?php echo mysql_get_server_info();?></td>
			</tr>
			<tr>
				<th width="100px">服务器 信息：</th>
				<td><?php echo PHP_OS;?></td>
			</tr>
			<tr>
				<th>Apache版本：</th>
				<td><?php echo apache_get_version();?></td>
			</tr>
			<tr>
				<th>thinkbjy版本：</th>
				<td><?php echo (C("THINK_INFORMATION")); ?></td>
			</tr>
		</table>
	</div>
</div>
</body>
</html>