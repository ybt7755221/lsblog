
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `ls_ablum`;
CREATE TABLE IF NOT EXISTS `ls_ablum` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cuid` int(10) unsigned NOT NULL,
  `ablum_name` varchar(64) NOT NULL,
  `cover` varchar(128) NOT NULL,
  `passwd` varchar(34) NOT NULL,
  `information` varchar(255) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `ls_categorise`;
CREATE TABLE IF NOT EXISTS `ls_categorise` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fid` bigint(20) unsigned NOT NULL,
  `cate_name` varchar(60) NOT NULL,
  `cate_english` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `cate_image` varchar(100) NOT NULL,
  `cate_order` int(10) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `path` varchar(20) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `url` varchar(64) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`),
  KEY `cate_order` (`cate_order`),
  KEY `visible` (`visible`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

INSERT INTO `ls_categorise` (`id`, `fid`, `cate_name`, `cate_english`, `description`, `cate_image`, `cate_order`, `visible`, `path`, `type`, `url`) VALUES
(1, 0, '数码科技', 'Technology', '汇集各种网络产品，数码科技和博主个人感兴趣的东西', '/upload/ablum/201410/1414389465691.png', 0, 1, '0-11', 1, 'none'),
(2, 0, '生活休闲', 'Living', '生活指为生存而发展，经济的发展带动了价值的体现，实现我们的梦想，带着我们走进先进科学社会，懂得生活的乐趣，生活也是体现人类这种生命的所有的日常活动和经历的总和。广义上指人的各种活动。', '/upload/ablum/201410/1414389508665.png', 0, 1, '0-10', 1, 'none'),
(4, 0, '旅游摄影', 'Travell', '旅游是人们为了休闲、娱乐、探亲访友或者商务目的而进行的非定居性旅行和在游览过程中所发生的一切关系和现象的总和。', '/upload/ablum/201410/1414389550340.png', 0, 1, '0-8', 1, 'none'),
(3, 0, '影视动漫', 'Movies', '影视是包括电影、电视以及电视电影等在内的影像艺术的表达对象，在以拷贝、磁带、胶片、存储器等为载体，以银幕、屏幕放映为目的，而实现以视觉与听觉综合为观赏对象的艺术表达...', '/upload/ablum/201410/1414389636464.png', 0, 1, '0-9', 1, 'none'),
(5, 0, '相册展示', 'Ablum', '相册展示', '/upload/ablum/201410/1414389698621.png', 0, 1, '0-13', 2, '/ablum');

DROP TABLE IF EXISTS `ls_comments`;
CREATE TABLE IF NOT EXISTS `ls_comments` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(10) unsigned NOT NULL DEFAULT '0',
  `author` varchar(64) NOT NULL DEFAULT 'visitor',
  `author_webroot` varchar(100) NOT NULL DEFAULT 'www.burtyu.com',
  `author_email` varchar(100) NOT NULL DEFAULT 'demo@demo.com',
  `author_ip` varchar(15) NOT NULL DEFAULT '192.168.111.111',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `is_show` enum('TRUE','FALSE') NOT NULL DEFAULT 'TRUE',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `comment_date` (`comment_date`),
  KEY `comment_parent` (`is_show`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `ls_images`;
CREATE TABLE IF NOT EXISTS `ls_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL,
  `path` varchar(64) NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  `backup` varchar(255) NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `ls_links`;
