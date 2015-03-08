<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改</title>

</head>
<body>

    <form action="<?php echo U('Admin/Article/add');?>" method="post">
    <table>
<script id="container" name="content" type="text/plain">
	
</script>
<script type="text/javascript" src="/thinkbjy/Public/static/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="/thinkbjy/Public/static/ueditor1_4_3/ueditor.all.js"></script>
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>
        <input type="submit" value="通过input的submit提交">    	
    </table>



    </form>	




</body>
</html>