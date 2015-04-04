<?php
return array(
	    
//*************************************水印设置****************************************
	'WATER_TYPE'            => '1',           //水印类型 0:不使用水印 1:文字水印 2:图片水印 3:文字和图片水印同时使用
	'TEXT_WATER_WORD'       => 'baijunyao.com',    //文字水印内容
	'TEXT_WATER_TTF_PTH'    => './Public/static/font/ariali.ttf',  //文字水印字体路径
	'TEXT_WATER_FONT_SIZE'  => '15',    	  //文字水印文字字号
	'TEXT_WATER_COLOR'      => '#008CBA',     //文字水印文字颜色
	'TEXT_WATER_ANGLE'      => '0',    		  //文字水印文字倾斜程度
	'TEXT_WATER_LOCATE'     => '9',  	      //文字水印位置 1：上左 2：上中 3：上右 4：中左 5：中中 6：中右 7：下左 8：下中 9：下右
	'IMAGE_WATER_PIC_PTAH'	=> './Upload/image/logo/logo.png', //图片水印 水印路径
	'IMAGE_WATER_LOCATE'	=> '9', //图片水印 水印位置 1：上左 2：上中 3：上右 4：中左 5：中中 6：中右 7：下左 8：下中 9：下右
	'IMAGE_WATER_ALPHA'		=> '80', //图片水印 水印透明度：0-100 

);