CREATE TABLE IF NOT EXISTS `ls_links` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL DEFAULT '',
  `lname` varchar(255) NOT NULL DEFAULT '',
  `mage` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updated` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `visible` (`visible`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `ls_posts`;
CREATE TABLE IF NOT EXISTS `ls_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT 'title',
  `content` text NOT NULL,
  `excerpt` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `comment_status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `post_password` char(32) NOT NULL DEFAULT '88136e286025ee728b2282e55bf91ad2',
  `cate_id` int(10) unsigned NOT NULL DEFAULT '1',
  `tag_id` varchar(200) NOT NULL,
  `comment_count` bigint(20) unsigned NOT NULL DEFAULT '0',
  `type` enum('T','V') NOT NULL DEFAULT 'T',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `author` (`author`),
  KEY `cate` (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `ls_posts` (`id`, `author`, `title`, `content`, `excerpt`, `status`, `comment_status`, `post_password`, `cate_id`, `tag_id`, `comment_count`, `type`, `create_time`) VALUES
(1, 1, 'Mac OSX10.10 Yosemite下配置php开发环境', '<p>&nbsp; &nbsp; &nbsp; &nbsp; 很多小伙伴都开始用mac os开发，那么在安装开发环境的时候就面临着选择。首先，用什么？开发环境有两种方式，一种是自己编译开发，一种是集成环境开发。</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 很多小伙伴喜欢集成环境，原因很简单安装简单使用方便。但是集成环境的扩展是个问题。而自己编译环境会比较麻烦，过程也会出些错误，但是自己编译的好处一个是可控，因为全是自己编译的安了什么都安在哪儿自己清楚，便于日后的扩展使用。二是在mac下已经自带了apache和php只需要一个 mysql就能完成安装实在是开发环境首选。</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 本例子以mac os X 10.10为标准写的，其他系统如有不同请自行google。mac下已经贴心的为你装好了apache和php，其版本分别是apache 2.4.9和php5.5。总体来说这个版本还是比较新的，当然之后如果需要也可以升级一下php版本，但暂不在此博文内讨论。</p><p>1.开启php</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 首先在apache配置文件里开启php选项：</p><p>&nbsp; &nbsp; &nbsp; &nbsp; sudo vim /etc/apache2/httpd.conf</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 去掉第118行 ＃LoadModule php5_module libexec/apache2/libphp5.so 的＃号。当然你也可以顺便开启一些你需要的模块，利润proxy等等。</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 然后将/etc/php.ini.default 复制一份命名为php.ini就大功告成了。</p><p>2.开启apache</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 完成第一步后，直接在终端输入 sudo apachectl start 即可开启apache。如果您不准备设置啥那么现在就完成了apache和php的安装。如果您想要更换程序目录您需要修改apache配置文件 httpd.conf。建议配置前请先备份。</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 打开配置文件 &nbsp; sudo vim /etc/apache2/httpd.conf&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 将170行DocumentRoot &quot;/Library/WebServer/Documents&quot; 替换为 DocumentRoot &quot;/Users/burt/Work/www&quot; （/Users/burt/Work/www是我自己的目录，您可以替换为您自己的目录即可）</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 将196行的&lt;Directory &quot;/Library/WebServer/Documents&quot;&gt;改成&lt;Directory &quot;/Users/burt/Work/www&quot;&gt;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 重启apache 完成目录的修改。</p><p>3.安装mysql</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 去mysql网站上找mac版的mysql下载安装。然后打开php.ini &nbsp;sudo vim /etc/php.ini</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 找到1104行 [MySQL]</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 然后确保此条配置如下</p><p>&nbsp; &nbsp; &nbsp; &nbsp; mysql.default_socket = /tmp/mysql.socket</p><p>&nbsp; &nbsp; &nbsp; &nbsp;最后开启mysql即可。开启方式两种1.系统 &gt; 系统偏好设置 &gt; MySql. 另一种方法是直接使用命令&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp;sudo /usr/local/mysql/support-files/mysql.server start.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 完成以上三步就完成了mac下php的设置。简单方便。而且mac下还自动为您设置好了sendmail等等。所以完成上面三步就可以直接使用了。</p><p><br/></p>', 'aasf', 1, 1, '096d4caa299ead175604106a93995a01', 1, '7891011', 0, '', 1414400074);

DROP TABLE IF EXISTS `ls_site`;
CREATE TABLE IF NOT EXISTS `ls_site` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `variate` varchar(512) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `is_show` tinyint(4) NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `html` varchar(10) NOT NULL DEFAULT 'text',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

INSERT INTO `ls_site` (`id`, `name`, `variate`, `value`, `is_show`, `type`, `html`) VALUES
(1, '网站名称', 'blogname', '乱事重生', 1, 1, 'text'),
(2, '网站简介', 'description', '一个php码农的网络世界', 1, 1, 'text'),
(3, '联系邮箱', 'adminemail', 'ybt7755221@sohu.com', 1, 1, 'text'),
(4, '网站作者', 'author', 'burtyu', 1, 1, 'text'),
(5, '网站关键字', 'keyborad', 'lsblog,Burt,Yii,PHP,HTML5,CSS3,JacasScript,Yii Framework,Joomla', 1, 1, 'text'),
(6, '土豪金风格', 'theme', 'flat', 1, 2, 'text'),
(7, '网站状态', 'site_status', '1', 1, 1, 'select'),
(8, '网站备案号', 'web_bak', '木有木有木有', 1, 1, 'text');

DROP TABLE IF EXISTS `ls_tags`;
CREATE TABLE IF NOT EXISTS `ls_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_uid` bigint(20) unsigned NOT NULL,
  `tagname` varchar(60) NOT NULL,
  `description` varchar(250) NOT NULL,
  `tag_order` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tag_order` (`tag_order`),
  KEY `tagname` (`tagname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

INSERT INTO `ls_tags` (`id`, `create_uid`, `tagname`, `description`, `tag_order`) VALUES
(1, 1, 'demo', '暂无', 0),
(2, 1, '1', '暂无', 0),
(3, 1, '2', '暂无', 0),
(4, 1, '3', '暂无', 0),
(5, 1, '4', '暂无', 0),
(6, 1, 'df', '暂无', 0),
(7, 1, 'OSX', '暂无', 0),
(8, 1, 'php', '暂无', 0),
(9, 1, 'Yosemite', '暂无', 0),
(10, 1, 'Mysql', '暂无', 0),
(11, 1, 'apache', '暂无', 0);

DROP TABLE IF EXISTS `ls_users`;
CREATE TABLE IF NOT EXISTS `ls_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL DEFAULT 'admin@damin.com',
  `password` varchar(32) NOT NULL DEFAULT '733d7be2196ff70efaf6913fc8bdcabf',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `nickname` varchar(64) NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `ls_users` (`id`, `username`, `password`, `status`, `nickname`, `create_time`) VALUES
(1, 'ybt7755221@sohu.com', '314fff81164263eb96668f915a43ab55', 3, 'burtyu', 1348644101);

DROP TABLE IF EXISTS `ls_user_field`;
CREATE TABLE IF NOT EXISTS `ls_user_field` (
  `uid` int(10) unsigned NOT NULL,
  `logo` varchar(100) NOT NULL DEFAULT '/upload/default.jpg',
  `weight` tinyint(3) unsigned NOT NULL DEFAULT '75',
  `height` tinyint(3) unsigned NOT NULL DEFAULT '180',
  `sex` enum('S','M','W') NOT NULL DEFAULT 'S',
  `sexual` enum('S','M','W','D') NOT NULL DEFAULT 'S',
  `felling` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `blood` enum('S','A','B','AB','O') NOT NULL DEFAULT 'S',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `email` varchar(128) NOT NULL DEFAULT '0',
  `weibo` varchar(255) NOT NULL DEFAULT 'http://weibo.com/525456886/',
  `weixin` varchar(300) NOT NULL,
  `qq` bigint(20) unsigned NOT NULL,
  `msn` varchar(128) NOT NULL DEFAULT 'demo@demo.com',
  `description` varchar(600) NOT NULL DEFAULT 'false',
  `university` varchar(120) NOT NULL DEFAULT 'none',
  `is_qq` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_email` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_sexual` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_weibo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_weixin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_msn` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_birthday` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_edu` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `school` varchar(120) NOT NULL DEFAULT 'none',
  `is_felling` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ls_user_field` (`uid`, `logo`, `weight`, `height`, `sex`, `sexual`, `felling`, `blood`, `birthday`, `email`, `weibo`, `weixin`, `qq`, `msn`, `description`, `university`, `is_qq`, `is_email`, `is_sexual`, `is_weibo`, `is_weixin`, `is_msn`, `is_birthday`, `is_edu`, `school`, `is_felling`) VALUES
(1, '/upload/users/201410/1413956068478.jpg', 80, 179, 'M', 'M', 0, 'B', '1989-10-16', 'ybt7755221@sohu.com', 'weibo.com/525456886/', '保密', 0, 'admin@local.host', 'I am a author for lsblog.', '保密', 0, 0, 1, 0, 0, 0, 0, 0, '保密', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
