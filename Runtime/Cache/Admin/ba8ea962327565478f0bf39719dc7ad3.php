<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>评论列表</title>
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

<style>

</style>
</head>
<body>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th width="5%">cmtid</th>
			<th width="20%">被评文章</th>
			<th width="15%">评论人</th>
			<th width="15%">评论时间</th>
			<th width="30%">评论内容</th>
			<th width="5%">审核</th>
			<th width="10%">操作</th>
		</tr>
	</thead>
	<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
			<td><?php echo ($v['cmtid']); ?></td>
			<td>
				<a href="<?php echo U('Home/Index/article',array('cid'=>isset($_GET['cid'])?$_GET['cid']:0,'tid'=>isset($_GET['tid'])?$_GET['tid']:0,'search_word'=>isset($_GET['search_word'])?$_GET['search_word']:0,'aid'=>$v['aid']));?>" target="_blank"><?php echo ($v['title']); ?></a>
			</td>
			<td><?php echo ($v['nickname']); ?></td>
			<td><?php echo date('Y-m-d H:i:s',$v['date']);?></td>
			<td><?php echo ($v['content']); ?></td>
			<th>
				<?php if(($v['status']) == "1"): ?>✔
				<?php else: ?>
					✘<?php endif; ?>
			</th>
			<td>
				<?php if((C("COMMENT_REVIEW")) == "1"): if(($v['status']) == "1"): ?><a href="<?php echo U('Admin/Comment/change_status',array('cmtid'=>$v['cmtid'],'status'=>0));?>">取消审核</a>
					<?php else: ?>
						<a href="<?php echo U('Admin/Comment/change_status',array('cmtid'=>$v['cmtid'],'status'=>1));?>">通过审核</a><?php endif; ?> |<?php endif; ?>
				<a href="javascript:if(confirm('确定要删除吗?')) location='<?php echo U('Admin/Recycle/recycle',array('table_name'=>'Comment','id_name'=>'cmtid','id_number'=>$v['cmtid']));?>'">删除</a>
			</td>
		</tr><?php endforeach; endif; ?>
</table>
<div style="text-align: center;">
	<?php echo ($page); ?>
</div>

</body>
</html>