## 简介
闲暇之时使用thinkphp开发了一个个人博客用来整理技能知识；<br /><br />
如今博客的功能基本已经齐备；特开源以供各类猿们免费使用<br /><br />
亦可以作为初学thinkphp的同学们的参考源代码；<br /><br />
下图即是使用thinkbjy开发的个人博客[白俊遥博客](http://statics.baijunyao.com/images/other/thinkbjy.jpg) http://www.baijunyao.com <br /><br />
![Thinkbjy](http://statics.baijunyao.com/images/other/thinkbjy.jpg)
## 使用说明
1. 请将程序直接放在根目录下；不要多层目录；例如正确：www/;错误：www/thinkbjy/ ；
2. 后台登陆密码默认为admin；
3. 如果确认开启了mod_rewrite；请将/Application/Common/Conf/config.php中的URL_MODEL改为2以优化url;如下是URL_MODEL为1和2时的示例<br>
URL_MODEL:1  http://www.baijunyao.com/index.php/Home/Index/article/aid/60 <br>
URL_MODEL:2  http://www.baijunyao.com/article/60<br>

## 针对thinkphp的改进优化；
1. 修复tinkphp的session设置周期无效的bug；
2. 自定义标签 /Application/Common/Tag/My.class.php；
3. 将html视图页面分离；

## 项目特色
1. 前台响应式页面布局;
2. 带表情的ajax无限级评论系统；

## 项目集成
1. PHPMail邮件系统；
2. QQ、微博、豆瓣、人人、开心网等第三方登陆；
3. ueditor 百度富文本编辑器；
4. boostrap；
5. font-awesome；
6. iCheck；

## 商业友好的开源协议
Thinkbjy遵循Apache2开源协议发布。Apache Licence是著名的非盈利开源组织Apache采用的协议。该协议和BSD类似，鼓励代码共享和尊重原作者的著作权，同样允许代码修改，再作为开源或商业软件发布。


