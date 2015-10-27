<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加文章</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/bootstrap-3.3.4/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/font-awesome-4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/css/bjy.css">
		<link rel="stylesheet" href="/Public/static/iCheck-1.0.2/skins/all.css">
</head>
<body>
<form class="form-group" action="<?php echo U('Admin/Article/add');?>" method="post">
	<table class="table table-bordered table-striped table-hover table-condensed">
		<tr>
			<th width="80px">所属分类</th>
			<td>
				<select class="form-control modal-sm" name="cid">
					<?php if(is_array($allCategory)): foreach($allCategory as $key=>$v): ?><option value="<?php echo ($v['cid']); ?>"><?php echo ($v['_name']); ?></option><?php endforeach; endif; ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>标题</th>
			<td>
				<input class="form-control modal-sm" type="text" name="title">
			</td>
		</tr>
		<tr>
			<th>作者</th>
			<td>
				<input class="form-control modal-sm" type="text" name="author" value="<?php echo (C("AUTHOR")); ?>">
			</td>
		</tr>
		<tr>
			<th>标签</th>
			<td>
				<?php if(is_array($allTag)): foreach($allTag as $key=>$v): ?><span class="inputword"><?php echo ($v['tname']); ?></span>
					<input class="icheck" type="checkbox" name="tids[]" value="<?php echo ($v['tid']); ?>">
					&emsp;<?php endforeach; endif; ?>
			</td>
		</tr>
		<tr>
			<th>关键词</th>
			<td>
				<input class="form-control modal-sm" placeholder="多个关键词用顿号分隔" type="text" name="keywords">
			</td>
		</tr>
		<tr>
			<th>描述</th>
			<td>
				<textarea class="form-control modal-sm" name="description" rows="7" placeholder="可以不填，如不填；则截取文章内容前300字为描述"></textarea>
			</td>
		</tr>
		<tr>
			<th>内容</th>
			<td>
			    <script id="container" name="content" type="text/plain"></script>
<script type="text/javascript" src="/Public/static/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/static/ueditor1_4_3/ueditor.all.js"></script>
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>
			</td>
		</tr>
		<tr>
			<th>是否原创</th>
			<td>
				<span class="inputword">是</span>
				<input class="icheck" type="radio" name="is_original" value="1" checked="checked">
				&emsp;
				<span class="inputword">否</span>
				<input class="icheck" type="radio" name="is_original" value="0">
			</td>
		</tr>
		<tr>
			<th>是否置顶</th>
			<td>
				<span class="inputword">是</span>
				<input class="icheck" type="radio" name="is_top" value="1">
				&emsp;
				<span class="inputword">否</span>
				<input class="icheck" type="radio" name="is_top" value="0" checked="checked">
			</td>
		</tr>
		<tr>
			<th>是否显示</th>
			<td>
				<span class="inputword">是</span>
				<input class="icheck" type="radio" name="is_show" value="1" checked="checked">
				&emsp;
				<span class="inputword">否</span>
				<input class="icheck" type="radio" name="is_show" value="0">
			</td>
		</tr>
		<tr>
			<th></th>
			<td>
				<input class="btn btn-default" type="submit" value="发表">
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript" src="/Public/static/js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="/Public/static/bootstrap-3.3.4/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/js/html5shiv.min.js"></script>
<script type="text/javascript" src="/Public/static/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="/Public/static/iCheck-1.0.2/icheck.min.js"></script>
<script>
$(document).ready(function(){
	$('.icheck').iCheck({
		checkboxClass: "icheckbox_square-blue",
		radioClass: "iradio_square-blue",
		increaseArea: "20%"
	});
});
</script>
</body>
</html>