<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<!-- head头部分开始 -->
<head>
<!-- head头部分开始 -->
	<meta charset="UTF-8">
	<title>随言碎语-<?php echo (C("WEB_NAME")); ?></title>
	<meta name="keywords" content="<?php echo (C("WEB_KEYWORDS")); ?>" />
	<meta name="description" content="<?php echo (C("WEB_DESCRIPTION")); ?>" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta name="author" content="baijunyao,<?php echo (C("ADMIN_EMAIL")); ?>">
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

	<script type="text/javascript">
		saveLoginUrl="<?php echo U('Home/User/save_login_url');?>";
		logoutUrl="<?php echo U('Home/User/logout');?>";
	</script>
	<script type="text/javascript" src="/Template/default/Home/Public/js/index.js"></script>
	<link rel="stylesheet" href="/Template/default/Home/Public/css/index.css">
	<?php echo (C("WEB_STATISTICS")); ?>
<!-- head头部分结束 -->

<script type="text/javascript" src="/Template/default/Home/Public/js/chat.js"></script>
</head>
<!-- head头部分结束 -->
<body>
<!-- 顶部导航开始 -->
<!-- 顶部导航开始 -->
<header id="b-public-nav" class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo U('Home/Index/index');?>">
				<ul class="b-logo-code">
					<li class="b-lc-start">&lt;?php</li>
					<li class="b-lc-echo">echo</li>
				</ul>
				<p class="b-logo-word">'白俊遥博客'</p>
				<p class="b-logo-end">;</p>
			</a>
			<!-- <a class="b-logo-a" href="<?php echo U('Home/Index/index');?>"></a> -->
			<!-- <a class="navbar-brand" href="<?php echo U('Home/Index/index');?>">白俊遥博客</a> -->
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<?php if(is_array($categorys)): foreach($categorys as $key=>$v): ?><li class="b-nav-cname <?php if(($cid) == "index"): ?>b-nav-active<?php endif; ?> " >
						<a href="<?php echo U('Home/Index/index');?>">首页</a>
					</li>
					<li class="b-nav-cname <?php if(($cid) == $v['cid']): ?>b-nav-active<?php endif; ?> ">
						<a href="<?php echo U('Home/Index/category',array('cid'=>$v['cid']));?>"><?php echo ($v['cname']); ?></a>
					</li><?php endforeach; endif; ?>
				<li class="b-nav-cname <?php if(($cid) == "chat"): ?>b-nav-active<?php endif; ?> ">
					<a href="<?php echo U('Home/Chat/index');?>">随言碎语</a>
				</li>
			</ul>
			<ul id="b-login-word" class="nav navbar-nav navbar-right">
				<?php if(empty($_SESSION['user']['head_img'])): ?><li class="b-nav-cname"><a href="#b-modal-login" data-toggle="modal">登陆</a></li>
				<?php else: ?>
					<li class="b-user-info">
						<span><img class="b-head_img" src="<?php echo ($_SESSION['user']['head_img']); ?>"/></span>
						<span class="b-nickname"><?php echo ($_SESSION['user']['nickname']); ?></span>
						<span><a href="<?php echo U('Home/User/logout');?>">退出</a></span>
					</li><?php endif; ?>
			</ul>
		</div>
	</div>
</header>
<!-- 顶部导航结束 -->

<!-- 顶部导航结束 -->
<div class="b-h-70"></div>
<!-- 主体部分开始 -->
<div id="b-content" class="container">
	<div class="row">
		<!-- 左侧文章开始 -->
		<div class="col-xs-12 col-md-12 col-lg-8 b-chat">
			<div class="b-chat-left">
				<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if(($mod) == "0"): ?><ul class="b-chat-one ">
							<li class="b-chat-title "><?php echo (date('Y-m-d H:i:s',$v['date'])); ?></li>
							<li class="b-chat-content"><?php echo ($v['content']); ?></li>
							<div class="b-arrows-right1">
								<div class="b-arrows-round"></div>
							</div>
							<div class="b-arrows-right2"></div>
						</ul><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="b-chat-middle"></div>
			<div class="b-chat-right">
				<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if(($mod) == "1"): ?><ul class="b-chat-one ">
							<li class="b-chat-title "><?php echo (date('Y-m-d H:i:s',$v['date'])); ?></li>
							<li class="b-chat-content"><?php echo ($v['content']); ?></li>
							<div class="b-arrows-right1">
								<div class="b-arrows-round"></div>
							</div>
							<div class="b-arrows-right2"></div>
						</ul><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<!-- 左侧文章结束 -->

		<!-- 通用右侧开始 -->
		<!-- 通用右部区域开始 -->
