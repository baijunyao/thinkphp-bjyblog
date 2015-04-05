/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : thinkbjy

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-04-06 00:10:58
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_article
-- ----------------------------
INSERT INTO `bjy_article` VALUES ('8', '测试标题', '测试作者', '&lt;p&gt;测试内容&lt;br/&gt;&lt;/p&gt;', '测试描述', '1', '0', '0', '0', '1428249558', '26');

-- ----------------------------
-- Table structure for `bjy_article_pic`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_article_pic`;
CREATE TABLE `bjy_article_pic` (
  `ap_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT '图片路径',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属文章id',
  PRIMARY KEY (`ap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_article_pic
-- ----------------------------
INSERT INTO `bjy_article_pic` VALUES ('17', '2', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_category
-- ----------------------------
INSERT INTO `bjy_category` VALUES ('26', '测试分类', '测试分类', '测试数据', '1', '0');

-- ----------------------------
-- Table structure for `bjy_config`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_config`;
CREATE TABLE `bjy_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '配置项键名',
  `value` varchar(300) DEFAULT '' COMMENT '配置项键值 1表示开启 0 关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_config
-- ----------------------------
INSERT INTO `bjy_config` VALUES ('1', 'WEB_NAME', 'thinkbjy');
INSERT INTO `bjy_config` VALUES ('2', 'WEB_KEYWORD', 'thinkbjy,thinkphp,blog');
INSERT INTO `bjy_config` VALUES ('3', 'WEB_DESCRIPTION', 'thinkbjy官网');
INSERT INTO `bjy_config` VALUES ('4', 'WEB_STATUS', '1');
INSERT INTO `bjy_config` VALUES ('5', 'ADMIN_PASSWORD', 'd41d8cd98f00b204e9800998ecf8427e');

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
-- Table structure for `bjy_tag`
-- ----------------------------
DROP TABLE IF EXISTS `bjy_tag`;
CREATE TABLE `bjy_tag` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '标签主键',
  `tname` varchar(10) NOT NULL DEFAULT '' COMMENT '标签名',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bjy_tag
-- ----------------------------
INSERT INTO `bjy_tag` VALUES ('18', '测试标签');
