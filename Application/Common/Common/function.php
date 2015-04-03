<?php  

header("Content-type:text/html;charset=utf-8");


//传递数据以易于阅读的样式格式化后输出
function p($data){
	echo "<hr /><pre>".print_r($data,true)."</pre><hr />";
}

/**
 * 删除指定的标签和内容
 * @param array $tags 需要删除的标签数组
 * @param string $str 数据源
 * @return string
 */
function strip_html_tags($tags,$str){
    foreach ($tags as $tag) {
        $p[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";
    }
    $return_str=preg_replace($p, "", $str);
    return $return_str;
}
//传递ueditor生成的内容获取其中图片的路径
function get_ueditor_image_path($str){
    $preg='/\/Upload\/image\/ueditor\/\d*\/\d*\.[jpg|jpeg|gif|png|bmp]*/i';
    preg_match_all($preg, $str,$data);
    return current($data);
}

/**
 * 字符串截取，支持中文和其他编码
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $suffix 截断显示字符
 * @param string $charset 编码格式
 * @return string
 */
function re_substr($str, $start=0, $length, $suffix=true, $charset="utf-8") {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'...' : $slice;
}

//传递图片路径根据配置项添加水印
function add_water($path){
    $image=new \Think\Image();
    if(C('WATER_TYPE')==1){
        $image->open('.'.$path)->text(C('TEXT_WATER_WORD'),C('TEXT_WATER_TTF_PTH'),C('TEXT_WATER_FONT_SIZE'),C('TEXT_WATER_COLOR'),C('TEXT_WATER_LOCATE'),0,C('TEXT_WATER_ANGLE'))->save('.'.$path);
    }elseif(C('WATER_TYPE')==2){
        $image->open('.'.$path)->water(C('IMAGE_WATER_PIC_PTAH'),C('IMAGE_WATER_LOCATE'),C('IMAGE_WATER_ALPHA'))->save('.'.$path);
    }elseif(C('WATER_TYPE')==3){
        $image->open('.'.$path)->text(C('TEXT_WATER_WORD'),C('TEXT_WATER_TTF_PTH'),C('TEXT_WATER_FONT_SIZE'),C('TEXT_WATER_COLOR'),C('TEXT_WATER_LOCATE'),0,C('TEXT_WATER_ANGLE'))->save('.'.$path);
        $image->open('.'.$path)->water(C('IMAGE_WATER_PIC_PTAH'),C('IMAGE_WATER_LOCATE'),C('IMAGE_WATER_ALPHA'))->save('.'.$path);
    }
}




