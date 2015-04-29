<?php 
$queryTables = array(); $querySQL =array(); 
$queryTables['leoblog']['leoblogcat']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."leoblogcat` (
  `id_leoblogcat` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `item` varchar(255) DEFAULT NULL,
  `level_depth` smallint(6) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `show_title` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `submenu_content` text NOT NULL,
  `privacy` smallint(6) DEFAULT NULL,
  `position_type` varchar(25) DEFAULT NULL,
  `menu_class` varchar(25) DEFAULT NULL,
  `content` text,
  `icon_class` varchar(255) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `left` int(11) NOT NULL,
  `right` int(11) NOT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_upd` datetime DEFAULT NULL,
  `template` varchar(200) NOT NULL,
  PRIMARY KEY (`id_leoblogcat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8";


$queryTables['leoblog']['leoblogcat_lang']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."leoblogcat_lang` (
  `id_leoblogcat` int(11) NOT NULL,
  `id_lang` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content_text` text,
  `description` varchar(200) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `link_rewrite` varchar(250) NOT NULL,
  PRIMARY KEY (`id_leoblogcat`,`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";


$queryTables['leoblog']['leoblogcat_shop']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."leoblogcat_shop` (
  `id_leoblogcat` int(11) NOT NULL DEFAULT '0',
  `id_shop` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_leoblogcat`,`id_shop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";


