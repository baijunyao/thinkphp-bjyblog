<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<!-- head头部分开始 -->
<head>
	<!-- head头部分开始 -->
	<meta charset="UTF-8">
	<title><?php echo ($article['current']['title']); ?>-<?php echo (C("WEB_NAME")); ?></title>
	<meta name="keywords" content="<?php echo ($article['current']['keywords']); ?>" />
	<meta name="description" content="<?php echo ($article['current']['description']); ?>" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta name="author" content="baijunyao,<?php echo (C("ADMIN_EMAIL")); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.4/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/font-awesome-4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/css/bjy.css">
	<script type="text/javascript">
		logoutUrl="<?php echo U('Home/User/logout');?>";
	</script>
	<link rel="stylesheet" type="text/css" href="/Template/default/Home/Public/css/index.css" />
	<?php echo (C("WEB_STATISTICS")); ?>
<!-- head头部分结束 -->

	<link rel="stylesheet" type="text/css" href="/Public/static/ueditor1_4_3/third-party/SyntaxHighlighter/shCoreDefault.css" />
	<?php echo (C("WEB_STATISTICS")); ?>
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
			<a class="navbar-brand" href="/">
				<ul class="b-logo-code">
					<li class="b-lc-start">&lt;?php</li>
					<li class="b-lc-echo">echo</li>
				</ul>
				<p class="b-logo-word">'白俊遥博客'</p>
				<p class="b-logo-end">;</p>
			</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav b-nav-parent">
				<li class="hidden-xs b-nav-mobile"></li>
				<li class="b-nav-cname <?php if(($cid) == "index"): ?>b-nav-active<?php endif; ?> " >
					<a href="/">首页</a>
				</li>
				<?php if(is_array($categorys)): foreach($categorys as $key=>$v): ?><li class="b-nav-cname <?php if(($cid) == $v['cid']): ?>b-nav-active<?php endif; ?> ">
						<a href="<?php echo U('category/'.$v['cid']);?>"><?php echo ($v['cname']); ?></a>
					</li><?php endforeach; endif; ?>
				<li class="b-nav-cname <?php if(($cid) == "chat"): ?>b-nav-active<?php endif; ?> ">
					<a href="/chat">随言碎语</a>
				</li>
				<li class="b-nav-cname hidden-sm">
					<a href="http://git.oschina.net/shuaibai123/thinkbjy" target="_blank" rel="nofollow">thinkbjy</a>
				</li>
			</ul>
			<ul id="b-login-word" class="nav navbar-nav navbar-right">
				<?php if(empty($_SESSION['user']['head_img'])): ?><li class="b-nav-login"><a href="javascript:;" onclick="login()">登陆</a></li>
				<?php else: ?>
					<li class="b-user-info">
						<span><img class="b-head_img" src="<?php echo ($_SESSION['user']['head_img']); ?>"/></span>
						<span class="b-nickname"><?php echo ($_SESSION['user']['nickname']); ?></span>
						<span><a href="javascript:;" onclick="logout()">退出</a></span>
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
		<div class="col-xs-12 col-md-12 col-lg-8">
			<div class="row b-article">
				<h1 class="col-xs-12 col-md-12 col-lg-12 b-title"><?php echo ($article['current']['title']); ?></h1>
				<div class="col-xs-12 col-md-12 col-lg-12">
					<ul class="row b-metadata">
						<li class="col-xs-5 col-md-2 col-lg-3"><i class="fa fa-user"></i> <?php echo ($article['current']['author']); ?></li>
						<li class="col-xs-7 col-md-3 col-lg-3"><i class="fa fa-calendar"></i> <?php echo (date('Y-m-d H:i:s',$article['current']['addtime'])); ?></li>
						<li class="col-xs-5 col-md-2 col-lg-2"><i class="fa fa-list-alt"></i> <a href="<?php echo U('Home/Index/category',array('cid'=>$v['cid']));?>"><?php echo ($article['current']['category']['cname']); ?></a>
						<?php if(!empty($article['current']['tag'])): ?><li class="col-xs-7 col-md-5 col-lg-4 "><i class="fa fa-tags"></i>
								<?php if(is_array($article['current']['tag'])): foreach($article['current']['tag'] as $key=>$v): ?><a class="b-tag-name" href="<?php echo U('Home/Index/tag',array('tid'=>$v['tid']));?>"><?php echo ($v['tname']); ?></a><?php endforeach; endif; ?>
							</li><?php endif; ?>
					</ul>
				</div>
				<div class="col-xs-12 col-md-12 col-lg-12 b-content-word">
					<?php echo ($article['current']['content']); ?>
					<?php if(($article['current']['is_original']) == "1"): ?><p class="b-h-20"></p>
						<p class="b-copyright">
							<?php echo (C("COPYRIGHT_WORD")); ?>
						</p><?php endif; ?>
					<ul class="b-prev-next">
						<li class="b-prev">
							上一篇：
							<?php if(empty($article['prev'])): ?><span>没有了</span>
							<?php else: ?>
								<a href="<?php echo ($article['prev']['url']); ?>"><?php echo ($article['prev']['title']); ?></a><?php endif; ?>
						</li>
						<li class="b-next">
							下一篇：
							<?php if(empty($article['next'])): ?><span>没有了</span>
							<?php else: ?>
								<a href="<?php echo ($article['next']['url']); ?>"><?php echo ($article['next']['title']); ?></a><?php endif; ?>
						</li>
					</ul>
				</div>
			</div>
			<!-- 引入通用评论开始 -->
			<!-- 通用评论开始 -->
