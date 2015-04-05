<?php
// .-----------------------------------------------------------------------------------
// |  Software: [thinkbjy cms]
// |   Version: 2015.04
// |      Site: http://www.baijunyao.com
// |-----------------------------------------------------------------------------------
// |    Author: 白俊遥 <b593026987@qq.com>
// | Copyright (c) 2014-2015, http://baijunyao.com. All Rights Reserved.
// |-----------------------------------------------------------------------------------
// |   License: http://www.apache.org/licenses/LICENSE-2.0
// '-----------------------------------------------------------------------------------
namespace Org\Bjy;
/**
 * 验证码类
 */

class Verify{

    //资源
    private $img;
    //画布宽度
    public $width;
    //画布高度
    public $height;
    //背景颜色
    public $bgColor;
    //验证码
    public $code;
    //验证码的随机种子
    public $codeStr;
    //验证码长度
    public $codeLen;
    //验证码字体
    public $font;
    //验证码字体大小
    public $fontSize;
    //验证码字体颜色
    public $fontColor;

    /**
     * 构造函数
     */
    public function __construct($width = '', $height = '', $bgColor = '', $fontColor = '', $codeLen = '', $fontSize = '') {
        $this->codeStr = C("CODE_STR");
        $this->font = C("CODE_FONT");
        if (!is_file($this->font)) {
            error("验证码字体文件不存在");
        }
        $this->width = empty($width) ? C("CODE_WIDTH") : $width;
        $this->height = empty($height) ? C("CODE_HEIGHT") : $height;
        $this->bgColor = empty($bgColor) ? C("CODE_BG_COLOR") : $bgColor;
        $this->codeLen = empty($codeLen) ? C("CODE_LEN") : $codeLen;
        $this->fontSize = empty($fontSize) ? C("CODE_FONT_SIZE") : $fontSize;
        $this->fontColor = empty($fontColor) ? C("CODE_FONT_COLOR") : $fontColor;

    }

    /**
     * 生成验证码
     */
    private function createCode() {
        $code = '';
        for ($i = 0; $i < $this->codeLen; $i++) {
            $code .= $this->codeStr [mt_rand(0, strlen($this->codeStr) - 1)];
        }
        $this->code = strtoupper($code);
        $_SESSION ['verify'] = $this->code;
    }

    /**
     * 返回验证码
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * 建画布
     */
    public function create() {
        if (!$this->checkGD())
            return false;
        $w = $this->width;
        $h = $this->height;
        $bgColor = $this->bgColor;
        $img = imagecreatetruecolor($w, $h);
        $bgColor = imagecolorallocate($img, hexdec(substr($bgColor, 1, 2)), hexdec(substr($bgColor, 3, 2)), hexdec(substr($bgColor, 5, 2)));
        imagefill($img, 0, 0, $bgColor);
        $this->img = $img;
        $this->createLine();
        $this->createFont();
        $this->createPix();
        $this->createRec();
    }
    /**
    *  画线
    */
    private function createLine(){
        $w = $this->width;
        $h = $this->height;
        $line_color = "#dcdcdc";
        $color = imagecolorallocate($this->img, hexdec(substr($line_color, 1, 2)), hexdec(substr($line_color, 3, 2)), hexdec(substr($line_color, 5, 2)));
        $l = $h/5;
        for($i=1;$i<$l;$i++){
            $step =$i*5;
            imageline($this->img, 0, $step, $w,$step, $color);
        }
        $l= $w/10;
        for($i=1;$i<$l;$i++){
            $step =$i*10;
            imageline($this->img, $step, 0, $step,$h, $color);
        }
    }
    /**
     * 画矩形边框
     */
    private function createRec() {
//        imagerectangle($this->img, 0, 0, $this->width - 1, $this->height - 1, $this->fontColor);
    }

    /**
     * 写入验证码文字
     */
    private function createFont() {
        $this->createCode();
        $color = $this->fontColor;
        if (!empty($color)) {
            $fontColor = imagecolorallocate($this->img, hexdec(substr($color, 1, 2)), hexdec(substr($color, 3, 2)), hexdec(substr($color, 5, 2)));
        }
        $x = ($this->width - 10) / $this->codeLen;
        for ($i = 0; $i < $this->codeLen; $i++) {
            if (empty($color)) {
                $fontColor = imagecolorallocate($this->img, mt_rand(50, 155), mt_rand(50, 155), mt_rand(50, 155));
            }
            imagettftext($this->img, $this->fontSize, mt_rand(- 30, 30), $x * $i + mt_rand(6, 10), mt_rand($this->height / 1.3, $this->height - 5), $fontColor, $this->font, $this->code [$i]);
        }
        $this->fontColor = $fontColor;
    }

    /**
     * 画线
     */
    private function createPix() {
        $pix_color = $this->fontColor;
        for ($i = 0; $i < 50; $i++) {
            imagesetpixel($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), $pix_color);
        }

        for ($i = 0; $i < 2; $i++) {
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $pix_color);
        }
        //画圆弧
        for ($i = 0; $i < 1; $i++) {
            // 设置画线宽度
           // imagesetthickness($this->img, mt_rand(1, 3));
            imagearc($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height)
                    , mt_rand(0, 160), mt_rand(0, 200), $pix_color);
        }
        imagesetthickness($this->img, 1);
    }

    /**
     * 显示验证码
     */
    public function show() {
        $this->create();//生成验证码
        header("Content-type:image/png");
        imagepng($this->img);
        imagedestroy($this->img);
        exit;
    }

    /**
     * 验证GD库是不否打开imagepng函数是否可用
     */
    private function checkGD() {
        return extension_loaded('gd') && function_exists("imagepng");
    }

}