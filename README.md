[创建 QQ 群及捐赠渠道](https://baijunyao.com/article/124)  

## 链接
- 博客：http://baijunyao.com  
- github：https://github.com/baijunyao/thinkphp-bjyblog  
- gitee：https://gitee.com/baijunyao/thinkbjy  

## 相关链接
[开源项目系列之thinkphp-bjyblog博客](http://baijunyao.com/article/104)  

## 简介
闲暇之时使用thinkphp开发了一个个人博客用来整理技能知识；  

如今博客的功能基本已经齐备；特开源以供各类猿们免费使用;  

亦可以作为初学thinkphp的同学们的参考源代码；  

此博客程序前后台页面以及逻辑代码的都由我手工打造；没有版权限制；可以随意折腾；

想研究支付宝、微信支付、邮件发送、短信通知验证码发送、oss云存储、融云即时通讯、友盟推送、Memcached缓存、权限管理、等更多功能的可以参考进阶版的bjyadmin https://github.com/baijunyao/thinkphp-bjyadmin  

下图即是使用bjyblog开发的个人博客[白俊遥博客](http://statics.baijunyao.com/images/other/thinkbjy.jpg) http://baijunyao.com  

![Thinkbjy](http://statics.baijunyao.com/images/other/thinkbjy.jpg)  

这还有个使用 laravel 开发的博客 [https://github.com/baijunyao/laravel-bjyblog](https://github.com/baijunyao/laravel-bjyblog)   

## 使用说明
1. 请将项目内的所有文件直接放在根目录下；不要多层目录；  
例如正确：www/;错误：www/thinkbjy/；
2. 后台登录密码默认为admin；
3. 如果确认开启了mod_rewrite  
请将/Application/Common/Conf/config.php中的URL_MODEL改为2以优化url  
未开启路由：http://baijunyao.com/index.php/Home/Index/article/aid/60  
开启路由后：http://baijunyao.com/article/60
4. 把根目录下的robots.txt中的baijunyao.com改为自己的域名；
5. 可以在用户管理中；将第三方账号标记为站长；然后后台就必须使用第三方账号登录以增强安全性；

## 针对thinkphp的改进优化；
1. 修复tinkphp的session设置周期无效的bug；
2. 自定义标签 /Application/Common/Tag/My.class.php；
3. 将html视图页面分离；

## 项目介绍
1. 前台基于boostrap的响应式页面布局适配手机和平板；
2. 带表情的ajax无限级评论系统；
3. PHPMail邮件系统；
4. QQ、微博、豆瓣、人人、开心网等第三方登录；
5. ueditor 百度富文本编辑器；
7. font-awesome；
8. iCheck；

## 商业友好的开源协议
bjyblog遵循Apache2开源协议发布。Apache Licence是著名的非盈利开源组织Apache采用的协议。该协议和BSD类似，鼓励代码共享和尊重原作者的著作权，同样允许代码修改，再作为开源或商业软件发布。


