<?php 
$queryTables = array(); $querySQL =array(); 
$queryTables['blockcms']['cms']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."cms` (
  `id_cms` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cms_category` int(10) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `indexation` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cms`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8";


$queryTables['blockcms']['cms_block']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."cms_block` (
  `id_cms_block` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cms_category` int(10) unsigned NOT NULL,
  `location` tinyint(1) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `display_store` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cms_block`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8";


$queryTables['blockcms']['cms_block_lang']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."cms_block_lang` (
  `id_cms_block` int(10) unsigned NOT NULL,
  `id_lang` int(10) unsigned NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_cms_block`,`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";


$queryTables['blockcms']['cms_block_page']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."cms_block_page` (
  `id_cms_block_page` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cms_block` int(10) unsigned NOT NULL,
  `id_cms` int(10) unsigned NOT NULL,
  `is_category` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id_cms_block_page`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8";


$queryTables['blockcms']['cms_block_shop']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."cms_block_shop` (
  `id_cms_block` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_shop` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_cms_block`,`id_shop`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8";


/*DATA FOR TABLE cms*/
 $querySQL['cms'][]="INSERT INTO "._DB_PREFIX_."cms( `id_cms`,`id_cms_category`,`position`,`active`,`indexation` ) VALUES('1', '1', '0', '1', '0')"; 
 $querySQL['cms'][]="INSERT INTO "._DB_PREFIX_."cms( `id_cms`,`id_cms_category`,`position`,`active`,`indexation` ) VALUES('2', '1', '1', '1', '0')"; 
 $querySQL['cms'][]="INSERT INTO "._DB_PREFIX_."cms( `id_cms`,`id_cms_category`,`position`,`active`,`indexation` ) VALUES('3', '1', '2', '1', '0')"; 
 $querySQL['cms'][]="INSERT INTO "._DB_PREFIX_."cms( `id_cms`,`id_cms_category`,`position`,`active`,`indexation` ) VALUES('4', '1', '3', '1', '0')"; 
 $querySQL['cms'][]="INSERT INTO "._DB_PREFIX_."cms( `id_cms`,`id_cms_category`,`position`,`active`,`indexation` ) VALUES('5', '1', '4', '1', '0')"; 
 $querySQL['cms'][]="INSERT INTO "._DB_PREFIX_."cms( `id_cms`,`id_cms_category`,`position`,`active`,`indexation` ) VALUES('6', '1', '5', '1', '0')"; 
/*DATA FOR TABLE cms_block*/
 $querySQL['cms_block'][]="INSERT INTO "._DB_PREFIX_."cms_block( `id_cms_block`,`id_cms_category`,`location`,`position`,`display_store` ) VALUES('1', '1', '0', '0', '1')"; 
/*DATA FOR TABLE cms_block_lang*/
 $querySQL['cms_block_lang'][]="INSERT INTO "._DB_PREFIX_."cms_block_lang( `id_cms_block`,`id_lang`,`name` ) VALUES('1', '_LANGUAGEID_', 'Information')"; 
/*DATA FOR TABLE cms_block_page*/
 $querySQL['cms_block_page'][]="INSERT INTO "._DB_PREFIX_."cms_block_page( `id_cms_block_page`,`id_cms_block`,`id_cms`,`is_category` ) VALUES('1', '1', '1', '0')"; 
 $querySQL['cms_block_page'][]="INSERT INTO "._DB_PREFIX_."cms_block_page( `id_cms_block_page`,`id_cms_block`,`id_cms`,`is_category` ) VALUES('2', '1', '2', '0')"; 
 $querySQL['cms_block_page'][]="INSERT INTO "._DB_PREFIX_."cms_block_page( `id_cms_block_page`,`id_cms_block`,`id_cms`,`is_category` ) VALUES('3', '1', '3', '0')"; 
 $querySQL['cms_block_page'][]="INSERT INTO "._DB_PREFIX_."cms_block_page( `id_cms_block_page`,`id_cms_block`,`id_cms`,`is_category` ) VALUES('4', '1', '4', '0')"; 
 $querySQL['cms_block_page'][]="INSERT INTO "._DB_PREFIX_."cms_block_page( `id_cms_block_page`,`id_cms_block`,`id_cms`,`is_category` ) VALUES('5', '1', '5', '0')"; 
 $querySQL['cms_block_page'][]="INSERT INTO "._DB_PREFIX_."cms_block_page( `id_cms_block_page`,`id_cms_block`,`id_cms`,`is_category` ) VALUES('6', '1', '6', '0')"; 
/*DATA FOR TABLE cms_block_shop*/
 $querySQL['cms_block_shop'][]="INSERT INTO "._DB_PREFIX_."cms_block_shop( `id_cms_block`,`id_shop` ) VALUES('1', '_SHOPID_')"; 

?>