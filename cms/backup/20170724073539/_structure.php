<?php 
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS article");
\houdunwang\db\Db::execute("CREATE TABLE `article` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `title` text NOT NULL,
  `click` mediumint(9) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `source` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `orderby` smallint(6) NOT NULL,
  `linkurl` char(60) NOT NULL,
  `keywords` char(30) NOT NULL,
  `iscommend` enum('是','否') NOT NULL,
  `ishot` enum('是','否') NOT NULL,
  `categorycid` int(11) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8");
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS attachment");
\houdunwang\db\Db::execute("CREATE TABLE `attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员编号',
  `name` varchar(80) NOT NULL,
  `filename` varchar(300) NOT NULL COMMENT '文件名',
  `path` varchar(300) NOT NULL COMMENT '文件路径',
  `extension` varchar(10) NOT NULL DEFAULT '' COMMENT '文件类型',
  `createtime` int(10) NOT NULL COMMENT '上传时间',
  `size` mediumint(9) NOT NULL COMMENT '文件大小',
  `data` varchar(100) NOT NULL DEFAULT '' COMMENT '辅助信息',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `content` text NOT NULL COMMENT '扩展数据内容',
  PRIMARY KEY (`id`),
  KEY `data` (`data`),
  KEY `extension` (`extension`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='附件'");
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS category");
\houdunwang\db\Db::execute("CREATE TABLE `category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `orderby` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8");
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS config");
\houdunwang\db\Db::execute("CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS flash");
\houdunwang\db\Db::execute("CREATE TABLE `flash` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `thumb` varchar(255) NOT NULL,
  `article_aid` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `orderby` tinyint(4) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8");
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS keyword");
\houdunwang\db\Db::execute("CREATE TABLE `keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL COMMENT '所属模型',
  `keyword` varchar(255) NOT NULL COMMENT '关键词内容',
  `content_id` varchar(255) NOT NULL COMMENT '回复内容主键',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8");
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS migrations");
\houdunwang\db\Db::execute("CREATE TABLE `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS module");
\houdunwang\db\Db::execute("CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '模块标识',
  `title` varchar(255) NOT NULL COMMENT '模块名称',
  `author` varchar(255) NOT NULL COMMENT '模块作者',
  `description` varchar(255) NOT NULL COMMENT '模块介绍',
  `preview` varchar(255) NOT NULL COMMENT '预览图片',
  `is_weixin` varchar(255) NOT NULL COMMENT '是否处理微信',
  `is_system` varchar(255) NOT NULL COMMENT '是否为系统模块',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8");
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS seeds");
\houdunwang\db\Db::execute("CREATE TABLE `seeds` (
  `seed` varchar(255) NOT NULL,
  `batch` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS user");
\houdunwang\db\Db::execute("CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `username` char(30) NOT NULL,
  `password` char(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS weixinconfig");
\houdunwang\db\Db::execute("CREATE TABLE `weixinconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weixinname` varchar(255) NOT NULL COMMENT '微信公众号名称',
  `weixin` varchar(255) NOT NULL COMMENT '微信号',
  `appid` varchar(255) NOT NULL COMMENT 'appid',
  `appsecret` varchar(255) NOT NULL COMMENT 'appsecret',
  `token` varchar(255) NOT NULL COMMENT 'token',
  `encodingaeskey` varchar(255) NOT NULL COMMENT 'encodingaeskey',
  `default_message` varchar(255) NOT NULL,
  `welcome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
\houdunwang\db\Db::execute("DROP TABLE IF EXISTS wxcontent");
\houdunwang\db\Db::execute("CREATE TABLE `wxcontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8");
