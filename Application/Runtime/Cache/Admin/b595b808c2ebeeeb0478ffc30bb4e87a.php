<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>thinkbjy后台管理</title>
<script type="text/javascript" src="/thinkbjy/Public/static/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bootstrap-3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bootstrap-3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/static/bjy.css">
<script type="text/javascript" src="/thinkbjy/Public/static/bootstrap-3.3.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="/thinkbjy/Public/Admin/css/index.css">
<script type="text/javascript" src="/thinkbjy/Public/Admin/js/index.js"></script>
</head>
<body>
<!-- 顶部导航菜单开始 -->
<div id="nav-top">
	<div class="nt-logo">
		<a href=""></a>
		<span>Thinkbjy</span>
	</div>
	<ul class="nt-nav list-unstyled">
		<li class="ntn-li ntn-active">
			<span class="glyphicon glyphicon-list-alt nt-ico"></span>
			<br>
			内容管理
		</li>
		<li class="ntn-li">
			<span class="glyphicon glyphicon-comment nt-ico"></span>
			<br>
			留言评论
		</li>
		<li class="ntn-li">
			<span class="glyphicon glyphicon-trash nt-ico"></span>
			<br>
			回收管理
		</li>
		<li class="ntn-li">
			<span class="glyphicon glyphicon-cog nt-ico"></span>
			<br>
			网站设置
		</li>
	</ul>
	<ul class="nt-msg list-unstyled">
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
<!-- 顶部导航菜单结束 -->

<!-- 左侧导航菜单开始 -->
<div id="nav-left">
	<!-- 内容管理开始 -->
	<div class="nl-con nl-show">
		<dl>
			<dt>
				<span class="fa fa-th"></span>文章管理
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Article/add');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>添加文章
			</dd>			
			<dd>
				<a href="<?php echo U('Admin/Article/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>文章列表
			</dd>
		</dl>
		<dl>
			<dt>
				<span class="fa fa-tags"></span>标签管理
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Tag/add');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>添加标签
			</dd>			
			<dd>
				<a href="<?php echo U('Admin/Tag/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>标签列表
			</dd>
		</dl>
		<dl>
			<dt>
				<span class="fa fa-columns"></span>分类管理
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Category/add');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>添加分类
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Category/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>分类列表
			</dd>
		</dl>
	</div>	
	<!-- 内容管理结束 -->

	<!-- 留言评论开始 -->
	<div class="nl-con">
		<dl>
			<dt>
				<span class="fa fa-th"></span>评论管理
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Article/add');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>待审评论
			</dd>			
			<dd>
				<a href="<?php echo U('Admin/Article/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>已审评论
			</dd>
		</dl>
		<dl>
			<dt>
				<span class="fa fa-th"></span>留言管理
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Article/add');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>待审留言
			</dd>			
			<dd>
				<a href="<?php echo U('Admin/Article/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>已审留言
			</dd>
		</dl>
	</div>
	<!-- 留言评论结束 -->

	<!-- 回收管理开始 -->
	<div class="nl-con">
		<dl>
			<dt>
				<span class="fa fa-th"></span>回收管理
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Article/add');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>已删文章
			</dd>			
			<dd>
				<a href="<?php echo U('Admin/Article/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>已删评论
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Article/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>已删留言
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Article/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>已删链接
			</dd>
		</dl>
	</div>
	<!-- 回收管理结束 -->

	<!-- 网站设置开始 -->
	<div class="nl-con">
		<dl>
			<dt>
				<span class="fa fa-th"></span>友情链接
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Article/add');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>添加链接
			</dd>			
			<dd>
				<a href="<?php echo U('Admin/Article/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>链接列表
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Article/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>已删链接
			</dd>
		</dl>
	</div>
	<!-- 网站设置结束 -->
</div>
<!-- 左侧导航菜单结束 -->

<!-- 右侧内容开始 -->
<div id="content">
	<iframe src="<?php echo U('Admin/Index/welcome');?>" frameborder="0" width="100%" height="100%" name="right_content" scrolling="auto" frameborder="0" scrolling="no"></iframe>
</div>
<!-- 右侧内容结束 -->

</body>
</html>