<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>thinkbjy后台管理</title>
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

<link rel="stylesheet" type="text/css" href="/Template/default/Admin/Public/css/index.css">
<script type="text/javascript" src="/Template/default/Admin/Public/js/index.js"></script>
</head>
<body>
<!-- 顶部导航菜单开始 -->
<div id="nav-top">
	<div class="nt-logo">
		<a href="<?php echo U('Admin/Index/index');?>"></a>
		<span>Thinkbjy</span>
	</div>
	<ul class="nt-nav list-unstyled">
		<li class="ntn-li ntn-active">
			<span class="fa fa-list-ul nt-ico"></span>
			内容管理
		</li>
		<li class="ntn-li">
			<span class="fa fa-comments nt-ico"></span>
			碎言评论
		</li>
		<li class="ntn-li">
			<span class="fa fa-trash nt-ico"></span>
			回收管理
		</li>
		<li class="ntn-li">
			<span class="fa fa-cogs nt-ico"></span>
			网站设置
		</li>
	</ul>
	<ul class="nt-msg list-unstyled">
		<li class="nt-go-index">
			<a href="<?php echo U('Home/Index/index');?>" target="_blank"><span class="fa fa-home"></span>前台首页</a>
		</li>
		<li class="nt-sign-out">
			<a href="<?php echo U('Admin/Login/logout');?>"><span class="fa fa-sign-out"></span>退出</a>
		</li>
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
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Article/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>文章列表
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>
				<span class="fa fa-tags"></span>标签管理
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Tag/add');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>添加标签
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Tag/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>标签列表
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>
				<span class="fa fa-columns"></span>分类管理
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Category/add');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>添加分类
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Category/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>分类列表
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
		</dl>
	</div>
	<!-- 内容管理结束 -->

	<!-- 留言评论开始 -->
	<div class="nl-con">
		<dl>
			<dt>
				<span class="fa fa-comment-o"></span>评论管理
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Comment/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>评论列表
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>
				<span class="fa fa-list-alt"></span>随言碎语
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Chat/add');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>添加碎言
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Chat/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>碎言列表
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
		</dl>
	</div>
	<!-- 留言评论结束 -->

	<!-- 回收管理开始 -->
	<div class="nl-con">
		<dl>
			<dt>
				<span class="fa fa-trash-o"></span>回收管理
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Recycle/article');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>已删文章
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Recycle/chat');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>已删随言
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Recycle/link');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>已删友链
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
		</dl>
	</div>
	<!-- 回收管理结束 -->

	<!-- 网站设置开始 -->
	<div class="nl-con">
		<dl>
			<dt>
				<span class="fa fa-cog"></span>基本设置
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Config/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>网站信息
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Config/change_password');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>修改密码
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>
				<span class="fa fa-heart"></span>友情链接
			</dt>
			<dd>
				<a href="<?php echo U('Admin/Link/add');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>添加友链
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
			<dd>
				<a href="<?php echo U('Admin/Link/index');?>" target="right_content"></a>
				<span class="fa fa-caret-right"></span>友链列表
				<div class="nl-checked">
					<div class="nl-arrows"></div>
				</div>
			</dd>
		</dl>
	</div>
	<!-- 网站设置结束 -->
</div>
<!-- 左侧导航菜单结束 -->

<!-- 右侧内容开始 -->
<div id="content">
	<iframe id="content-iframe" src="<?php echo U('Admin/Index/welcome');?>" frameborder="0" width="100%" height="100%" name="right_content" scrolling="auto" frameborder="0" scrolling="no"></iframe>
</div>
<!-- 右侧内容结束 -->

</body>
</html>