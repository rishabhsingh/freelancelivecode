<?php
	class PtsStaticContentSampe{

		/**
		 * Trigger on install module
		 */
		public static function onInstall( $module ){
			$result = true;
			$result &= (
		        Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'ptsstaticcontent`') &&
		        Db::getInstance()->Execute('
		        CREATE TABLE `'._DB_PREFIX_.'ptsstaticcontent` (
		                `id_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
		                `id_shop` int(10) unsigned NOT NULL,
		                `id_lang` int(10) unsigned NOT NULL,
		                `item_order` int(10) unsigned NOT NULL,
		                `title` VARCHAR(100),
		                `title_use` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		                `hook` VARCHAR(100),
		                `url` VARCHAR(100),
		                `target` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		                `image` VARCHAR(100),
		                `image_w` VARCHAR(10),
		                `image_h` VARCHAR(10),
		                `html` TEXT,
		                `active` tinyint(1) unsigned NOT NULL DEFAULT \'1\',
		                `col_lg` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		                `col_sm` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
		                `class` VARCHAR(50),
		                PRIMARY KEY (`id_item`)
		        ) ENGINE = '._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;')
		    );
			$result &= self::installFixtures();
		 	
		 	self::checkOwnerHooks();

		    return $result;
		}
		
		private static function checkOwnerHooks()
		{	
			$hookspos = array(
	            'displayTop',
	            'displayHeaderRight',
	            'displaySlideshow',
	            'topNavigation',
	            'displayPromoteTop',
	            'displayRightColumn',
	            'displayLeftColumn',
	            'displayHome',
	            'displayFooter',
	            'displayBottom',
	            'displayContentBottom',
	            'displayFootNav',
	            'displayFooterTop',
	            'displayFooterBottom'

	        );
			
			foreach( $hookspos as $hook ){
				if( Hook::getIdByName($hook) ){
					
				} else {
					$new_hook = new Hook();
					$new_hook->name = pSQL($hook);
					$new_hook->title = pSQL($hook);
					$new_hook->add();
					$id_hook = $new_hook->id;
				}
			}

			return true;
		}


		/**
		 * install default sample data
		 */
		public static function installFixtures()
    	{


	        $result = true;
	     /*   $spans = array(
	        	'1'=> 4,
	        	'2'=>4,
	        	'3'=> 4,
	        	'4' => 4,
	        	'5' => 8
	        );
	        for ($i = 1; $i < 6; $i++)
	        {
	        	$span = isset($spans[$i])?$spans[$i]:"0";
	            $result &= Db::getInstance()->Execute('
	                INSERT INTO `'._DB_PREFIX_.'ptsstaticcontent` ( 
	                        `id_shop`, `id_lang`, `item_order`, `title`, `title_use`, `hook`, `url`, `target`, `image`, `image_w`, `image_h`, `html`, `active`,
	               `col_lg`,`col_sm` ) VALUES ( 
	                    \''.(int)Context::getContext()->shop->id .'\',
	                    \''.(int)Context::getContext()->language->id.'\',
	                    \''.(int)$i.'\',
	                    \'\',
	                    \'0\',
	                    \'home\',
	                    \'\',
	                    \'\',
	                    \'banner-img'.$i.'.jpg\',
	                    \'\',
	                    \'\',
	                    \'\',
	                    1, '.$span.',12)
	                ');
	        }*/

       		return $result;
   		}
   		
		public static function onUninstall(){

		}

		public static function onCreateDataSample( $theme ){

		}
	}
?>