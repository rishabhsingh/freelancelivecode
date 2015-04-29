<?php
/******************************************************
 *  Leo Blog Content Management
 *
 * @package   leoblog
 * @version   1.0
 * @author    http://www.leotheme.com
 * @copyright Copyright (C) December 2013 LeoThemes.com <@emai:leotheme@gmail.com>
 *               <info@leotheme.com>.All rights reserved.
 * @license   GNU General Public License version 2
 * ******************************************************/
define( '_LEO_BLOG_PREFIX_', 'LEOBLG_' );
require_once(_PS_MODULE_DIR_ . 'leoblog/classes/config.php');

$config = LeoBlogConfig::getInstance();


define( "_LEOBLOG_BLOG_IMG_DIR_", _PS_MODULE_DIR_ . 'leoblog/img/' );
define( '_LEOBLOG_BLOG_IMG_URI_', __PS_BASE_URI__.'modules/leoblog/img/' );


define( "_LEOBLOG_CATEGORY_IMG_URI_", _PS_MODULE_DIR_ . 'leoblog/img/' );
define( '_LEOBLOG_CATEGORY_IMG_DIR_', __PS_BASE_URI__.'modules/leoblog/img/' );

define( "_LEOBLOG_CACHE_IMG_DIR_", _PS_IMG_DIR_.'leoblog/' );
define( "_LEOBLOG_CACHE_IMG_URI_", _PS_IMG_.'leoblog/' );
 
define( '_LEO_BLOG_REWRITE_ROUTE_', $config->get( 'link_rewrite', 'blog' )  ); 


if( !is_dir(_LEOBLOG_BLOG_IMG_DIR_.'c') ){ 
	mkdir( _LEOBLOG_BLOG_IMG_DIR_.'c', 0777 );
}

if( !is_dir(_LEOBLOG_BLOG_IMG_DIR_.'b') ){ 
	mkdir( _LEOBLOG_BLOG_IMG_DIR_.'b', 0777 );
}

if( !is_dir(_LEOBLOG_CACHE_IMG_DIR_) ){ 
	mkdir( _LEOBLOG_CACHE_IMG_DIR_, 0777 );
}
if( !is_dir(_LEOBLOG_CACHE_IMG_DIR_.'c')){
	mkdir( _LEOBLOG_CACHE_IMG_DIR_.'c', 0777 );
}
if( !is_dir(_LEOBLOG_CACHE_IMG_DIR_.'b')){
	mkdir( _LEOBLOG_CACHE_IMG_DIR_.'b', 0777 );
}

require_once(_PS_MODULE_DIR_ . 'leoblog/classes/helper.php');
require_once(_PS_MODULE_DIR_ . 'leoblog/classes/leoblogcat.php');
require_once(_PS_MODULE_DIR_ . 'leoblog/classes/blog.php');
require_once(_PS_MODULE_DIR_ . 'leoblog/classes/link.php');
require_once(_PS_MODULE_DIR_ . 'leoblog/classes/comment.php');
?>