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
	
	class LeoBlogConfig {

		/**
		 *
		 */
		public $params; 

		/**
		 *
		 */
		protected $catImageDir = '';
		
		/**
		 *
		 */
		public static function getInstance(){
			static $_instance ;
			if( !$_instance ){
				$_instance = new LeoBlogConfig();
			}
			return $_instance;
		}

		/**
		 *
		 */
		public function __construct(){
			$data = self::getConfigValue( 'cfg_global' );	
			 
			if( $data && $tmp=unserialize($data) ){
				 $this->params = $tmp;
			}

		}

		/**
		 *
		 */
		public function mergeParams( $params ){

		}

		/**
		 *
		 */
		public function setVar( $key, $value ){
			$this->params[$key] = $value;
		}

		/**
		 *
		 */
		public function get( $name, $value='' ){
			if( isset($this->params[$name]) ){
				return $this->params[$name];
			}
			return $value;
		}

 
		/**
		 *
		 */
		public static function getConfigName( $name ){
			return strtoupper( _LEO_BLOG_PREFIX_.$name );
		}

		/**
		 *
		 */
		public static function updateConfigValue( $name, $value='' ){
			Configuration::updateValue( self::getConfigName($name), $value , true);
		}

		/**
		 *
		 */
		public static function getConfigValue( $name ){
			return Configuration::get( self::getConfigName($name) );
		}
		
	}	
?>