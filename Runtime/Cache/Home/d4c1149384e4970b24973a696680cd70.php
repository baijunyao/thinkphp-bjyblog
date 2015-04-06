<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>白俊遥的个人博客</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
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

<link rel="stylesheet" href="/Template/default/Home/Public/css/index.css">
</head>
<body>
<!-- 顶部导航开始 -->
<div id="nav">
	<div class="b-inside">
		<div class="logo"><a href="<?php echo U('Home/Index/index');?>">帅白个人博客</a></div>
		<ul class="category">
			<li class="cname <?php if(!isset($_GET['cid'])): ?>action<?php endif; ?>" >
				<a href="<?php echo U('Home/Index/index');?>">首页</a>
			</li>
			<?php if(is_array($categorys)): foreach($categorys as $key=>$v): ?><li class="cname <?php if($_GET['cid']== $v['cid']): ?>action<?php endif; ?>">
					<a href="<?php echo U('Home/Index/category',array('cid'=>$v['cid']));?>"><?php echo ($v['cname']); ?></a>
				</li><?php endforeach; endif; ?>
		</ul>
		<ul class="user">
			<li class="login" data-toggle="modal" data-target="#myModal">登陆</li>
		</ul>
	</div>
</div>
<!-- 顶部导航结束 -->

<!-- 主体部分开始 -->
<div id="content">
	<div class="b-inside">
		<!-- 左侧列表开始 -->
		<div class="left">
			<div class="article">
				<h1 class="title"><?php echo ($article['title']); ?></h1>
				<ul class="metadata">
					<li class="date">发布时间：<?php echo (date('Y-m-d H:i:s',$article['addtime'])); ?></li>
					<li class="category">分类：<a href=""><?php echo ($article['category']['cname']); ?></a>
					<?php if(!empty($article['tag'])): ?><li class="tags ">标签：
							<?php if(is_array($article['tag'])): foreach($article['tag'] as $key=>$v): ?><a href="<?php echo U('Home/Index/tag',array('tid'=>$v['tid']));?>"><?php echo ($v['tname']); ?></a><?php endforeach; endif; ?>
						</li><?php endif; ?>							
				</ul>
				<div class="content-word">
					<?php echo ($article['content']); ?>
				</div>
			</div>
			<div class="comment">
				<!-- 畅言评论系统开始 -->
								<div id="cyEmoji" role="cylabs" data-use="emoji"></div>
				<div id="SOHUCS" sid="<?php echo ($_GET['aid']); ?>"></div>
				<script>
				  (function(){
				    var appid = 'cyrI0sOYy',
				    conf = 'prod_db0d542248694818e192f9d9d0d7a2c1';
				    var doc = document,
				    s = doc.createElement('script'),
				    h = doc.getElementsByTagName('head')[0] || doc.head || doc.documentElement;
				    s.type = 'text/javascript';
				    s.charset = 'utf-8';
				    s.src =  'http://assets.changyan.sohu.com/upload/changyan.js?conf='+ conf +'&appid=' + appid;
				    h.insertBefore(s,h.firstChild);
				    window.SCS_NO_IFRAME = true;
				  })()
				</script>
				<script type="text/javascript" charset="utf-8" src="http://changyan.itc.cn/js/??lib/jquery.js,changyan.labs.js?appid=cyrI0sOYy"></script>
				<!-- 畅言评论系统结束 -->
			</div>
		</div>
		<!-- 左侧列表结束 -->

		<!-- 右侧内容开始 -->
				<div class="right">
			<div class="tags">
				<h4 class="title">热门标签</h4>
				<ul class="tags-ul">
					<?php if(is_array($tags)): foreach($tags as $k=>$v): ?><li class="tname">
							<a class="tstyle-<?php echo ($k); ?>" href="<?php echo U('Home/Index/tag',array('tid'=>$v['tid']));?>"><?php echo ($v['tname']); ?></a>
						</li><?php endforeach; endif; ?>
				</ul>
			</div>

		</div>
		<!-- 右侧内容结束 -->
	</div>
</div>
<!-- 主体部分结束 -->

<!-- 通用底部文件开始 -->
<!-- 通用底部文件开始 -->
<div id="foot">
	<div class="b-inside">
		本站使用自主开发的<a href="">thinkbjy</a>开源博客程序搭建  © 2014-2015 baijunyao.com 版权所有 ICP证：豫ICP备14009546号-3
	</div>
</div>
<!-- 通用底部文件结束 -->
<!-- 通用底部文件结束 -->

</body>
</html>