/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : thinkbjy

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-05-07 22:00:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bjy_article`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_article`;
CREATE TABLE `bjy_article` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章表主键',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '标题',
  `author` varchar(15) NOT NULL DEFAULT '' COMMENT '作者',
  `content` text NOT NULL COMMENT '文章内容',
  `description` char(255) NOT NULL DEFAULT '' COMMENT '描述',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '文章是否显示 1是 0否',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除 1是 0否',
  `is_top` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶 1是 0否',
  `click` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `cid` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_article
-- ----------------------------
INSERT INTO `bjy_article` VALUES ('8', '测试标题', '测试作者', '&lt;p&gt;	&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;测试内容&lt;br/&gt;&lt;/p&gt;', '测试描述', '0', '0', '0', '0', '1428249558', '26');
INSERT INTO `bjy_article` VALUES ('9', '测试html', '白俊遥', '&lt;p&gt;	&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;经常扒别人网站文章的坑们；我是指那种批量式采集的压根不看内容的，少不了都会用到删除html标签的函数；这里介绍3种不同用途上的方法；&lt;/p&gt;&lt;pre class=&quot;brush:php;toolbar:false&quot;&gt;$str=&amp;#39;&amp;lt;div&amp;gt;&amp;lt;p&amp;gt;这里是p标签&amp;lt;/p&amp;gt;&amp;lt;img&amp;nbsp;src=&amp;quot;&amp;quot;&amp;nbsp;alt=&amp;quot;这里是img标签&amp;quot;&amp;gt;&amp;lt;a&amp;nbsp;href=&amp;quot;&amp;quot;&amp;gt;这里是a标签&amp;lt;/a&amp;gt;&amp;lt;br&amp;gt;&amp;lt;/div&amp;gt;&amp;#39;;&lt;/pre&gt;&lt;p&gt;&lt;strong&gt;&lt;span style=&quot;font-size: 24px;&quot;&gt;1：删除全部或者保留指定html标签&lt;/span&gt;&lt;/strong&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;php自带的函数strip_tags即可满足要求，&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;使用方法：strip_tags(string,allow)；&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;string：需要处理的字符串；&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;allow：需要保留的指定标签，可以写多个；&lt;br/&gt;&lt;/p&gt;&lt;pre class=&quot;brush:php;toolbar:false&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;lt;?php\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;echo&amp;nbsp;strip_tags($str,&amp;#39;&amp;lt;p&amp;gt;&amp;lt;a&amp;gt;&amp;#39;);\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;?&amp;gt;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;//输出：&amp;lt;p&amp;gt;这里是p标签&amp;lt;/p&amp;gt;&amp;lt;a&amp;nbsp;href=&amp;quot;&amp;quot;&amp;gt;这里是a标签&amp;lt;/a&amp;gt;&lt;/pre&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;次函数的优点是简单粗暴，但是缺点也很明显；如果有一大堆标签；而我只是想删除指定的某一个；那要写很多需要保留的标签；&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;所以有了第二个方法；&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;span style=&quot;font-size: 24px;&quot;&gt;2：删除指定的html标签&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;使用方法：strip_html_tags($tags,$str)；&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; $tags：需要删除的标签&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;(数组格式)&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; $str：需要处理的字符串；&lt;br/&gt;&lt;/p&gt;&lt;pre class=&quot;brush:php;toolbar:false&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;lt;?php\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;function&amp;nbsp;strip_html_tags($tags,$str){&amp;nbsp;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$html=array();\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;foreach&amp;nbsp;($tags&amp;nbsp;as&amp;nbsp;$tag)&amp;nbsp;{\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$html[]=&amp;quot;/(&amp;lt;(?:\\/&amp;quot;.$tag.&amp;quot;|&amp;quot;.$tag.&amp;quot;)[^&amp;gt;]*&amp;gt;)/i&amp;quot;;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$data=preg_replace($html,&amp;nbsp;&amp;#39;&amp;#39;,&amp;nbsp;$str);&amp;nbsp;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}&amp;nbsp;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;echo&amp;nbsp;strip_html_tags(array(&amp;#39;p&amp;#39;,&amp;#39;img&amp;#39;),$str);\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;?&amp;gt;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;//输出&amp;lt;div&amp;gt;这里是p标签&amp;lt;a&amp;nbsp;href=&amp;quot;&amp;quot;&amp;gt;这里是a标签&amp;lt;/a&amp;gt;&amp;lt;br&amp;gt;&amp;lt;/div&amp;gt;;&lt;/pre&gt;&lt;p&gt;&lt;strong&gt;&lt;span style=&quot;font-size: 24px;&quot;&gt;3：删除标签和标签的内容&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;使用方法：strip_html_tags($tags,$str)；&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; $tags：需要删除的标签&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;(数组格式)&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; $str：需要处理的字符串；&lt;/p&gt;&lt;pre class=&quot;brush:php;toolbar:false&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;lt;?php\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;function&amp;nbsp;strip_html_tags($tags,$str){&amp;nbsp;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$html=array();\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;foreach&amp;nbsp;($tags&amp;nbsp;as&amp;nbsp;$tag)&amp;nbsp;{\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$html[]=&amp;#39;/(&amp;lt;&amp;#39;.$tag.&amp;#39;.*?&amp;gt;[\\s|\\S]*?&amp;lt;\\/&amp;#39;.$tag.&amp;#39;&amp;gt;)/&amp;#39;;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$data=preg_replace($html,&amp;#39;&amp;#39;,$str);\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}&amp;nbsp;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;echo&amp;nbsp;strip_html_tags(array(&amp;#39;a&amp;#39;,&amp;#39;img&amp;#39;),$str);\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;?&amp;gt;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;//输出&amp;lt;div&amp;gt;&amp;lt;p&amp;gt;这里是p标签&amp;lt;/p&amp;gt;&amp;lt;img&amp;nbsp;src=&amp;quot;&amp;quot;&amp;nbsp;alt=&amp;quot;这里是img标签&amp;quot;&amp;gt;&amp;lt;br&amp;gt;&amp;lt;/div&amp;gt;;&lt;/pre&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;很多网站文章里面会带上网站名和链接，比如&amp;lt;a href=&amp;quot;http://www.baijunyao.com&amp;quot;&amp;gt;白俊遥博客&amp;lt;/a&amp;gt;；这个函数就是专治这种； 别拿这个函数采集本站啊；不然保证不打死你；&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;span style=&quot;font-size: 24px;&quot;&gt;4：终极函数，删除指定标签；删除或者保留标签内的内容；&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;使用方法：strip_html_tags($tags,$str,$content)；&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; $tags：需要删除的标签&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;(数组格式)&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; $str：需要处理的字符串；&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; $ontent：是否删除标签内的内容 0保留内容 1不保留内容&lt;/p&gt;&lt;pre class=&quot;brush:php;toolbar:false&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;lt;?php\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;/**\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;*&amp;nbsp;删除指定的标签和内容\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;*&amp;nbsp;@param&amp;nbsp;array&amp;nbsp;$tags&amp;nbsp;需要删除的标签数组\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;*&amp;nbsp;@param&amp;nbsp;string&amp;nbsp;$str&amp;nbsp;数据源\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;*&amp;nbsp;@param&amp;nbsp;string&amp;nbsp;$content&amp;nbsp;是否删除标签内的内容&amp;nbsp;默认为0保留内容&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;1不保留内容\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;*&amp;nbsp;@return&amp;nbsp;string\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;*/\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;function&amp;nbsp;strip_html_tags($tags,$str,$content=0){\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;if($content){\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$html=array();\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;foreach&amp;nbsp;($tags&amp;nbsp;as&amp;nbsp;$tag)&amp;nbsp;{\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$html[]=&amp;#39;/(&amp;lt;&amp;#39;.$tag.&amp;#39;.*?&amp;gt;[\\s|\\S]*?&amp;lt;\\/&amp;#39;.$tag.&amp;#39;&amp;gt;)/&amp;#39;;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$data=preg_replace($html,&amp;#39;&amp;#39;,$str);\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}else{\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$html=array();\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;foreach&amp;nbsp;($tags&amp;nbsp;as&amp;nbsp;$tag)&amp;nbsp;{\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$html[]=&amp;quot;/(&amp;lt;(?:\\/&amp;quot;.$tag.&amp;quot;|&amp;quot;.$tag.&amp;quot;)[^&amp;gt;]*&amp;gt;)/i&amp;quot;;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;$data=preg_replace($html,&amp;nbsp;&amp;#39;&amp;#39;,&amp;nbsp;$str);\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;return&amp;nbsp;$data;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;echo&amp;nbsp;strip_html_tags(array(&amp;#39;a&amp;#39;),$str,1);\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;?&amp;gt;\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;//输出&amp;lt;div&amp;gt;&amp;lt;p&amp;gt;这里是p标签&amp;lt;/p&amp;gt;&amp;lt;img&amp;nbsp;src=&amp;quot;&amp;quot;&amp;nbsp;alt=&amp;quot;这里是img标签&amp;quot;&amp;gt;&amp;lt;br&amp;gt;&amp;lt;/div&amp;gt;;&lt;/pre&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;前面扯了那么多；其实最后这个函数才是干货；一口气搞定各种标签删除的疑难杂症不费劲；&lt;/p&gt;&lt;p&gt;别看下面这张截图了；无非带点颜色好看，我主要是拿来凑图当文章封面的；&lt;/p&gt;&lt;p&gt;&lt;img alt=&quot;QQ截图20150425005608.jpg&quot; src=&quot;/Upload/image/ueditor/20150503/1430657959488453.jpg&quot; title=&quot;1429894616587492.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 'alert(1);', '1', '0', '1', '0', '1430231507', '26');

-- ----------------------------
-- Table structure for `bjy_article_pic`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_article_pic`;
CREATE TABLE `bjy_article_pic` (
  `ap_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT '图片路径',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属文章id',
  PRIMARY KEY (`ap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_article_pic
-- ----------------------------
INSERT INTO `bjy_article_pic` VALUES ('17', '2', '2');
INSERT INTO `bjy_article_pic` VALUES ('19', '/Upload/image/ueditor/20150503/1430657959488453.jpg', '9');

-- ----------------------------
-- Table structure for `bjy_article_tag`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_article_tag`;
CREATE TABLE `bjy_article_tag` (
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章id',
  `tid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '标签id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_article_tag
-- ----------------------------
INSERT INTO `bjy_article_tag` VALUES ('8', '18');
INSERT INTO `bjy_article_tag` VALUES ('9', '18');
INSERT INTO `bjy_article_tag` VALUES ('9', '19');

-- ----------------------------
-- Table structure for `bjy_category`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_category`;
CREATE TABLE `bjy_category` (
  `cid` tinyint(2) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类主键id',
  `cname` varchar(15) NOT NULL DEFAULT '' COMMENT '分类名称',
  `keywords` varchar(255) DEFAULT '' COMMENT '关键词',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `pid` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '父级栏目id',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_category
-- ----------------------------
INSERT INTO `bjy_category` VALUES ('26', '测试分类', '测试分类', '测试数据', '1', '0');

-- ----------------------------
-- Table structure for `bjy_comment`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_comment`;
CREATE TABLE `bjy_comment` (
  `cmtid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `content` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`cmtid`)
) ENGINE=InnoDB AUTO_INCREMENT=671548596 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_comment
-- ----------------------------
INSERT INTO `bjy_comment` VALUES ('671548385', '{&quot;comments&quot;:[{&quot;apptype&quot;:0,&quot;attachment&quot;:[],&quot;channelid&quot;:718012,&quot;channeltype&quot;:1,&quot;cmtid&quot;:&quot;671548385&quot;,&quot;content&quot;:&quot;正式测试2&quot;,&quot;ctime&quot;:1430839316000,&quot;from&quot;:0,&quot;ip&quot;:&quot;118.186.129.196&quot;,&quot;opcount&quot;:0,&quot;referid&quot;:&quot;671548385&quot;,&quot;replyid&quot;:&quot;0&quot;,&quot;spcount&quot;:0,&quot;user&quot;:{&quot;nickname&quot;:&quot;云淡风晴&quot;,&quot;sohuPlusId&quot;:239590692,&quot;usericon&quot;:&quot;http://qzapp.qlogo.cn/qzapp/101206152/F16ABCFCE42A66BA9049DA0D95593D19/100&quot;,&quot;userid&quot;:&quot;1&quot;,&quot;userurl&quot;:&quot;&quot;},&quot;useragent&quot;:&quot;Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0&quot;}],&quot;metadata&quot;:&quot;{\\&quot;ChangY_Img\\&quot;:\\&quot;http://comment.bjcnc.img.sohucs.com/topic_picture_581497670\\&quot;,\\&quot;ChangY_ImgTag\\&quot;:\\&quot;YES\\&quot;}&quot;,&quot;sourceid&quot;:&quot;8&quot;,&quot;title&quot;:&quot;测试标题-白俊遥博客&quot;,&quot;ttime&quot;:1430638226000,&quot;url&quot;:&quot;http://www.baijunyao.com/index.php/Home/Index/article/aid/8&quot;}');
INSERT INTO `bjy_comment` VALUES ('671548595', '{&quot;comments&quot;:[{&quot;apptype&quot;:0,&quot;attachment&quot;:[],&quot;channelid&quot;:718012,&quot;channeltype&quot;:1,&quot;cmtid&quot;:&quot;671548595&quot;,&quot;content&quot;:&quot;正式测试1&quot;,&quot;ctime&quot;:1430839310000,&quot;from&quot;:0,&quot;ip&quot;:&quot;118.186.129.196&quot;,&quot;opcount&quot;:0,&quot;referid&quot;:&quot;671548595&quot;,&quot;replyid&quot;:&quot;0&quot;,&quot;spcount&quot;:0,&quot;user&quot;:{&quot;nickname&quot;:&quot;云淡风晴&quot;,&quot;sohuPlusId&quot;:239590692,&quot;usericon&quot;:&quot;http://qzapp.qlogo.cn/qzapp/101206152/F16ABCFCE42A66BA9049DA0D95593D19/100&quot;,&quot;userid&quot;:&quot;1&quot;,&quot;userurl&quot;:&quot;&quot;},&quot;useragent&quot;:&quot;Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0&quot;}],&quot;metadata&quot;:&quot;{\\&quot;ChangY_Img\\&quot;:\\&quot;http://comment.bjcnc.img.sohucs.com/topic_picture_581497670\\&quot;,\\&quot;ChangY_ImgTag\\&quot;:\\&quot;YES\\&quot;}&quot;,&quot;sourceid&quot;:&quot;8&quot;,&quot;title&quot;:&quot;测试标题-白俊遥博客&quot;,&quot;ttime&quot;:1430638226000,&quot;url&quot;:&quot;http://www.baijunyao.com/index.php/Home/Index/article/aid/8&quot;}');

-- ----------------------------
-- Table structure for `bjy_config`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_config`;
CREATE TABLE `bjy_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '配置项键名',
  `value` text COMMENT '配置项键值 1表示开启 0 关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_config
-- ----------------------------
INSERT INTO `bjy_config` VALUES ('1', 'WEB_NAME', '白俊遥博客');
INSERT INTO `bjy_config` VALUES ('2', 'WEB_KEYWORDS', '白俊遥,帅白,技术博客,个人博客,thinkbjy');
INSERT INTO `bjy_config` VALUES ('3', 'WEB_DESCRIPTION', '白俊遥的个人技术博客,thinkbjy官方网站');
INSERT INTO `bjy_config` VALUES ('4', 'WEB_STATUS', '1');
INSERT INTO `bjy_config` VALUES ('5', 'ADMIN_PASSWORD', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `bjy_config` VALUES ('6', 'WATER_TYPE', '1');
INSERT INTO `bjy_config` VALUES ('7', 'TEXT_WATER_WORD', 'baijunyao.com');
INSERT INTO `bjy_config` VALUES ('8', 'TEXT_WATER_TTF_PTH', './Public/static/font/ariali.ttf');
INSERT INTO `bjy_config` VALUES ('9', 'TEXT_WATER_FONT_SIZE', '15');
INSERT INTO `bjy_config` VALUES ('10', 'TEXT_WATER_COLOR', '#008CBA');
INSERT INTO `bjy_config` VALUES ('11', 'TEXT_WATER_ANGLE', '0');
INSERT INTO `bjy_config` VALUES ('12', 'TEXT_WATER_LOCATE', '9');
INSERT INTO `bjy_config` VALUES ('13', 'IMAGE_WATER_PIC_PTAH', './Upload/image/logo/logo.png');
INSERT INTO `bjy_config` VALUES ('14', 'IMAGE_WATER_LOCATE', '9');
INSERT INTO `bjy_config` VALUES ('15', 'IMAGE_WATER_ALPHA', '80');
INSERT INTO `bjy_config` VALUES ('16', 'WEB_CLOSE_WORD', '网站升级中，请稍后访问。');
INSERT INTO `bjy_config` VALUES ('17', 'WEB_ICP_NUMBER', '豫ICP备14009546号-3');
INSERT INTO `bjy_config` VALUES ('18', 'ADMIN_EMAIL', 'admin@baijunyao.com');
INSERT INTO `bjy_config` VALUES ('19', 'COPYRIGHT_WORD', '本文为白俊遥原创文章,转载无需和我联系,但请注明来自白俊遥博客baijunyao.com');
INSERT INTO `bjy_config` VALUES ('20', 'QQ_APPID', '101206152');
INSERT INTO `bjy_config` VALUES ('21', 'CHANGYAN_APPID', 'cyrKRbJ5N');
INSERT INTO `bjy_config` VALUES ('22', 'CHANGYAN_CONF', 'prod_c654661caf5ab6da98742d040413815b');
INSERT INTO `bjy_config` VALUES ('23', 'WEB_STATISTICS', '&lt;script&gt;\r\nvar _hmt = _hmt || [];\r\n(function() {\r\n  var hm = document.createElement(&quot;script&quot;);\r\n  hm.src = &quot;//hm.baidu.com/hm.js?c3338ec467285d953aba86d9bd01cd93&quot;;\r\n  var s = document.getElementsByTagName(&quot;script&quot;)[0]; \r\n  s.parentNode.insertBefore(hm, s);\r\n})();\r\n&lt;/script&gt;');
INSERT INTO `bjy_config` VALUES ('24', 'CHANGEYAN_RETURN_COMMENT', 'http://www.baijunyao.com/index.php/Home/Comment/add_comment/verify/22');

-- ----------------------------
-- Table structure for `bjy_link`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_link`;
CREATE TABLE `bjy_link` (
  `lid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `lname` varchar(50) NOT NULL DEFAULT '' COMMENT '链接名',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '文章是否显示 1是 0否',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除 1是 0否',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_link
-- ----------------------------
INSERT INTO `bjy_link` VALUES ('2', '测试友情链接', 'http://www.baijunyao.com', '1', '1', '0');

-- ----------------------------
-- Table structure for `bjy_oauth_user`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_oauth_user`;
CREATE TABLE `bjy_oauth_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `uid` int(10) unsigned DEFAULT '0' COMMENT '关联的本站用户id',
  `type` tinyint(3) unsigned DEFAULT '1' COMMENT '类型 1：QQ  2：新浪微博',
  `nickname` varchar(30) DEFAULT '' COMMENT '第三方昵称',
  `head_img` varchar(255) DEFAULT '' COMMENT '头像',
  `openid` varchar(40) DEFAULT '' COMMENT '第三方用户id',
  `access_token` varchar(60) DEFAULT '' COMMENT 'access_token token',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '绑定时间',
  `last_login_time` int(10) unsigned DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(16) DEFAULT '' COMMENT '最后登录ip',
  `login_times` int(6) unsigned DEFAULT '0' COMMENT '登录次数',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_oauth_user
-- ----------------------------
INSERT INTO `bjy_oauth_user` VALUES ('1', '0', '1', '云淡风晴', 'http://qzapp.qlogo.cn/qzapp/101206152/F16ABCFCE42A66BA9049DA0D95593D19/100', 'F16ABCFCE42A66BA9049DA0D95593D19', '7375B4E959446A07CF8DC08F757C3778', '1429027761', '1430663258', '0.0.0.0', '12', '1');

-- ----------------------------
-- Table structure for `bjy_tag`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_tag`;
CREATE TABLE `bjy_tag` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '标签主键',
  `tname` varchar(10) NOT NULL DEFAULT '' COMMENT '标签名',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_tag
-- ----------------------------
INSERT INTO `bjy_tag` VALUES ('18', '测试标签');
INSERT INTO `bjy_tag` VALUES ('19', 'test');