<div class="row b-comment">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 b-comment-box">
		<img class="b-head-img" src="<?php if(empty($_SESSION['user']['head_img'])): ?>/Template/default/Home/Public/image/default_head_img.gif<?php else: echo ($_SESSION['user']['head_img']); endif; ?>" alt="白俊遥博客" title="白俊遥博客">
		<div class="b-box-textarea">
			<div class="b-box-content" contenteditable="true" onfocus="delete_hint(this)">请先登陆后发表评论</div>
			<ul class="b-emote-submit">
				<li class="b-emote">
					<i class="fa fa-smile-o" onclick="getTuzki(this)"></i>
					<div class="b-tuzki">

					</div>
				</li>
				<li class="b-submit-button">
					<input type="button" value="评 论" aid="<?php echo ($_GET['aid']); ?>" pid="0" onclick="comment(this)">
				</li>
				<li class="b-clear-float"></li>
			</ul>
		</div>
		<div class="b-clear-float"></div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 b-comment-title">
		<ul class="row">
			<li class="col-xs-6 col-sm-6 col-md-6 col-lg-6">最新评论</li>
			<li class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">总共<span><?php echo count($comment);?></span>条评论</li>
		</ul>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 b-user-comment">
		<?php if(is_array($comment)): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="row b-user b-parent">
				<div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 b-pic-col">
					<img class="b-user-pic" src="<?php echo ($v['head_img']); ?>" alt="白俊遥博客" title="白俊遥博客">
				</div>
				<div class="col-xs-10 col-sm-11 col-md-11 col-lg-11 b-content-col">
					<p class="b-content">
						<span class="b-user-name"><?php echo ($v['nickname']); ?></span>：<?php echo ($v['content']); ?>
					</p>
					<p class="b-date">
						<?php echo date('Y-m-d H:i:s',$v['date']);?> <a href="javascript:;" aid="<?php echo ($_GET['aid']); ?>" pid="<?php echo ($v['cmtid']); ?>" username="<?php echo ($v['nickname']); ?>" onclick="reply(this)">回复</a>
					</p>
					<?php if(is_array($v['child'])): foreach($v['child'] as $key=>$n): ?><div class="row b-user b-child">
							<div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 b-pic-col">
								<img class="b-user-pic" src="<?php echo ($n['head_img']); ?>" alt="白俊遥博客" title="白俊遥博客">
							</div>
							<ul class="col-xs-10 col-sm-11 col-md-11 col-lg-11 b-content-col">
								<li class="b-content">
									<span class="b-reply-name"><?php echo ($n['nickname']); ?></span>
									<span class="b-reply">回复</span>
									<span class="b-user-name"><?php echo ($n['reply_name']); ?></span>：<?php echo ($n['content']); ?>
								</li>
								<li class="b-date">
									<?php echo date('Y-m-d H:i:s',$n['date']);?> <a href="javascript:;" aid="<?php echo ($_GET['aid']); ?>" pid="<?php echo ($n['cmtid']); ?>" onclick="reply(this)">回复</a>
								</li>
								<li class="b-clear-float"></li>
							</ul>
						</div><?php endforeach; endif; ?>
					<div class="b-clear-float"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="b-border"></div>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>
<!-- 通用评论结束 -->

			<!-- 引入通用评论结束 -->
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
					<a class="tstyle-<?php echo ($tag_i); ?>" href="<?php echo U('tag/'.$v['tid']);?>" target="_blank"><?php echo ($v['tname']); ?></a>
				</li><?php endforeach; endif; ?>
		</ul>
	</div>
	<div class="b-recommend">
		<h4 class="b-title">置顶推荐</h4>
		<p class="b-recommend-p">
			<?php
 $recommend=M('Article')->field('aid,title')->where("is_show=1 and is_delete=0 and is_top=1")->limit(10)->select(); foreach ($recommend as $k => $field) { $url=U('Home/Index/article',array('aid'=>$field['aid'])); ?><a class="b-recommend-a" href="<?php echo U('article/'.$field['aid']);?>" target="_blank"><span class="fa fa-th-list b-black"></span> <?php echo ($field['title']); ?></a><?php } ?>
		</p>
	</div>
	<div class="b-link">
		<h4 class="b-title">友情链接</h4>
		<p>
			<?php if(is_array($links)): foreach($links as $k=>$v): ?><a class="b-link-a" href="<?php echo ($v[url]); ?>" target="_blank"><span class="fa fa-link b-black"></span> <?php echo ($v['lname']); ?></a><?php endforeach; endif; ?>
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
			本站使用自主开发的<a rel="nofollow" href="http://git.oschina.net/shuaibai123/thinkbjy" target="_blank">thinkbjy</a>开源博客程序搭建  © 2014-2015 baijunyao.com 版权所有 ICP证：豫ICP备14009546号-3
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
			<div class="col-xs-12 col-md-12 col-lg-12 b-login-row">
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

<!-- 引入bootstrjs部分开始 -->
<script type="text/javascript" src="/Public/static/js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="/Public/static/bootstrap-3.3.4/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/js/html5shiv.min.js"></script>
<script type="text/javascript" src="/Public/static/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="/Template/default/Home/Public/js/index.js"></script>
<!-- 引入bootstrjs部分结束 -->

<!-- 登陆框结束 -->

<script type="text/javascript" src="/Public/static/ueditor1_4_3/third-party/SyntaxHighlighter/shCore.js"></script>
<script type="text/javascript">
	SyntaxHighlighter.all();
	ajaxCommentUrl="<?php echo U('Home/Index/ajax_comment','','',true);?>";
	check_login="<?php echo U('Home/User/check_login','','',true);?>";
</script>
<script type="text/javascript" src="/Template/default/Home/Public/js/comment.js"></script>
</body>
</html>