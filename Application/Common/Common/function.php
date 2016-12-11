<?php

header("Content-type:text/html;charset=utf-8");

//传递数据以易于阅读的样式格式化后输出
function p($data){
    // 定义样式
    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data)) {
        $show_data=$data ? 'true' : 'false';
    }elseif (is_null($data)) {
        $show_data='null';
    }else{
        $show_data=print_r($data,true);
    }
    $str.=$show_data;
    $str.='</pre>';
    echo $str;
}

/**
 * 删除指定的标签和内容
 * @param array $tags 需要删除的标签数组
 * @param string $str 数据源
 * @param string $content 是否删除标签内的内容 0保留内容 1不保留内容
 * @return string
 */
function strip_html_tags($tags,$str,$content=0){
    if($content){
        $html=array();
        foreach ($tags as $tag) {
            $html[]='/(<'.$tag.'.*?>[\s|\S]*?<\/'.$tag.'>)/';
        }
        $data=preg_replace($html,'',$str);
    }else{
        $html=array();
        foreach ($tags as $tag) {
            $html[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";
        }
        $data=preg_replace($html, '', $str);
    }
    return $data;
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
        $re['gbk']  = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'...' : $slice;
}

/**
 * 传递图片路径根据配置项添加水印
 * @param string $path 图片路径
 */
function add_water($path){
    // 获取文件后缀
    $type=strtolower(pathinfo($path,PATHINFO_EXTENSION));
    // 不对gif加水印
    if ($type==='gif') {
        return true;
    }
    $image=new \Think\Image();
    if(C('WATER_TYPE')==1){
        // 添加文字水印
        $image->open($path)->text(C('TEXT_WATER_WORD'),C('TEXT_WATER_TTF_PTH'),C('TEXT_WATER_FONT_SIZE'),C('TEXT_WATER_COLOR'),C('TEXT_WATER_LOCATE'),0,C('TEXT_WATER_ANGLE'))->save($path);
    }elseif(C('WATER_TYPE')==2){
        // 添加图片水印
        $image->open($path)->water(C('IMAGE_WATER_PIC_PTAH'),C('IMAGE_WATER_LOCATE'),C('IMAGE_WATER_ALPHA'))->save($path);
    }elseif(C('WATER_TYPE')==3){
        // 添加图片和文字水印
        $image->open($path)->text(C('TEXT_WATER_WORD'),C('TEXT_WATER_TTF_PTH'),C('TEXT_WATER_FONT_SIZE'),C('TEXT_WATER_COLOR'),C('TEXT_WATER_LOCATE'),0,C('TEXT_WATER_ANGLE'))->save($path);
        $image->open($path)->water(C('IMAGE_WATER_PIC_PTAH'),C('IMAGE_WATER_LOCATE'),C('IMAGE_WATER_ALPHA'))->save($path);
    }
}

// 设置验证码
function show_verify($config=''){
    if($config==''){
        $config=array(
            'codeSet'=>'1234567890',
            'fontSize'=>30,
            'useCurve'=>false,
            'imageH'=>60,
            'imageW'=>240,
            'length'=>4,
            'fontttf'=>'4.ttf',
            );
    }
    $verify=new \Think\Verify($config);
    return $verify->entry();
}

// 检测验证码
function check_verify($code){
    $verify=new \Think\Verify();
    return $verify->check($code);
}

/**
 * 取得根域名
 * @param type $domain 域名
 * @return string 返回根域名
 */
function getUrlToDomain($domain) {
    $re_domain = '';
    $domain_postfix_cn_array = array("com", "net", "org", "gov", "edu", "com.cn", "cn");
    $array_domain = explode(".", $domain);
    $array_num = count($array_domain) - 1;
    if ($array_domain[$array_num] == 'cn') {
        if (in_array($array_domain[$array_num - 1], $domain_postfix_cn_array)) {
            $re_domain = $array_domain[$array_num - 2] . "." . $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        } else {
            $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        }
    } else {
        $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
    }
    return $re_domain;
}

/**
 * 按符号截取字符串的指定部分
 * @param string $str 需要截取的字符串
 * @param string $sign 需要截取的符号
 * @param int $number 如是正数以0为起点从左向右截  负数则从右向左截
 * @return string 返回截取的内容
 */
/*  示例
    $str='123/456/789';
    cut_str($str,'/',0);  返回 123
    cut_str($str,'/',-1);  返回 789
    cut_str($str,'/',-2);  返回 456
    具体参考 http://baijunyao.com/article/18
*/
function cut_str($str,$sign,$number){
    $array=explode($sign, $str);
    $length=count($array);
    if($number<0){
        $new_array=array_reverse($array);
        $abs_number=abs($number);
        if($abs_number>$length){
            return 'error';
        }else{
            return $new_array[$abs_number-1];
        }
    }else{
        if($number>=$length){
            return 'error';
        }else{
            return $array[$number];
        }
    }
}

/**
 * 发送邮件
 * @param  string $address 需要发送的邮箱地址
 * @param  string $subject 标题
 * @param  string $content 内容
 * @return boolean         是否成功
 */
function send_email($address,$subject,$content){
    $email_smtp=C('EMAIL_SMTP');
    $email_username=C('EMAIL_USERNAME');
    $email_password=C('EMAIL_PASSWORD');
    $email_from_name=C('EMAIL_FROM_NAME');
    if(empty($email_smtp) || empty($email_username) || empty($email_password) || empty($email_from_name)){
        return array("error"=>1,"message"=>'邮箱配置不完整');
    }
    require './ThinkPHP/Library/Org/Bjy/class.phpmailer.php';
    require './ThinkPHP/Library/Org/Bjy/class.smtp.php';
    $phpmailer=new \Phpmailer();
    // 设置PHPMailer使用SMTP服务器发送Email
    $phpmailer->IsSMTP();
    // 设置为html格式
    $phpmailer->IsHTML(true);
    // 设置邮件的字符编码'
    $phpmailer->CharSet='UTF-8';
    // 设置SMTP服务器。
    $phpmailer->Host=$email_smtp;
    // 设置为"需要验证"
    $phpmailer->SMTPAuth=true;
    // 设置用户名
    $phpmailer->Username=$email_username;
    // 设置密码
    $phpmailer->Password=$email_password;
    // 设置邮件头的From字段。
    $phpmailer->From=$email_username;
    // 设置发件人名字
    $phpmailer->FromName=$email_from_name;
    // 添加收件人地址，可以多次使用来添加多个收件人
    $phpmailer->AddAddress($address);
    // 设置邮件标题
    $phpmailer->Subject=$subject;
    // 设置邮件正文
    $phpmailer->Body=$content;

    // 发送邮件。
    if(!$phpmailer->Send()) {
        $phpmailererror=$phpmailer->ErrorInfo;
        return array("error"=>1,"message"=>$phpmailererror);
    }else{
        return array("error"=>0);
    }
}

// 用于评论系统的自定义排序功能
function comment_sort($a,$b){
    $prev = isset($a['date']) ? $a['date'] : 0;
    $next = isset($b['date']) ? $b['date'] : 0;
    if($prev == $next)return 0;
    return ($prev<$next) ? -1 : 1;
}

/**
 * 生成不重复的随机数
 * @param  int $start  需要生成的数字开始范围
 * @param  int $end    结束范围
 * @param  int $length 需要生成的随机数个数
 * @return array       生成的随机数
 */
function get_rand_number($start=1,$end=10,$length=4){
    $connt=0;
    $temp=array();
    while($connt<$length){
        $temp[]=mt_rand($start,$end);
        $data=array_unique($temp);
        $connt=count($data);
    }
    sort($data);
    return $data;
}

/**
 * 传递ueditor生成的内容获取其中图片的路径
 * @param  string $str 含有图片链接的字符串
 * @return array       匹配的图片数组
 */
function get_ueditor_image_path($str){
    $preg='/\/Upload\/image\/ueditor\/\d*\/\d*\.[jpg|jpeg|png|bmp|gif]*/i';
    preg_match_all($preg, $str,$data);
    return current($data);
}

/**
 * 将ueditor存入数据库的文章中的图片绝对路径转为相对路径
 * @param  string $content 文章内容
 * @return string          转换后的数据
 */
function preg_ueditor_image_path($data){
    // 兼容图片路径
    $root_path=rtrim($_SERVER['SCRIPT_NAME'],'/index.php');
    // 正则替换图片
    $data=htmlspecialchars_decode($data);
    $data=preg_replace('/src=\"^\/.*\/Upload\/image\/ueditor$/','src="'.$root_path.'/Upload/image/ueditor',$data);
    return $data;
}


/**
 * 将字符串分割为数组    
 * @param  string $str 字符串
 * @return array       分割得到的数组
 */
function mb_str_split($str){
    return preg_split('/(?<!^)(?!$)/u', $str );
}

/**
 * 获取访问用户ip
 */
function get_ip(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

/**
 * 将U函数生成的链接转换为路由链接
 * @param string $url U函数生成的链接
 */
function RU($url){
    // 兼容 category/:cid\d 路由
    if(preg_match('/\/Home\/Index\/category\/cid\/\d+/', $url)){
        $url=str_replace(array('/Home/Index','/cid'), '', $url);
    }
    // 兼容 tag/:tid\d 路由
    if(preg_match('/\/Home\/Index\/tag\/tid\/\d+/', $url)) {
        $url=str_replace(array('/Home/Index','/tid'), '', $url);
    }
    // 兼容article/cid/:cid\d/:aid\d
    if(preg_match('/\/Home\/Index\/article\/cid\/\d+\/aid\/\d+/', $url)){
        $url=str_replace(array('/Home/Index','/aid'), '', $url);
    }
    // 兼容 article/tid/:tid\d/:aid\d
    if(preg_match('/\/Home\/Index\/article\/tid\/\d+\/aid\/\d+/', $url)){
        $url=str_replace(array('/Home/Index','/aid'), '', $url);
    }
    // 兼容 article/sw/:search_word\S/:aid\d
    if(preg_match('/\/Home\/Index\/article\/search_word\/\S+\/aid\/\d+/', $url)){
        $url=str_replace(array('/Home/Index','/aid'), '', $url);
        $url=str_replace('search_word', 'sw', $url);
    }
    // 兼容 article/:aid\d=>Index/article
    if(preg_match('/\/Home\/Index\/article\/aid\/\d+/', $url)){
        $url=str_replace(array('/Home/Index','/aid'), '', $url);
    }
    // 兼容 index/:p\d=>'Index/index
    if(preg_match('/\/Home\/Index\/index\/p/', $url)){
        $url=str_replace('/Home/Index', '', $url);
        $url=str_replace('/p', '', $url);
    }
    // 兼容 chat
    if($url=='/Home/Index/chat'){
        $url='/chat';
    }
    // 兼容 git
    if($url=='/Home/Index/git'){
        $url='/git';
    }
    return $url;
}

/**
 * 使用curl获取远程数据
 * @param  string $url url连接
 * @return string      获取到的数据
 */
function curl_get_contents($url){
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);                //设置访问的url地址
    // curl_setopt($ch,CURLOPT_HEADER,1);               //是否显示头部信息
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);               //设置超时
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);   //用户访问代理 User-Agent
    curl_setopt($ch, CURLOPT_REFERER,$_SERVER['HTTP_HOST']);        //设置 referer
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);          //跟踪301
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
    $r=curl_exec($ch);
    curl_close($ch);
    return $r;
}

/**
 * 传入时间戳,计算距离现在的时间
 * @param  number $time 时间戳
 * @return string     返回多少以前
 */
function word_time($time) {
    $time = (int) substr($time, 0, 10);
    $int = time() - $time;
    $str = '';
    if ($int <= 2){
        $str = sprintf('刚刚', $int);
    }elseif ($int < 60){
        $str = sprintf('%d秒前', $int);
    }elseif ($int < 3600){
        $str = sprintf('%d分钟前', floor($int / 60));
    }elseif ($int < 86400){
        $str = sprintf('%d小时前', floor($int / 3600));
    }elseif ($int < 1728000){
        $str = sprintf('%d天前', floor($int / 86400));
    }else{
        $str = date('Y-m-d H:i:s', $time);
    }
    return $str;
}