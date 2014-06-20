-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-06-18 17:34:22
-- 服务器版本： 5.5.37-log
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lsblog`
--

-- --------------------------------------------------------

--
-- 表的结构 `ls_ablum`
--

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

-- --------------------------------------------------------

--
-- 表的结构 `ls_categorise`
--

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

--
-- 转存表中的数据 `ls_categorise`
--

INSERT INTO `ls_categorise` (`id`, `fid`, `cate_name`, `cate_english`, `description`, `cate_image`, `cate_order`, `visible`, `path`, `type`, `url`) VALUES
(1, 0, '网络技术', 'Internet', '汇集各种网络产品，例如如何使用sqlyog等。也包括了各种网络技术，例如包括Yii，Linux，PHP，Mysql，apache等等', '/upload/ablum/201405/1400229653836.jpg', 0, 1, '0-11', 1, 'none'),
(2, 0, '影视生活', 'Living', '生活指为生存而发展，经济的发展带动了价值的体现，实现我们的梦想，带着我们走进先进科学社会，懂得生活的乐趣，生活也是体现人类这种生命的所有的日常活动和经历的总和。广义上指人的各种活动。', '/upload/ablum/201312/1386728579314.png', 0, 1, '0-10', 1, 'none'),
(4, 0, '旅游摄影', 'Travell', '生活指为生存而发展，经济的发展带动了价值的体现，实现我们的梦想，带着我们走进先进科学社会，懂得生活的乐趣，生活也是体现人类这种生命的所有的日常活动和经历的总和。广义上指人的各种活动', '/upload/ablum/201312/1386728590614.png', 0, 1, '0-8', 1, 'none'),
(3, 0, '游戏动漫', 'Games', '游戏是劳作后的休息和消遣，本身不带有任何目的性的一种行为活动。', '/upload/ablum/201312/1386728602512.png', 0, 1, '0-9', 1, 'none'),
(5, 0, '相册展示', 'Ablum', '首页展示', '/upload/ablum/201406/1402886448357.jpg', 0, 1, '0-13', 2, '/ablum');

-- --------------------------------------------------------

--
-- 表的结构 `ls_comments`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ls_images`
--

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

-- --------------------------------------------------------

--
-- 表的结构 `ls_links`
--

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

-- --------------------------------------------------------

--
-- 表的结构 `ls_posts`
--

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ls_site`
--

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

--
-- 转存表中的数据 `ls_site`
--

INSERT INTO `ls_site` (`id`, `name`, `variate`, `value`, `is_show`, `type`, `html`) VALUES
(1, '网站名称', 'blogname', 'lsblog', 1, 1, 'text'),
(2, '网站简介', 'description', 'lsblog is a blog besed on Yii Framework', 1, 1, 'text'),
(3, '联系邮箱', 'adminemail', 'ybt7755221@gmail.com', 1, 1, 'text'),
(4, '网站作者', 'author', 'burtyu', 1, 1, 'text'),
(5, '网站关键字', 'keyborad', 'lsblog,Burt,Yii', 1, 1, 'text'),
(6, '土豪金风格', 'theme', 'flat', 1, 2, 'text'),
(7, '网站状态', 'site_status', '1', 1, 1, 'select'),
(8, '网站备案号', 'web_bak', '0', 1, 1, 'text');

-- --------------------------------------------------------

--
-- 表的结构 `ls_tags`
--

CREATE TABLE IF NOT EXISTS `ls_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_uid` bigint(20) unsigned NOT NULL,
  `tagname` varchar(60) NOT NULL,
  `description` varchar(250) NOT NULL,
  `tag_order` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tag_order` (`tag_order`),
  KEY `tagname` (`tagname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ls_users`
--

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

--
-- 转存表中的数据 `ls_users`
--

INSERT INTO `ls_users` (`id`, `username`, `password`, `status`, `nickname`, `create_time`) VALUES
(1, 'ybt7755221@sohu.com', '8130e0c094bf7686a56c7f045dd40c73', 3, 'burtyu', 1348644101);

-- --------------------------------------------------------

--
-- 表的结构 `ls_user_field`
--

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

--
-- 转存表中的数据 `ls_user_field`
--

INSERT INTO `ls_user_field` (`uid`, `logo`, `weight`, `height`, `sex`, `sexual`, `felling`, `blood`, `birthday`, `email`, `weibo`, `weixin`, `qq`, `msn`, `description`, `university`, `is_qq`, `is_email`, `is_sexual`, `is_weibo`, `is_weixin`, `is_msn`, `is_birthday`, `is_edu`, `school`, `is_felling`) VALUES
(1, '/upload/users/201405/1400232784413.jpg', 80, 179, 'M', 'M', 0, 'B', '1949-01-01', 'ybt7755221@gmail.com', 'weibo.com/525456886/', 'huarenwuyou', 0, 'admin@admin.com', 'I am a author for lsblog.', '保密', 0, 0, 1, 0, 0, 0, 0, 1, '保密', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
