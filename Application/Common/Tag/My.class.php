<?php

namespace Common\Tag;
use Think\Template\TagLib;

class My extends TagLib {
    // 定义标签
    protected $tags=array(
        'jquery'=>array('attr'=>'','close'=>0),
        'animate'=>array('attr'=>'','close'=>0),
        'bootstrapcss'=>array('','close'=>0),
        'bootstrapjs'=>array('','close'=>0),
        'icheckcss'=>array('','close'=>0),
        'icheckjs'=>array('attr'=>'icheck','close'=>0),
        'ueditor'=> array('attr'=>'name,content','close'=>0),
        'recommend'=>array('attr'=>'limit','level'=>1)
        );

    //引入jquery
    public function _jquery(){
        return '<script src="__PUBLIC__/static/js/jquery-2.0.0.min.js"></script>';
    }

    //引入animate
    public function _animate(){
        return '<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/css/animate.css">';
    }

    /**
    * bootstrap的css部分
    */
    public function _bootstrapcss(){
        $link=<<<php
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/font-awesome-4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/css/bjy.css">
    <link rel="stylesheet" type="text/css" href="__HOME_CSS__/index.css">
php;
        return $link;
    }

    /**
    * 引入jquery、bootstrap的js部分
    */
    public function _bootstrapjs(){
        $web_statistics=C('WEB_STATISTICS');
        $link=<<<php
<script src="__PUBLIC__/static/js/jquery-2.0.0.min.js"></script>
<script>
    logoutUrl="{:U('Home/User/logout')}";
</script>
<script src="__PUBLIC__/static/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="__PUBLIC__/static/js/html5shiv.min.js"></script>
<script src="__PUBLIC__/static/js/respond.min.js"></script>
<![endif]-->
<script src="__PUBLIC__/static/pace/pace.min.js"></script>
<script src="__HOME_JS__/index.js"></script>
<!-- 百度页面自动提交开始 -->
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<!-- 百度页面自动提交结束 -->

<!-- 百度统计开始 -->
$web_statistics
<!-- 百度统计结束 -->
php;
        return $link;
    }

    /**
    * 引入ickeck的css部分
    */
    public function _icheckcss(){
        $link=<<<php
    <link rel="stylesheet" href="__PUBLIC__/static/iCheck-1.0.2/skins/all.css">
php;
        return $link;
    }

    /**
    * 引入ickeck的js部分
    * @param string $tag  颜色主题
    */
    public function _icheckjs($tag){
        $color=isset($tag['color']) ? $tag['color'] : 'blue';
        $link=<<<php
<script src="__PUBLIC__/static/iCheck-1.0.2/icheck.min.js"></script>
<script>
$(document).ready(function(){
    $('.icheck').iCheck({
        checkboxClass: "icheckbox_square-$color",
        radioClass: "iradio_square-$color",
        increaseArea: "20%"
    });
});
</script>
php;
        return $link;
    }

    /**
    * 引入ueidter编辑器
    * @param string $tag  name:表单name content：编辑器初始化后 默认内容
    */
    public function _ueditor($tag){
        $name=isset($tag['name']) ? $tag['name'] : 'content';
        $content=isset($tag['content']) ? $tag['content'] : '';
        $link=<<<php
<script id="container" name="$name" type="text/plain">$content</script>
<script src="__PUBLIC__/static/ueditor1_4_3/ueditor.config.js"></script>
<script src="__PUBLIC__/static/ueditor1_4_3/ueditor.all.js"></script>
<script>
    var ue = UE.getEditor('container');
</script>
php;
        return $link;
    }

    // 置顶推荐文章标签 cid为空时则抓取全部分类下的推荐文章
    public function _recommend($tag,$content){
        if(empty($tag['cid'])){
            $where=array(
                'is_show'=>1,
                'is_delete'=>0,
                'is_top'=>1
                );
        }else{
            $where=array(
                'is_show'=>1,
                'is_delete'=>0,
                'is_top'=>1,
                'cid'=>$tag['cid']
                );
        }
        $limit=$tag['limit'];
        $php=<<<php
<?php
            \$recommend=M('Article')
                ->field('aid,title')
                ->where(\$where)
                ->order('aid desc')
                ->limit($limit)
                ->select();
            foreach (\$recommend as \$k => \$field) {
                \$url=U('Home/Index/article',array('aid'=>\$field['aid']));
?>
php;
        $php.=$content;
        $php.='<?php } ?>';//foreach的回扩;
        return $php;
     }



}