<div id="b-public-right" class="col-lg-4 hidden-xs hidden-sm hidden-md">
	<div class="b-tags">
		<h4 class="b-title">热门标签</h4>
		<ul class="b-all-tname">
			<?php $tag_i=0 ?>
			<?php if(is_array($tags)): foreach($tags as $k=>$v): $tag_i++ ?>
				<?php $tag_i=$tag_i==5?1:$tag_i ?>
				<li class="b-tname">
					<a class="tstyle-<?php echo ($tag_i); ?>" href="<?php echo U('Home/Index/tag',array('tid'=>$v['tid']));?>" target="_blank"><?php echo ($v['tname']); ?></a>
				</li><?php endforeach; endif; ?>
		</ul>
	</div>
	<div class="b-recommend">
		<h4 class="b-title">置顶推荐</h4>
		<p class="b-recommend-p">
			<?php
 $recommend=M('Article')->field('aid,title')->where("is_show=1 and is_delete=0 and is_top=1")->limit(10)->select(); foreach ($recommend as $k => $field) { $url=U('Home/Index/article',array('aid'=>$field['aid'])); ?><a class="b-recommend-a" href="<?php echo U('Home/Index/article',array('aid'=>$field['aid']));?>" target="_blank"><span class="fa fa-th-list b-black"></span> <?php echo ($field['title']); ?></a><?php } ?>
		</p>
	</div>
	<div class="b-link">
		<h4 class="b-title">友情链接</h4>
		<p class="link-p">
			<?php if(is_array($links)): foreach($links as $k=>$v): ?><a class="link-a" href="<?php echo ($v[url]); ?>" target="_blank"><span class="fa fa-link b-black"></span> <?php echo ($v['lname']); ?></a><?php endforeach; endif; ?>
		</p>
	</div>
	<div class="b-search">
		<form class="form-inline"  role="form" action="<?php echo U('Home/Index/search');?>" method="get">
			<input class="b-search-text" type="text" name="search_word">
			<input class="b-search-submit" type="submit" value="全站搜索">
		</form>
	</div>
</div>
<!-- 通用右部区域结束 -->

		<!-- 通用右侧结束 -->
	</div>
	<div class="row">
		<!-- 底部文件开始 -->
		<!-- 通用底部文件开始 -->
<footer id="b-foot" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<ul>
		<li class="text-center">
			本站使用自主开发的<a href="http://git.oschina.net/shuaibai123/thinkbjy" target="_blank">thinkbjy</a>开源博客程序搭建  © 2014-2015 baijunyao.com 版权所有 ICP证：豫ICP备14009546号-3
		</li>
		<li class="text-center">
			联系邮箱：<?php echo (C("ADMIN_EMAIL")); ?>
		</li>
	</ul>
	<div class="b-h-20"></div>
	<a class="go-top fa fa-angle-up" href="javascript:;" onclick="goTop()"></a>
</footer>
<!-- 通用底部文件结束 -->

		<!-- 通用底部文件结束 -->
	</div>
</div>
<!-- 主体部分结束 -->

<!-- 登陆框开始 -->
<!-- 登录模态框开始 -->
<div class="modal fade" id="b-modal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title b-ta-center" id="myModalLabel">无需注册，用以下帐号即可直接登录</h4>
				</div>
			</div>
			<div class="col-xs-12 col-md-12 col-lg-12">
				<ul class="row">
					<li class="col-xs-6 col-md-4 col-lg-4 b-login-img">
						<a href="<?php echo U('Home/User/oauth_login',array('type'=>'qq'));?>"><img src="/Template/default/Home/Public/image/qq-login.png" alt=""></a>
					</li>
					<li class="col-xs-6 col-md-4 col-lg-4 b-login-img">
						<a href="<?php echo U('Home/User/oauth_login',array('type'=>'sina'));?>"><img src="/Template/default/Home/Public/image/sina-login.png" alt=""></a>
					</li>
					<li class="col-xs-6 col-md-4 col-lg-4 b-login-img">
						<a href="<?php echo U('Home/User/oauth_login',array('type'=>'douban'));?>"><img src="/Template/default/Home/Public/image/douban-login.png" alt=""></a>
					</li>
					<li class="col-xs-6 col-md-4 col-lg-4 b-login-img">
						<a href="<?php echo U('Home/User/oauth_login',array('type'=>'renren'));?>"><img src="/Template/default/Home/Public/image/renren-login.png" alt=""></a>
					</li>
					<li class="col-xs-6 col-md-4 col-lg-4 b-login-img">
						<a href="<?php echo U('Home/User/oauth_login',array('type'=>'kaixin'));?>"><img src="/Template/default/Home/Public/image/kaixin-login.png" alt=""></a>
					</li>
					<li class="col-xs-6 col-md-4 col-lg-4 b-login-img">
						<a href="<?php echo U('Home/User/oauth_login',array('type'=>''));?>"><img src="" alt=""></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- 登录模态框结束 -->

<!-- 登陆框结束 -->
</body>
</html>