/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : thinkbjy

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-03-29 00:13:13
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_article
-- ----------------------------
INSERT INTO `bjy_article` VALUES ('1', '此处是标题', '此处是作者', '&lt;p&gt;	&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;此处是内容；描述为空；&lt;img alt=&quot;QQ截图20150307214144.jpg&quot; src=&quot;/Upload/image/ueditor/20150327/1427471604671726.jpg&quot; title=&quot;1427471604671726.jpg&quot;/&gt;&lt;/p&gt;', '此处是内容；描述为空；', '1', '0', '1', '0', '1427464879', '24');
INSERT INTO `bjy_article` VALUES ('2', '有一个标题', '有一个作者', '&lt;p&gt;有一个内容；&lt;br/&gt;&lt;/p&gt;', '手写的描述；', '1', '0', '0', '0', '1427464936', '25');

-- ----------------------------
-- Table structure for `bjy_article_pic`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_article_pic`;
CREATE TABLE `bjy_article_pic` (
  `ap_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT '图片路径',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属文章id',
  PRIMARY KEY (`ap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_article_pic
-- ----------------------------
INSERT INTO `bjy_article_pic` VALUES ('3', '/Upload/image/ueditor/20150327/1427471604671726.jpg', '1');

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
INSERT INTO `bjy_article_tag` VALUES ('1', '14');
INSERT INTO `bjy_article_tag` VALUES ('1', '16');

-- ----------------------------
-- Table structure for `bjy_category`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_category`;
CREATE TABLE `bjy_category` (
  `cid` tinyint(2) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类主键id',
  `cname` varchar(15) NOT NULL DEFAULT '' COMMENT '分类名称',
  `keyword` varchar(255) DEFAULT '' COMMENT '关键词',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `pid` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '父级栏目id',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_category
-- ----------------------------
INSERT INTO `bjy_category` VALUES ('23', '前端', 'html、div+css、jQuery', '前端方面的技术', '2', '0');
INSERT INTO `bjy_category` VALUES ('24', 'PHP', 'php', 'php方面的技术', '1', '0');
INSERT INTO `bjy_category` VALUES ('25', '随心所语', '随心感慨', '随心发布的一些博文', '3', '0');

-- ----------------------------
-- Table structure for `bjy_config`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_config`;
CREATE TABLE `bjy_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '配置项键名',
  `value` varchar(300) DEFAULT '' COMMENT '配置项键值 1表示开启 0 关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_config
-- ----------------------------
INSERT INTO `bjy_config` VALUES ('1', 'WEB_NAME', '1');
INSERT INTO `bjy_config` VALUES ('2', 'WEB_KEYWORD', '2');
INSERT INTO `bjy_config` VALUES ('3', 'WEB_DESCRIPTION', '2222');
INSERT INTO `bjy_config` VALUES ('4', 'WEB_STATUS', '0');

-- ----------------------------
-- Table structure for `bjy_tag`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_tag`;
CREATE TABLE `bjy_tag` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '标签主键',
  `tname` varchar(10) NOT NULL DEFAULT '' COMMENT '标签名',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_tag
-- ----------------------------
INSERT INTO `bjy_tag` VALUES ('11', 'div+css');
INSERT INTO `bjy_tag` VALUES ('12', 'css3');
INSERT INTO `bjy_tag` VALUES ('13', 'html5');
INSERT INTO `bjy_tag` VALUES ('14', 'PHP');
INSERT INTO `bjy_tag` VALUES ('15', 'thinkphp');
INSERT INTO `bjy_tag` VALUES ('16', 'MySQL');
INSERT INTO `bjy_tag` VALUES ('17', 'jQuery');
