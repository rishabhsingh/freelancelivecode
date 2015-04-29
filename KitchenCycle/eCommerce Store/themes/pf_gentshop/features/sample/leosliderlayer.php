<?php 
$queryTables = array(); $querySQL =array(); 
$queryTables['leosliderlayer']['leosliderlayer_groups']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."leosliderlayer_groups` (
  `id_leosliderlayer_groups` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `id_shop` int(10) unsigned NOT NULL,
  `hook` varchar(64) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  PRIMARY KEY (`id_leosliderlayer_groups`,`id_shop`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8";


$queryTables['leosliderlayer']['leosliderlayer_slides']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."leosliderlayer_slides` (
  `id_leosliderlayer_slides` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `parent_id` int(11) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id_leosliderlayer_slides`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8";


$queryTables['leosliderlayer']['leosliderlayer_slides_lang']="CREATE TABLE IF NOT EXISTS  `"._DB_PREFIX_."leosliderlayer_slides_lang` (
  `id_leosliderlayer_slides` int(10) unsigned NOT NULL,
  `id_lang` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `video` text,
  `layersparams` text,
  PRIMARY KEY (`id_leosliderlayer_slides`,`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";


/*DATA FOR TABLE leosliderlayer_groups*/
 $querySQL['leosliderlayer_groups'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_groups( `id_leosliderlayer_groups`,`title`,`id_shop`,`hook`,`active`,`params` ) VALUES('1', 'Sample Group', '_SHOPID_', 'displaySlideshow', '1', 'eyJhdXRvX3BsYXkiOiIwIiwiZGVsYXkiOiI5MDAwIiwiZnVsbHdpZHRoIjoiZnVsbHdpZHRoIiwibWRfd2lkdGgiOiIxMiIsInNtX3dpZHRoIjoiMTIiLCJ4c193aWR0aCI6IjEyIiwidG91Y2hfbW9iaWxlIjoiMSIsInN0b3Bfb25faG92ZXIiOiIxIiwic2h1ZmZsZV9tb2RlIjoiMSIsInNoYWRvd190eXBlIjoiMCIsInNob3dfdGltZV9saW5lIjoiMSIsInRpbWVfbGluZV9wb3NpdGlvbiI6InRvcCIsIm1hcmdpbiI6IjBweCIsInBhZGRpbmciOiIwcHgiLCJiYWNrZ3JvdW5kX2NvbG9yIjoiI2ZmZiIsImJhY2tncm91bmRfaW1hZ2UiOiIwIiwiYmFja2dyb3VuZF91cmwiOiIiLCJncm91cF9jbGFzcyI6IiIsIm5hdmlnYXRvcl90eXBlIjoibm9uZSIsIm5hdmlnYXRvcl9hcnJvd3MiOiJ2ZXJ0aWNhbGNlbnRlcmVkIiwibmF2aWdhdGlvbl9zdHlsZSI6InJvdW5kIiwic2hvd19uYXZpZ2F0b3IiOiIwIiwiaGlkZV9uYXZpZ2F0b3JfYWZ0ZXIiOiIyMDAiLCJpbWFnZV9jcm9wcGluZyI6IjAiLCJ3aWR0aCI6IjEyNTAiLCJoZWlnaHQiOiI2NDAiLCJ0aHVtYm5haWxfd2lkdGgiOiIxMDAiLCJ0aHVtYm5haWxfaGVpZ2h0IjoiNTAiLCJ0aHVtYm5haWxfYW1vdW50IjoiNSJ9')"; 
 $querySQL['leosliderlayer_groups'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_groups( `id_leosliderlayer_groups`,`title`,`id_shop`,`hook`,`active`,`params` ) VALUES('2', 'Full slide', '_SHOPID_', 'displaySlideshow', '0', 'eyJhdXRvX3BsYXkiOiIxIiwiZGVsYXkiOiI5MDAwIiwiZnVsbHdpZHRoIjoiZnVsbHNjcmVlbiIsIm1kX3dpZHRoIjoiMTIiLCJzbV93aWR0aCI6IjEyIiwieHNfd2lkdGgiOiIxMiIsInRvdWNoX21vYmlsZSI6IjEiLCJzdG9wX29uX2hvdmVyIjoiMSIsInNodWZmbGVfbW9kZSI6IjEiLCJzaGFkb3dfdHlwZSI6IjAiLCJzaG93X3RpbWVfbGluZSI6IjEiLCJ0aW1lX2xpbmVfcG9zaXRpb24iOiJ0b3AiLCJtYXJnaW4iOiIwIDAgMCAwIiwicGFkZGluZyI6IjAiLCJiYWNrZ3JvdW5kX2NvbG9yIjoiI2ZmZiIsImJhY2tncm91bmRfaW1hZ2UiOiIwIiwiYmFja2dyb3VuZF91cmwiOiIiLCJncm91cF9jbGFzcyI6IiIsIm5hdmlnYXRvcl90eXBlIjoibm9uZSIsIm5hdmlnYXRvcl9hcnJvd3MiOiJ2ZXJ0aWNhbGNlbnRlcmVkIiwibmF2aWdhdGlvbl9zdHlsZSI6InJvdW5kIiwic2hvd19uYXZpZ2F0b3IiOiIwIiwiaGlkZV9uYXZpZ2F0b3JfYWZ0ZXIiOiIyMDAiLCJpbWFnZV9jcm9wcGluZyI6IjAiLCJ3aWR0aCI6IjE3MDAiLCJoZWlnaHQiOiIxMDgwIiwidGh1bWJuYWlsX3dpZHRoIjoiMTAwIiwidGh1bWJuYWlsX2hlaWdodCI6IjUwIiwidGh1bWJuYWlsX2Ftb3VudCI6IjUifQ==')"; 
/*DATA FOR TABLE leosliderlayer_slides*/
 $querySQL['leosliderlayer_slides'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides( `id_leosliderlayer_slides`,`id_group`,`position`,`active`,`parent_id`,`params` ) VALUES('1', '1', '0', '1', '0', 'eyJ0cmFuc2l0aW9uIjoicmFuZG9tIiwic2xvdCI6IjciLCJyb3RhdGlvbiI6IjAiLCJkdXJhdGlvbiI6IjMwMCIsImRlbGF5IjoiMCIsImVuYWJsZV9saW5rIjoiMSJ9')"; 
 $querySQL['leosliderlayer_slides'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides( `id_leosliderlayer_slides`,`id_group`,`position`,`active`,`parent_id`,`params` ) VALUES('3', '0', '0', '0', '0', 'ZmFsc2U=')"; 
 $querySQL['leosliderlayer_slides'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides( `id_leosliderlayer_slides`,`id_group`,`position`,`active`,`parent_id`,`params` ) VALUES('4', '0', '0', '0', '0', 'ZmFsc2U=')"; 
 $querySQL['leosliderlayer_slides'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides( `id_leosliderlayer_slides`,`id_group`,`position`,`active`,`parent_id`,`params` ) VALUES('5', '1', '0', '1', '0', 'eyJ0cmFuc2l0aW9uIjoicmFuZG9tIiwic2xvdCI6IjciLCJyb3RhdGlvbiI6IjAiLCJkdXJhdGlvbiI6IjMwMCIsImRlbGF5IjoiMCIsImVuYWJsZV9saW5rIjoiMSJ9')"; 
 $querySQL['leosliderlayer_slides'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides( `id_leosliderlayer_slides`,`id_group`,`position`,`active`,`parent_id`,`params` ) VALUES('6', '2', '0', '1', '0', 'eyJ0cmFuc2l0aW9uIjoicmFuZG9tIiwic2xvdCI6IjciLCJyb3RhdGlvbiI6IjAiLCJkdXJhdGlvbiI6IjMwMCIsImRlbGF5IjoiMCIsImVuYWJsZV9saW5rIjoiMSJ9')"; 
 $querySQL['leosliderlayer_slides'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides( `id_leosliderlayer_slides`,`id_group`,`position`,`active`,`parent_id`,`params` ) VALUES('7', '2', '0', '1', '0', 'eyJ0cmFuc2l0aW9uIjoicmFuZG9tIiwic2xvdCI6IjciLCJyb3RhdGlvbiI6IjAiLCJkdXJhdGlvbiI6IjMwMCIsImRlbGF5IjoiMCIsImVuYWJsZV9saW5rIjoiMSJ9')"; 
/*DATA FOR TABLE leosliderlayer_slides_lang*/
 $querySQL['leosliderlayer_slides_lang'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides_lang( `id_leosliderlayer_slides`,`id_lang`,`title`,`link`,`image`,`thumbnail`,`video`,`layersparams` ) VALUES('1', '_LANGUAGEID_', 'slider 1', 'http://prestashop.com', 'slider-layer-1.jpg', '', 'eyJ1c2V2aWRlbyI6IjAiLCJ2aWRlb2lkIjoiIiwidmlkZW9hdXRvIjoiMSIsImJhY2tncm91bmRfY29sb3IiOiIjZmZmZmZmIn0=', 'W3sibGF5ZXJfdmlkZW9fdHlwZSI6InlvdXR1YmUiLCJsYXllcl92aWRlb19pZCI6IiIsImxheWVyX3ZpZGVvX2hlaWdodCI6IjIwMCIsImxheWVyX3ZpZGVvX3dpZHRoIjoiMzAwIiwibGF5ZXJfdmlkZW9fdGh1bWIiOiIiLCJsYXllcl9pZCI6IjFfMSIsImxheWVyX2NvbnRlbnQiOiIiLCJsYXllcl90eXBlIjoidGV4dCIsImxheWVyX2NsYXNzIjoiYmlnX2JsYWNrIiwibGF5ZXJfY2FwdGlvbiI6Ik1vZGVybiIsImxheWVyX2ZvbnRfc2l6ZSI6IiIsImxheWVyX2JhY2tncm91bmRfY29sb3IiOiIiLCJsYXllcl9jb2xvciI6IiIsImxheWVyX2xpbmsiOiIiLCJsYXllcl9hbmltYXRpb24iOiJyYW5kb21yb3RhdGUiLCJsYXllcl9lYXNpbmciOiJlYXNlT3V0RXhwbyIsImxheWVyX3NwZWVkIjoiMzUwIiwibGF5ZXJfdG9wIjoiMTM3IiwibGF5ZXJfbGVmdCI6IjUwIiwibGF5ZXJfZW5kdGltZSI6IjAiLCJsYXllcl9lbmRzcGVlZCI6IjMwMCIsImxheWVyX2VuZGFuaW1hdGlvbiI6ImF1dG8iLCJsYXllcl9lbmRlYXNpbmciOiJub3RoaW5nIiwidGltZV9zdGFydCI6Ijc4OCJ9LHsibGF5ZXJfdmlkZW9fdHlwZSI6InlvdXR1YmUiLCJsYXllcl92aWRlb19pZCI6IiIsImxheWVyX3ZpZGVvX2hlaWdodCI6IjIwMCIsImxheWVyX3ZpZGVvX3dpZHRoIjoiMzAwIiwibGF5ZXJfdmlkZW9fdGh1bWIiOiIiLCJsYXllcl9pZCI6IjFfMiIsImxheWVyX2NvbnRlbnQiOiIiLCJsYXllcl90eXBlIjoidGV4dCIsImxheWVyX2NsYXNzIjoiYmlnX2JsYWNrIiwibGF5ZXJfY2FwdGlvbiI6Ik9mZmljZSBBdHRpcmUiLCJsYXllcl9mb250X3NpemUiOiIiLCJsYXllcl9iYWNrZ3JvdW5kX2NvbG9yIjoiIiwibGF5ZXJfY29sb3IiOiIiLCJsYXllcl9saW5rIjoiIiwibGF5ZXJfYW5pbWF0aW9uIjoicmFuZG9tcm90YXRlIiwibGF5ZXJfZWFzaW5nIjoiZWFzZU91dEV4cG8iLCJsYXllcl9zcGVlZCI6IjM1MCIsImxheWVyX3RvcCI6IjI0NSIsImxheWVyX2xlZnQiOiI1MCIsImxheWVyX2VuZHRpbWUiOiIwIiwibGF5ZXJfZW5kc3BlZWQiOiIzMDAiLCJsYXllcl9lbmRhbmltYXRpb24iOiJhdXRvIiwibGF5ZXJfZW5kZWFzaW5nIjoibm90aGluZyIsInRpbWVfc3RhcnQiOiIxNDk4In0seyJsYXllcl92aWRlb190eXBlIjoieW91dHViZSIsImxheWVyX3ZpZGVvX2lkIjoiIiwibGF5ZXJfdmlkZW9faGVpZ2h0IjoiMjAwIiwibGF5ZXJfdmlkZW9fd2lkdGgiOiIzMDAiLCJsYXllcl92aWRlb190aHVtYiI6IiIsImxheWVyX2lkIjoiMV8zIiwibGF5ZXJfY29udGVudCI6IiIsImxheWVyX3R5cGUiOiJ0ZXh0IiwibGF5ZXJfY2xhc3MiOiJtZWRpdW1fYmxhY2siLCJsYXllcl9jYXB0aW9uIjoiRHJlc3NpbmcgRm9yIFRoZSBPY2Nhc2lvbiIsImxheWVyX2ZvbnRfc2l6ZSI6IiIsImxheWVyX2JhY2tncm91bmRfY29sb3IiOiIiLCJsYXllcl9jb2xvciI6IiIsImxheWVyX2xpbmsiOiIiLCJsYXllcl9hbmltYXRpb24iOiJyYW5kb21yb3RhdGUiLCJsYXllcl9lYXNpbmciOiJlYXNlT3V0RXhwbyIsImxheWVyX3NwZWVkIjoiMzUwIiwibGF5ZXJfdG9wIjoiMzcwIiwibGF5ZXJfbGVmdCI6IjUwIiwibGF5ZXJfZW5kdGltZSI6IjAiLCJsYXllcl9lbmRzcGVlZCI6IjMwMCIsImxheWVyX2VuZGFuaW1hdGlvbiI6ImF1dG8iLCJsYXllcl9lbmRlYXNpbmciOiJub3RoaW5nIiwidGltZV9zdGFydCI6IjIzMzYifSx7ImxheWVyX3ZpZGVvX3R5cGUiOiJ5b3V0dWJlIiwibGF5ZXJfdmlkZW9faWQiOiIiLCJsYXllcl92aWRlb19oZWlnaHQiOiIyMDAiLCJsYXllcl92aWRlb193aWR0aCI6IjMwMCIsImxheWVyX3ZpZGVvX3RodW1iIjoiIiwibGF5ZXJfaWQiOiIxXzQiLCJsYXllcl9jb250ZW50IjoiIiwibGF5ZXJfdHlwZSI6InRleHQiLCJsYXllcl9jbGFzcyI6ImJ0biBidG4tb3V0bGluZS1ibGFjayIsImxheWVyX2NhcHRpb24iOiJ2aWV3IGNvbGxlY3Rpb24iLCJsYXllcl9mb250X3NpemUiOiIiLCJsYXllcl9iYWNrZ3JvdW5kX2NvbG9yIjoiIiwibGF5ZXJfY29sb3IiOiIiLCJsYXllcl9saW5rIjoiIiwibGF5ZXJfYW5pbWF0aW9uIjoicmFuZG9tcm90YXRlIiwibGF5ZXJfZWFzaW5nIjoiZWFzZU91dEV4cG8iLCJsYXllcl9zcGVlZCI6IjM1MCIsImxheWVyX3RvcCI6IjQyNSIsImxheWVyX2xlZnQiOiI1MCIsImxheWVyX2VuZHRpbWUiOiIwIiwibGF5ZXJfZW5kc3BlZWQiOiIzMDAiLCJsYXllcl9lbmRhbmltYXRpb24iOiJhdXRvIiwibGF5ZXJfZW5kZWFzaW5nIjoibm90aGluZyIsInRpbWVfc3RhcnQiOiIzMDQ4In1d')"; 
 $querySQL['leosliderlayer_slides_lang'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides_lang( `id_leosliderlayer_slides`,`id_lang`,`title`,`link`,`image`,`thumbnail`,`video`,`layersparams` ) VALUES('3', '_LANGUAGEID_', '', '', '', '', 'eyJ1c2V2aWRlbyI6ZmFsc2UsInZpZGVvaWQiOmZhbHNlLCJ2aWRlb2F1dG8iOmZhbHNlLCJiYWNrZ3JvdW5kX2NvbG9yIjoiIn0=', '')"; 
 $querySQL['leosliderlayer_slides_lang'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides_lang( `id_leosliderlayer_slides`,`id_lang`,`title`,`link`,`image`,`thumbnail`,`video`,`layersparams` ) VALUES('4', '_LANGUAGEID_', '', '', '', '', 'eyJ1c2V2aWRlbyI6ZmFsc2UsInZpZGVvaWQiOmZhbHNlLCJ2aWRlb2F1dG8iOmZhbHNlLCJiYWNrZ3JvdW5kX2NvbG9yIjoiIn0=', '')"; 
 $querySQL['leosliderlayer_slides_lang'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides_lang( `id_leosliderlayer_slides`,`id_lang`,`title`,`link`,`image`,`thumbnail`,`video`,`layersparams` ) VALUES('5', '_LANGUAGEID_', 'Slider 2', 'http://prestashop.com', 'slider-layer-2.jpg', '', 'eyJ1c2V2aWRlbyI6IjAiLCJ2aWRlb2lkIjoiIiwidmlkZW9hdXRvIjoiMSIsImJhY2tncm91bmRfY29sb3IiOiIjZmZmZmZmIn0=', 'W3sibGF5ZXJfdmlkZW9fdHlwZSI6InlvdXR1YmUiLCJsYXllcl92aWRlb19pZCI6IiIsImxheWVyX3ZpZGVvX2hlaWdodCI6IjIwMCIsImxheWVyX3ZpZGVvX3dpZHRoIjoiMzAwIiwibGF5ZXJfdmlkZW9fdGh1bWIiOiIiLCJsYXllcl9pZCI6IjFfMSIsImxheWVyX2NvbnRlbnQiOiJsYXllcjEucG5nIiwibGF5ZXJfdHlwZSI6ImltYWdlIiwibGF5ZXJfY2xhc3MiOiIiLCJsYXllcl9jYXB0aW9uIjoiWW91ciBJbWFnZSBIZXJlIDEiLCJsYXllcl9mb250X3NpemUiOiIiLCJsYXllcl9iYWNrZ3JvdW5kX2NvbG9yIjoiIiwibGF5ZXJfY29sb3IiOiIiLCJsYXllcl9saW5rIjoiIiwibGF5ZXJfYW5pbWF0aW9uIjoibGZyIiwibGF5ZXJfZWFzaW5nIjoiZWFzZU91dEV4cG8iLCJsYXllcl9zcGVlZCI6IjM1MCIsImxheWVyX3RvcCI6IjAiLCJsYXllcl9sZWZ0IjoiNTUzIiwibGF5ZXJfZW5kdGltZSI6IjAiLCJsYXllcl9lbmRzcGVlZCI6IjMwMCIsImxheWVyX2VuZGFuaW1hdGlvbiI6ImF1dG8iLCJsYXllcl9lbmRlYXNpbmciOiJub3RoaW5nIiwidGltZV9zdGFydCI6IjEwMTIifSx7ImxheWVyX3ZpZGVvX3R5cGUiOiJ5b3V0dWJlIiwibGF5ZXJfdmlkZW9faWQiOiIiLCJsYXllcl92aWRlb19oZWlnaHQiOiIyMDAiLCJsYXllcl92aWRlb193aWR0aCI6IjMwMCIsImxheWVyX3ZpZGVvX3RodW1iIjoiIiwibGF5ZXJfaWQiOiIxXzIiLCJsYXllcl9jb250ZW50IjoibGF5ZXIyLnBuZyIsImxheWVyX3R5cGUiOiJ0ZXh0IiwibGF5ZXJfY2xhc3MiOiJiaWdfYmxhY2siLCJsYXllcl9jYXB0aW9uIjoiYmFjayB0byIsImxheWVyX2ZvbnRfc2l6ZSI6IiIsImxheWVyX2JhY2tncm91bmRfY29sb3IiOiIiLCJsYXllcl9jb2xvciI6IiIsImxheWVyX2xpbmsiOiIiLCJsYXllcl9hbmltYXRpb24iOiJzZnQiLCJsYXllcl9lYXNpbmciOiJlYXNlT3V0RXhwbyIsImxheWVyX3NwZWVkIjoiMzUwIiwibGF5ZXJfdG9wIjoiMTM3IiwibGF5ZXJfbGVmdCI6IjY3NSIsImxheWVyX2VuZHRpbWUiOiIwIiwibGF5ZXJfZW5kc3BlZWQiOiIzMDAiLCJsYXllcl9lbmRhbmltYXRpb24iOiJhdXRvIiwibGF5ZXJfZW5kZWFzaW5nIjoibm90aGluZyIsInRpbWVfc3RhcnQiOiIxOTg1In0seyJsYXllcl92aWRlb190eXBlIjoieW91dHViZSIsImxheWVyX3ZpZGVvX2lkIjoiIiwibGF5ZXJfdmlkZW9faGVpZ2h0IjoiMjAwIiwibGF5ZXJfdmlkZW9fd2lkdGgiOiIzMDAiLCJsYXllcl92aWRlb190aHVtYiI6IiIsImxheWVyX2lkIjoiMV8zIiwibGF5ZXJfY29udGVudCI6ImxheWVyMi5wbmciLCJsYXllcl90eXBlIjoidGV4dCIsImxheWVyX2NsYXNzIjoiYmlnX2JsYWNrIiwibGF5ZXJfY2FwdGlvbiI6ImJ1c2luZXNzIiwibGF5ZXJfZm9udF9zaXplIjoiIiwibGF5ZXJfYmFja2dyb3VuZF9jb2xvciI6IiIsImxheWVyX2NvbG9yIjoiIiwibGF5ZXJfbGluayI6IiIsImxheWVyX2FuaW1hdGlvbiI6InNmdCIsImxheWVyX2Vhc2luZyI6ImVhc2VPdXRFeHBvIiwibGF5ZXJfc3BlZWQiOiIzNTAiLCJsYXllcl90b3AiOiIyNDUiLCJsYXllcl9sZWZ0IjoiNjc1IiwibGF5ZXJfZW5kdGltZSI6IjAiLCJsYXllcl9lbmRzcGVlZCI6IjMwMCIsImxheWVyX2VuZGFuaW1hdGlvbiI6ImF1dG8iLCJsYXllcl9lbmRlYXNpbmciOiJub3RoaW5nIiwidGltZV9zdGFydCI6IjI5NTIifSx7ImxheWVyX3ZpZGVvX3R5cGUiOiJ5b3V0dWJlIiwibGF5ZXJfdmlkZW9faWQiOiIiLCJsYXllcl92aWRlb19oZWlnaHQiOiIyMDAiLCJsYXllcl92aWRlb193aWR0aCI6IjMwMCIsImxheWVyX3ZpZGVvX3RodW1iIjoiIiwibGF5ZXJfaWQiOiIxXzQiLCJsYXllcl9jb250ZW50IjoibGF5ZXIyLnBuZyIsImxheWVyX3R5cGUiOiJ0ZXh0IiwibGF5ZXJfY2xhc3MiOiJtZWRpdW1fYmxhY2siLCJsYXllcl9jYXB0aW9uIjoiVGhlIHNoYXJwZXN0IHdvcmt3ZWVrIGxvb2tzIiwibGF5ZXJfZm9udF9zaXplIjoiIiwibGF5ZXJfYmFja2dyb3VuZF9jb2xvciI6IiIsImxheWVyX2NvbG9yIjoiIiwibGF5ZXJfbGluayI6IiIsImxheWVyX2FuaW1hdGlvbiI6InNmdCIsImxheWVyX2Vhc2luZyI6ImVhc2VPdXRFeHBvIiwibGF5ZXJfc3BlZWQiOiIzNTAiLCJsYXllcl90b3AiOiIzNzAiLCJsYXllcl9sZWZ0IjoiNjc1IiwibGF5ZXJfZW5kdGltZSI6IjAiLCJsYXllcl9lbmRzcGVlZCI6IjMwMCIsImxheWVyX2VuZGFuaW1hdGlvbiI6ImF1dG8iLCJsYXllcl9lbmRlYXNpbmciOiJub3RoaW5nIiwidGltZV9zdGFydCI6IjM3NDgifSx7ImxheWVyX3ZpZGVvX3R5cGUiOiJ5b3V0dWJlIiwibGF5ZXJfdmlkZW9faWQiOiIiLCJsYXllcl92aWRlb19oZWlnaHQiOiIyMDAiLCJsYXllcl92aWRlb193aWR0aCI6IjMwMCIsImxheWVyX3ZpZGVvX3RodW1iIjoiIiwibGF5ZXJfaWQiOiIxXzUiLCJsYXllcl9jb250ZW50IjoibGF5ZXIyLnBuZyIsImxheWVyX3R5cGUiOiJ0ZXh0IiwibGF5ZXJfY2xhc3MiOiJidG4gYnRuLW91dGxpbmUtYmxhY2siLCJsYXllcl9jYXB0aW9uIjoidmlldyBjb2xsZWN0aW9uIiwibGF5ZXJfZm9udF9zaXplIjoiIiwibGF5ZXJfYmFja2dyb3VuZF9jb2xvciI6IiIsImxheWVyX2NvbG9yIjoiIiwibGF5ZXJfbGluayI6IiIsImxheWVyX2FuaW1hdGlvbiI6InNmdCIsImxheWVyX2Vhc2luZyI6ImVhc2VPdXRFeHBvIiwibGF5ZXJfc3BlZWQiOiIzNTAiLCJsYXllcl90b3AiOiI0MjUiLCJsYXllcl9sZWZ0IjoiNjgwIiwibGF5ZXJfZW5kdGltZSI6IjAiLCJsYXllcl9lbmRzcGVlZCI6IjMwMCIsImxheWVyX2VuZGFuaW1hdGlvbiI6ImF1dG8iLCJsYXllcl9lbmRlYXNpbmciOiJub3RoaW5nIiwidGltZV9zdGFydCI6IjQ0MTYifV0=')"; 
 $querySQL['leosliderlayer_slides_lang'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides_lang( `id_leosliderlayer_slides`,`id_lang`,`title`,`link`,`image`,`thumbnail`,`video`,`layersparams` ) VALUES('6', '_LANGUAGEID_', 'slider 1', 'http://prestashop.com', 'silder-full-screen-1.jpg', '', 'eyJ1c2V2aWRlbyI6IjAiLCJ2aWRlb2lkIjoiIiwidmlkZW9hdXRvIjoiMSIsImJhY2tncm91bmRfY29sb3IiOiIifQ==', 'W3sibGF5ZXJfdmlkZW9fdHlwZSI6InlvdXR1YmUiLCJsYXllcl92aWRlb19pZCI6IiIsImxheWVyX3ZpZGVvX2hlaWdodCI6IjIwMCIsImxheWVyX3ZpZGVvX3dpZHRoIjoiMzAwIiwibGF5ZXJfdmlkZW9fdGh1bWIiOiIiLCJsYXllcl9pZCI6IjFfMSIsImxheWVyX2NvbnRlbnQiOiIiLCJsYXllcl90eXBlIjoidGV4dCIsImxheWVyX2NsYXNzIjoiYmlnX3doaXRlIHR4dC1jZW50ZXIiLCJsYXllcl9jYXB0aW9uIjoiY29tcGxldGUgeW91ciBzdHlsZSIsImxheWVyX2ZvbnRfc2l6ZSI6IiIsImxheWVyX2JhY2tncm91bmRfY29sb3IiOiIiLCJsYXllcl9jb2xvciI6IiIsImxheWVyX2xpbmsiOiIiLCJsYXllcl9hbmltYXRpb24iOiJmYWRlIiwibGF5ZXJfZWFzaW5nIjoiZWFzZU91dEV4cG8iLCJsYXllcl9zcGVlZCI6IjM1MCIsImxheWVyX3RvcCI6IjQwOCIsImxheWVyX2xlZnQiOiIwIiwibGF5ZXJfZW5kdGltZSI6IjAiLCJsYXllcl9lbmRzcGVlZCI6IjMwMCIsImxheWVyX2VuZGFuaW1hdGlvbiI6ImF1dG8iLCJsYXllcl9lbmRlYXNpbmciOiJub3RoaW5nIiwidGltZV9zdGFydCI6IjgwMCJ9LHsibGF5ZXJfdmlkZW9fdHlwZSI6InlvdXR1YmUiLCJsYXllcl92aWRlb19pZCI6IiIsImxheWVyX3ZpZGVvX2hlaWdodCI6IjIwMCIsImxheWVyX3ZpZGVvX3dpZHRoIjoiMzAwIiwibGF5ZXJfdmlkZW9fdGh1bWIiOiIiLCJsYXllcl9pZCI6IjFfMiIsImxheWVyX2NvbnRlbnQiOiIiLCJsYXllcl90eXBlIjoidGV4dCIsImxheWVyX2NsYXNzIjoibWVkaXVtX3doaXRlIHR4dC1jZW50ZXIiLCJsYXllcl9jYXB0aW9uIjoiQXJlIFlvdSBBIE1hbiBXaG8gS25vdyBIb3cgVG8gQWNjZXNzb3JpemU/IiwibGF5ZXJfZm9udF9zaXplIjoiIiwibGF5ZXJfYmFja2dyb3VuZF9jb2xvciI6IiIsImxheWVyX2NvbG9yIjoiIiwibGF5ZXJfbGluayI6IiIsImxheWVyX2FuaW1hdGlvbiI6ImZhZGUiLCJsYXllcl9lYXNpbmciOiJlYXNlT3V0RXhwbyIsImxheWVyX3NwZWVkIjoiMzUwIiwibGF5ZXJfdG9wIjoiNTUxIiwibGF5ZXJfbGVmdCI6IjAiLCJsYXllcl9lbmR0aW1lIjoiMCIsImxheWVyX2VuZHNwZWVkIjoiMzAwIiwibGF5ZXJfZW5kYW5pbWF0aW9uIjoiYXV0byIsImxheWVyX2VuZGVhc2luZyI6Im5vdGhpbmciLCJ0aW1lX3N0YXJ0IjoiMTgxMiJ9LHsibGF5ZXJfdmlkZW9fdHlwZSI6InlvdXR1YmUiLCJsYXllcl92aWRlb19pZCI6IiIsImxheWVyX3ZpZGVvX2hlaWdodCI6IjIwMCIsImxheWVyX3ZpZGVvX3dpZHRoIjoiMzAwIiwibGF5ZXJfdmlkZW9fdGh1bWIiOiIiLCJsYXllcl9pZCI6IjFfMyIsImxheWVyX2NvbnRlbnQiOiIiLCJsYXllcl90eXBlIjoidGV4dCIsImxheWVyX2NsYXNzIjoiYnRuIGJ0bi1vdXRsaW5lLXdoaXRlICIsImxheWVyX2NhcHRpb24iOiJ2aWV3IGNvbGxlY3Rpb24iLCJsYXllcl9mb250X3NpemUiOiIiLCJsYXllcl9iYWNrZ3JvdW5kX2NvbG9yIjoiIiwibGF5ZXJfY29sb3IiOiIiLCJsYXllcl9saW5rIjoiIiwibGF5ZXJfYW5pbWF0aW9uIjoiZmFkZSIsImxheWVyX2Vhc2luZyI6ImVhc2VPdXRFeHBvIiwibGF5ZXJfc3BlZWQiOiIzNTAiLCJsYXllcl90b3AiOiI2MzAiLCJsYXllcl9sZWZ0IjoiODAwIiwibGF5ZXJfZW5kdGltZSI6IjAiLCJsYXllcl9lbmRzcGVlZCI6IjMwMCIsImxheWVyX2VuZGFuaW1hdGlvbiI6ImF1dG8iLCJsYXllcl9lbmRlYXNpbmciOiJub3RoaW5nIiwidGltZV9zdGFydCI6IjI0NDYifV0=')"; 
 $querySQL['leosliderlayer_slides_lang'][]="INSERT INTO "._DB_PREFIX_."leosliderlayer_slides_lang( `id_leosliderlayer_slides`,`id_lang`,`title`,`link`,`image`,`thumbnail`,`video`,`layersparams` ) VALUES('7', '_LANGUAGEID_', 'slider 2', '', 'silder-full-screen.jpg', '', 'eyJ1c2V2aWRlbyI6IjAiLCJ2aWRlb2lkIjoiIiwidmlkZW9hdXRvIjoiMCIsImJhY2tncm91bmRfY29sb3IiOiIifQ==', 'W3sibGF5ZXJfdmlkZW9fdHlwZSI6InlvdXR1YmUiLCJsYXllcl92aWRlb19pZCI6IiIsImxheWVyX3ZpZGVvX2hlaWdodCI6IjIwMCIsImxheWVyX3ZpZGVvX3dpZHRoIjoiMzAwIiwibGF5ZXJfdmlkZW9fdGh1bWIiOiIiLCJsYXllcl9pZCI6IjFfMSIsImxheWVyX2NvbnRlbnQiOiIiLCJsYXllcl90eXBlIjoidGV4dCIsImxheWVyX2NsYXNzIjoiYmlnX3doaXRlIHR4dC1jZW50ZXIiLCJsYXllcl9jYXB0aW9uIjoiQSBHdWlkZSBUbyBNZW5zIG91dHdlYXJzIiwibGF5ZXJfZm9udF9zaXplIjoiIiwibGF5ZXJfYmFja2dyb3VuZF9jb2xvciI6IiIsImxheWVyX2NvbG9yIjoiIiwibGF5ZXJfbGluayI6IiIsImxheWVyX2FuaW1hdGlvbiI6ImZhZGUiLCJsYXllcl9lYXNpbmciOiJlYXNlT3V0RXhwbyIsImxheWVyX3NwZWVkIjoiMzUwIiwibGF5ZXJfdG9wIjoiNDA4IiwibGF5ZXJfbGVmdCI6IjAiLCJsYXllcl9lbmR0aW1lIjoiMCIsImxheWVyX2VuZHNwZWVkIjoiMzAwIiwibGF5ZXJfZW5kYW5pbWF0aW9uIjoiYXV0byIsImxheWVyX2VuZGVhc2luZyI6Im5vdGhpbmciLCJ0aW1lX3N0YXJ0IjoiODUzIn0seyJsYXllcl92aWRlb190eXBlIjoieW91dHViZSIsImxheWVyX3ZpZGVvX2lkIjoiIiwibGF5ZXJfdmlkZW9faGVpZ2h0IjoiMjAwIiwibGF5ZXJfdmlkZW9fd2lkdGgiOiIzMDAiLCJsYXllcl92aWRlb190aHVtYiI6IiIsImxheWVyX2lkIjoiMV8yIiwibGF5ZXJfY29udGVudCI6IiIsImxheWVyX3R5cGUiOiJ0ZXh0IiwibGF5ZXJfY2xhc3MiOiJtZWRpdW1fd2hpdGUgdHh0LWNlbnRlciIsImxheWVyX2NhcHRpb24iOiJBcmUgWW91IEEgTWFuIFdobyBLbm93IEhvdyBUbyBBY2Nlc3Nvcml6ZT8iLCJsYXllcl9mb250X3NpemUiOiIiLCJsYXllcl9iYWNrZ3JvdW5kX2NvbG9yIjoiIiwibGF5ZXJfY29sb3IiOiIiLCJsYXllcl9saW5rIjoiIiwibGF5ZXJfYW5pbWF0aW9uIjoiZmFkZSIsImxheWVyX2Vhc2luZyI6ImVhc2VPdXRFeHBvIiwibGF5ZXJfc3BlZWQiOiIzNTAiLCJsYXllcl90b3AiOiI1NTEiLCJsYXllcl9sZWZ0IjoiMCIsImxheWVyX2VuZHRpbWUiOiIwIiwibGF5ZXJfZW5kc3BlZWQiOiIzMDAiLCJsYXllcl9lbmRhbmltYXRpb24iOiJhdXRvIiwibGF5ZXJfZW5kZWFzaW5nIjoibm90aGluZyIsInRpbWVfc3RhcnQiOiIxOTY3In0seyJsYXllcl92aWRlb190eXBlIjoieW91dHViZSIsImxheWVyX3ZpZGVvX2lkIjoiIiwibGF5ZXJfdmlkZW9faGVpZ2h0IjoiMjAwIiwibGF5ZXJfdmlkZW9fd2lkdGgiOiIzMDAiLCJsYXllcl92aWRlb190aHVtYiI6IiIsImxheWVyX2lkIjoiMV8zIiwibGF5ZXJfY29udGVudCI6IiIsImxheWVyX3R5cGUiOiJ0ZXh0IiwibGF5ZXJfY2xhc3MiOiJidG4gYnRuLW91dGxpbmUtd2hpdGUiLCJsYXllcl9jYXB0aW9uIjoidmlldyBjb2xsZWN0aW9uIiwibGF5ZXJfZm9udF9zaXplIjoiIiwibGF5ZXJfYmFja2dyb3VuZF9jb2xvciI6IiIsImxheWVyX2NvbG9yIjoiIiwibGF5ZXJfbGluayI6IiIsImxheWVyX2FuaW1hdGlvbiI6ImZhZGUiLCJsYXllcl9lYXNpbmciOiJlYXNlT3V0RXhwbyIsImxheWVyX3NwZWVkIjoiMzUwIiwibGF5ZXJfdG9wIjoiNjMwIiwibGF5ZXJfbGVmdCI6IjgwMCIsImxheWVyX2VuZHRpbWUiOiIwIiwibGF5ZXJfZW5kc3BlZWQiOiIzMDAiLCJsYXllcl9lbmRhbmltYXRpb24iOiJhdXRvIiwibGF5ZXJfZW5kZWFzaW5nIjoibm90aGluZyIsInRpbWVfc3RhcnQiOiIyOTYwIn1d')"; 

?>