$queryTables['leoblog']['leoblog_blog']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."leoblog_blog` (
  `id_leoblog_blog` int(11) NOT NULL AUTO_INCREMENT,
  `id_leoblogcat` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `date_add` date NOT NULL,
  `active` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_upd` datetime NOT NULL,
  `video_code` text,
  `params` text,
  `featured` tinyint(1) NOT NULL,
  `indexation` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `product_ids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_leoblog_blog`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8";


$queryTables['leoblog']['leoblog_blog_lang']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."leoblog_blog_lang` (
  `id_leoblog_blog` int(11) NOT NULL,
  `id_lang` int(11) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(250) NOT NULL,
  `meta_title` varchar(250) NOT NULL,
  `link_rewrite` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id_leoblog_blog`,`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";


$queryTables['leoblog']['leoblog_blog_shop']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."leoblog_blog_shop` (
  `id_leoblog_blog` int(11) NOT NULL DEFAULT '0',
  `id_shop` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_leoblog_blog`,`id_shop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";


$queryTables['leoblog']['leoblog_comment']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."leoblog_comment` (
  `id_comment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_shop` int(11) NOT NULL DEFAULT '0',
  `id_leoblog_blog` int(11) unsigned NOT NULL,
  `comment` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `date_add` datetime DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id_comment`,`id_shop`),
  KEY `FK_blog_comment` (`id_leoblog_blog`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8";


/*DATA FOR TABLE leoblogcat*/
 $querySQL['leoblogcat'][]="INSERT INTO "._DB_PREFIX_."leoblogcat( `id_leoblogcat`,`image`,`id_parent`,`item`,`level_depth`,`active`,`show_title`,`position`,`submenu_content`,`privacy`,`position_type`,`menu_class`,`content`,`icon_class`,`level`,`left`,`right`,`date_add`,`date_upd`,`template` ) VALUES('1', '', '0', '', '0', '0', '0', '0', '', '', '', '', '', '', '0', '0', '0', '', '', '')"; 
 $querySQL['leoblogcat'][]="INSERT INTO "._DB_PREFIX_."leoblogcat( `id_leoblogcat`,`image`,`id_parent`,`item`,`level_depth`,`active`,`show_title`,`position`,`submenu_content`,`privacy`,`position_type`,`menu_class`,`content`,`icon_class`,`level`,`left`,`right`,`date_add`,`date_upd`,`template` ) VALUES('3', 'category-3.jpg', '1', '', '1', '1', '0', '0', '', '0', '', '', '', '', '0', '0', '0', '2013-11-27 01:06:52', '2013-12-18 03:07:22', 'default')"; 
 $querySQL['leoblogcat'][]="INSERT INTO "._DB_PREFIX_."leoblogcat( `id_leoblogcat`,`image`,`id_parent`,`item`,`level_depth`,`active`,`show_title`,`position`,`submenu_content`,`privacy`,`position_type`,`menu_class`,`content`,`icon_class`,`level`,`left`,`right`,`date_add`,`date_upd`,`template` ) VALUES('4', 'category-2.jpg', '3', '', '2', '1', '0', '0', '', '0', '', '', '', '', '0', '0', '0', '2013-11-27 01:07:34', '2013-12-18 03:07:50', 'default')"; 
 $querySQL['leoblogcat'][]="INSERT INTO "._DB_PREFIX_."leoblogcat( `id_leoblogcat`,`image`,`id_parent`,`item`,`level_depth`,`active`,`show_title`,`position`,`submenu_content`,`privacy`,`position_type`,`menu_class`,`content`,`icon_class`,`level`,`left`,`right`,`date_add`,`date_upd`,`template` ) VALUES('5', 'category-1.jpg', '3', '', '2', '1', '0', '1', '', '0', '', 'icon', '', 'fa-edit', '0', '0', '0', '2013-12-16 08:44:07', '2013-12-18 03:05:46', 'default')"; 
/*DATA FOR TABLE leoblogcat_lang*/
 $querySQL['leoblogcat_lang'][]="INSERT INTO "._DB_PREFIX_."leoblogcat_lang( `id_leoblogcat`,`id_lang`,`title`,`content_text`,`description`,`meta_keywords`,`meta_description`,`link_rewrite` ) VALUES('1', '_LANGUAGEID_', 'Root', '', '', '', '', '')"; 
 $querySQL['leoblogcat_lang'][]="INSERT INTO "._DB_PREFIX_."leoblogcat_lang( `id_leoblogcat`,`id_lang`,`title`,`content_text`,`description`,`meta_keywords`,`meta_description`,`link_rewrite` ) VALUES('3', '_LANGUAGEID_', 'Category 1', '<p>Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue</p>', '', '', '\r\n', 'category-1')"; 
 $querySQL['leoblogcat_lang'][]="INSERT INTO "._DB_PREFIX_."leoblogcat_lang( `id_leoblogcat`,`id_lang`,`title`,`content_text`,`description`,`meta_keywords`,`meta_description`,`link_rewrite` ) VALUES('4', '_LANGUAGEID_', 'Sub Category 1', '<p>Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue</p>', '', 'joomla,prestashop,leotheme,pavothemes', '', 'sub-category-1')"; 
 $querySQL['leoblogcat_lang'][]="INSERT INTO "._DB_PREFIX_."leoblogcat_lang( `id_leoblogcat`,`id_lang`,`title`,`content_text`,`description`,`meta_keywords`,`meta_description`,`link_rewrite` ) VALUES('5', '_LANGUAGEID_', 'Sub Category 2', '<p>Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue</p>', '', 'haha,joomla,magento', 'gogogoel', 'sub-category-2')"; 
/*DATA FOR TABLE leoblogcat_shop*/
 $querySQL['leoblogcat_shop'][]="INSERT INTO "._DB_PREFIX_."leoblogcat_shop( `id_leoblogcat`,`id_shop` ) VALUES('1', '_SHOPID_')"; 
 $querySQL['leoblogcat_shop'][]="INSERT INTO "._DB_PREFIX_."leoblogcat_shop( `id_leoblogcat`,`id_shop` ) VALUES('3', '_SHOPID_')"; 
 $querySQL['leoblogcat_shop'][]="INSERT INTO "._DB_PREFIX_."leoblogcat_shop( `id_leoblogcat`,`id_shop` ) VALUES('4', '_SHOPID_')"; 
 $querySQL['leoblogcat_shop'][]="INSERT INTO "._DB_PREFIX_."leoblogcat_shop( `id_leoblogcat`,`id_shop` ) VALUES('5', '_SHOPID_')"; 
/*DATA FOR TABLE leoblog_blog*/
 $querySQL['leoblog_blog'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog( `id_leoblog_blog`,`id_leoblogcat`,`position`,`date_add`,`active`,`user_id`,`hits`,`image`,`date_upd`,`video_code`,`params`,`featured`,`indexation`,`id_employee`,`product_ids` ) VALUES('3', '4', '0', '2013-11-28', '1', '0', '40', 'b-blog-1.jpg', '2013-12-20 09:55:38', '<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/lzY4lkT8ElU\" frameborder=\"0\" allowfullscreen></iframe>', '', '0', '1', '1', '')"; 
 $querySQL['leoblog_blog'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog( `id_leoblog_blog`,`id_leoblogcat`,`position`,`date_add`,`active`,`user_id`,`hits`,`image`,`date_upd`,`video_code`,`params`,`featured`,`indexation`,`id_employee`,`product_ids` ) VALUES('4', '4', '2', '2013-12-04', '1', '0', '105', 'b-blog-2.jpg', '2013-12-18 06:31:14', '', '', '0', '1', '1', '')"; 
 $querySQL['leoblog_blog'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog( `id_leoblog_blog`,`id_leoblogcat`,`position`,`date_add`,`active`,`user_id`,`hits`,`image`,`date_upd`,`video_code`,`params`,`featured`,`indexation`,`id_employee`,`product_ids` ) VALUES('5', '4', '3', '2013-12-16', '1', '0', '9', 'b-blog-3.jpg', '2013-12-19 01:21:28', '', '', '0', '0', '1', '')"; 
 $querySQL['leoblog_blog'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog( `id_leoblog_blog`,`id_leoblogcat`,`position`,`date_add`,`active`,`user_id`,`hits`,`image`,`date_upd`,`video_code`,`params`,`featured`,`indexation`,`id_employee`,`product_ids` ) VALUES('6', '4', '4', '2013-12-18', '1', '0', '135', 'b-blog-4.jpg', '2013-12-20 09:54:03', '', '', '0', '0', '1', '')"; 
 $querySQL['leoblog_blog'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog( `id_leoblog_blog`,`id_leoblogcat`,`position`,`date_add`,`active`,`user_id`,`hits`,`image`,`date_upd`,`video_code`,`params`,`featured`,`indexation`,`id_employee`,`product_ids` ) VALUES('7', '4', '5', '2013-12-18', '1', '0', '72', 'b-blog-5.jpg', '2013-12-20 01:04:46', '', '', '0', '0', '1', '')"; 
 $querySQL['leoblog_blog'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog( `id_leoblog_blog`,`id_leoblogcat`,`position`,`date_add`,`active`,`user_id`,`hits`,`image`,`date_upd`,`video_code`,`params`,`featured`,`indexation`,`id_employee`,`product_ids` ) VALUES('8', '4', '1', '2013-12-18', '1', '0', '3', 'b-blog-6.jpg', '2013-12-19 22:50:10', '', '', '0', '0', '1', '')"; 
 $querySQL['leoblog_blog'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog( `id_leoblog_blog`,`id_leoblogcat`,`position`,`date_add`,`active`,`user_id`,`hits`,`image`,`date_upd`,`video_code`,`params`,`featured`,`indexation`,`id_employee`,`product_ids` ) VALUES('9', '4', '6', '2013-12-18', '1', '0', '0', 'b-blog-7.jpg', '2013-12-18 03:32:42', '', '', '0', '1', '1', '')"; 
/*DATA FOR TABLE leoblog_blog_lang*/
 $querySQL['leoblog_blog_lang'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_lang( `id_leoblog_blog`,`id_lang`,`meta_description`,`meta_keywords`,`meta_title`,`link_rewrite`,`content`,`description`,`tags` ) VALUES('3', '_LANGUAGEID_', '', '', 'At risus pretium urna tortor metus fringilla', 'at-risus-pretium-urna-tortor-metus-fringilla', '<p>Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue</p>\r\n<p> </p>\r\n<p>Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue</p>\r\n<p> </p>\r\n<p>Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue</p>\r\n<p> </p>\r\n<p>Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue</p>', '<p>Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue</p>', 'joomla,wordpress')"; 
 $querySQL['leoblog_blog_lang'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_lang( `id_leoblog_blog`,`id_lang`,`meta_description`,`meta_keywords`,`meta_title`,`link_rewrite`,`content`,`description`,`tags` ) VALUES('4', '_LANGUAGEID_', '', '', 'Ipsum cursus vestibulum at interdum Vivamus', 'ipsum-cursus-vestibulum-at-interdum-vivamus', '<p>Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae. Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae. Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae.</p>\r\n<p>Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae.Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae.Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae.</p>', '<p>Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae.</p>', 'joomla,prestashop,leotheme')"; 
 $querySQL['leoblog_blog_lang'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_lang( `id_leoblog_blog`,`id_lang`,`meta_description`,`meta_keywords`,`meta_title`,`link_rewrite`,`content`,`description`,`tags` ) VALUES('5', '_LANGUAGEID_', '', 'joomla,prestashop,leotheme,prestashop theme', 'Urna pretium elit mauris cursus Curabitur at elit Vestibulum', 'urna-pretium-elit-mauris-cursus-curabitur-at-elit-vestibulum', '<p>Mi vitae magnis Fusce laoreet nibh felis porttitor laoreet Vestibulum faucibus. At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In. Turpis at eleifend leo mi elit Aenean porta ac sed faucibus. Nunc urna Morbi fringilla vitae orci convallis condimentum auctor sit dui. Urna pretium elit mauris cursus Curabitur at elit Vestibulum.</p>', '<p>Mi vitae magnis Fusce laoreet nibh felis porttitor laoreet Vestibulum faucibus. At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In. Turpis at eleifend leo mi elit Aenean porta ac sed faucibus. </p>', 'Joomla')"; 
 $querySQL['leoblog_blog_lang'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_lang( `id_leoblog_blog`,`id_lang`,`meta_description`,`meta_keywords`,`meta_title`,`link_rewrite`,`content`,`description`,`tags` ) VALUES('6', '_LANGUAGEID_', '', '', 'Urna pretium elit mauris cursus Curabitur at elit Vestibulum', 'urna-pretium-elit-mauris-cursus-curabitur-at-elit-vestibulum', '<p>Mi vitae magnis Fusce laoreet nibh felis porttitor laoreet Vestibulum faucibus. At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In. Turpis at eleifend leo mi elit Aenean porta ac sed faucibus. Nunc urna Morbi fringilla vitae orci convallis condimentum auctor sit dui. Urna pretium elit mauris cursus Curabitur at elit Vestibulum. Mi vitae magnis Fusce laoreet nibh felis porttitor laoreet Vestibulum faucibus. At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In. Turpis at eleifend leo mi elit Aenean porta ac sed faucibus. Nunc urna Morbi fringilla vitae orci convallis condimentum auctor sit dui. Urna pretium elit mauris cursus Curabitur at elit Vestibulum.</p>', '<p>Mi vitae magnis Fusce laoreet nibh felis porttitor laoreet Vestibulum faucibus. At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In. Turpis at eleifend leo mi elit Aenean porta ac sed faucibus. Nunc urna Morbi fringilla vitae orci convallis condimentum auctor sit dui. Urna pretium elit mauris cursus Curabitur at elit Vestibulum.</p>', 'leotheme,prestashop,theme')"; 
 $querySQL['leoblog_blog_lang'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_lang( `id_leoblog_blog`,`id_lang`,`meta_description`,`meta_keywords`,`meta_title`,`link_rewrite`,`content`,`description`,`tags` ) VALUES('7', '_LANGUAGEID_', '', '', 'Morbi condimentum molestie Nam enim odio sodales', 'morbi-condimentum-molestie-nam-enim-odio-sodales', '<div class=\"description clearfix\"><p>Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue.</p></div><div class=\"blog-content clearfix\"><div class=\"content-wrap clearfix\"><div class=\"itemFullText\"><p>Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur magna. Euismod euismod Suspendisse tortor ante adipiscing risus Aenean Lorem vitae id. Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor Aenean nulla lacinia Nullam elit vel vel. At risus pretium urna tortor metus fringilla interdum mauris tempor congue.</p><p>Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae.</p><p>Sed mauris Pellentesque elit Aliquam at lacus interdum nascetur elit ipsum. Enim ipsum hendrerit Suspendisse turpis laoreet fames tempus ligula pede ac. Et Lorem penatibus orci eu ultrices egestas Nam quam Vivamus nibh. Morbi condimentum molestie Nam enim odio sodales pretium eros sem pellentesque. Sit tellus Integer elit egestas lacus turpis id auctor nascetur ut. Ac elit vitae.</p><p>Mi vitae magnis Fusce laoreet nibh felis porttitor laoreet Vestibulum faucibus. At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In. Turpis at eleifend leo mi elit Aenean porta ac sed faucibus. Nunc urna Morbi fringilla vitae orci convallis condimentum auctor sit dui. Urna pretium elit mauris cursus Curabitur at elit Vestibulum.</p></div></div></div>', '<p>Sed mauris Pellentesque elit Aliquam at lacus interdum nascetur elit ipsum. Enim ipsum hendrerit Suspendisse turpis laoreet fames tempus ligula pede ac. Et Lorem penatibus orci eu ultrices egestas Nam quam Vivamus nibh.</p>', 'leotheme,prestashop,magento,opencart')"; 
 $querySQL['leoblog_blog_lang'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_lang( `id_leoblog_blog`,`id_lang`,`meta_description`,`meta_keywords`,`meta_title`,`link_rewrite`,`content`,`description`,`tags` ) VALUES('8', '_LANGUAGEID_', '', '', 'Turpis at eleifend leo mi elit Aenean porta ac sed faucibus', 'turpis-at-eleifend-leo-mi-elit-aenean-porta-ac-sed-faucibus', '<div class=\"description clearfix\">\r\n<p>Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor. At risus pretium urna tortor metus fringilla interdum mauris tempor congue.</p>\r\n</div>\r\n<div class=\"blog-content clearfix\">\r\n<div class=\"content-wrap clearfix\">\r\n<div class=\"itemFullText\">\r\n<p>Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur magna. Euismod euismod Suspendisse tortor ante adipiscing risus Aenean Lorem vitae id. Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor Aenean nulla lacinia Nullam elit vel vel. At risus pretium urna tortor metus fringilla interdum mauris tempor congue.</p>\r\n<p>Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae.</p>\r\n<p>Sed mauris Pellentesque elit Aliquam at lacus interdum nascetur elit ipsum. Enim ipsum hendrerit Suspendisse turpis laoreet fames tempus ligula pede ac. Et Lorem penatibus orci eu ultrices egestas Nam quam Vivamus nibh. Morbi condimentum molestie Nam enim odio sodales pretium eros sem pellentesque. Sit tellus Integer elit egestas lacus turpis id auctor nascetur ut. Ac elit vitae.</p>\r\n<p>Mi vitae magnis Fusce laoreet nibh felis porttitor laoreet Vestibulum faucibus. At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In. Turpis at eleifend leo mi elit Aenean porta ac sed faucibus. Nunc urna Morbi fringilla vitae orci convallis condimentum auctor sit dui. Urna pretium elit mauris cursus Curabitur at elit Vestibulum.</p>\r\n</div>\r\n</div>\r\n</div>', '<p>Turpis at eleifend leo mi elit Aenean porta ac sed faucibus. Nunc urna Morbi fringilla vitae orci convallis condimentum auctor sit dui. Urna pretium elit mauris cursus Curabitur at elit Vestibulum</p>', 'magento,opencart,template')"; 
 $querySQL['leoblog_blog_lang'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_lang( `id_leoblog_blog`,`id_lang`,`meta_description`,`meta_keywords`,`meta_title`,`link_rewrite`,`content`,`description`,`tags` ) VALUES('9', '_LANGUAGEID_', '', '', 'Nullam ullamcorper nisl quis ornare molestie', 'nullam-ullamcorper-nisl-quis-ornare-molestie', '<div class=\"description clearfix\">\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quas.</p>\r\n</div>\r\n<div class=\"blog-content clearfix\">\r\n<div class=\"content-wrap clearfix\">\r\n<p>Suspendisse posuere, diam in bibendum lobortis, turpis ipsum aliquam risus, sit amet dictum ligula lorem non nisl. Ut vitae nibh id massa vulputate euismod ut quis justo. Ut bibendum sem at massa lacinia, eget elementum ante consectetur. Nulla id pharetra dui, at rhoncus urna. Maecenas non porttitor purus. Nullam ullamcorper nisl quis ornare molestie.</p>\r\n<p>Etiam eget erat est. Phasellus elit justo, mattis non lorem non, aliquam aliquam leo. Sed fermentum consectetur magna, eget semper ante. Aliquam scelerisque justo velit. Fusce cursus blandit dolor, in sodales urna vulputate lobortis. Nulla ut tellus turpis. Nullam lacus sem, volutpat id odio sed, cursus tristique eros. Duis at pellentesque magna. Donec magna nisi, vulputate ac nulla eu, ultricies tincidunt tellus. Nunc tincidunt sem urna, nec venenatis libero vehicula ut.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur faucibus aliquam pulvinar. Vivamus mattis volutpat erat, et congue nisi semper quis. Cras vehicula dignissim libero in elementum. Mauris sit amet dolor justo. Morbi consequat velit vel est fermentum euismod. Curabitur in magna augue.</p>\r\n</div>\r\n</div>', '<p>Suspendisse posuere, diam in bibendum lobortis, turpis ipsum aliquam risus, sit amet dictum ligula lorem non nisl. Ut vitae nibh id massa vulputate euismod ut quis justo. Ut bibendum sem at massa lacinia, eget elementum ante consectetur. Nulla id pharetra dui, at rhoncus urna. Maecenas non porttitor purus. Nullam ullamcorper nisl quis ornare molestie</p>', 'opencart,theme')"; 
/*DATA FOR TABLE leoblog_blog_shop*/
 $querySQL['leoblog_blog_shop'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_shop( `id_leoblog_blog`,`id_shop` ) VALUES('3', '_SHOPID_')"; 
 $querySQL['leoblog_blog_shop'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_shop( `id_leoblog_blog`,`id_shop` ) VALUES('4', '_SHOPID_')"; 
 $querySQL['leoblog_blog_shop'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_shop( `id_leoblog_blog`,`id_shop` ) VALUES('5', '_SHOPID_')"; 
 $querySQL['leoblog_blog_shop'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_shop( `id_leoblog_blog`,`id_shop` ) VALUES('6', '_SHOPID_')"; 
 $querySQL['leoblog_blog_shop'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_shop( `id_leoblog_blog`,`id_shop` ) VALUES('7', '_SHOPID_')"; 
 $querySQL['leoblog_blog_shop'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_shop( `id_leoblog_blog`,`id_shop` ) VALUES('8', '_SHOPID_')"; 
 $querySQL['leoblog_blog_shop'][]="INSERT INTO "._DB_PREFIX_."leoblog_blog_shop( `id_leoblog_blog`,`id_shop` ) VALUES('9', '_SHOPID_')"; 
/*DATA FOR TABLE leoblog_comment*/
 $querySQL['leoblog_comment'][]="INSERT INTO "._DB_PREFIX_."leoblog_comment( `id_comment`,`id_shop`,`id_leoblog_blog`,`comment`,`active`,`date_add`,`user`,`email` ) VALUES('3', '_SHOPID_', '3', ' At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In', '1', '2013-12-11 22:18:13', 'ha cong tien', 'tienhc@brainos.vn')"; 
 $querySQL['leoblog_comment'][]="INSERT INTO "._DB_PREFIX_."leoblog_comment( `id_comment`,`id_shop`,`id_leoblog_blog`,`comment`,`active`,`date_add`,`user`,`email` ) VALUES('4', '_SHOPID_', '3', ' At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In', '1', '2013-12-11 22:18:33', 'ha cong tien', 'tienhc@brainos.vn')"; 

?>