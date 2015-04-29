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
 

class LeoBlogHelper {
	
	/**
	 *
	 */
	public $bloglink = null;
	
	/**
	 *
	 */
	public $ssl;

	/**
	 *
	 */
	public static function getInstance(){  
		static $_instance = null;
		if( !$_instance ){
			$_instance = new LeoBlogHelper();
		}

		return $_instance;
	}

	/**
	 *
	 */
	public function __construct(){

		if (Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE'))
			$this->ssl = true;

		if (isset($useSSL))
			$this->ssl = $useSSL;

		$protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';
		$useSSL = ((isset($this->ssl) && $this->ssl && Configuration::get('PS_SSL_ENABLED')) || Tools::usingSecureMode()) ? true : false;
		$protocol_content = ($useSSL) ? 'https://' : 'http://';
		$this->bloglink = new LeoBlogLink($protocol_link, $protocol_content);

	}	

	 
	/**
	 *
	 */
	public static function buildBlogRoutes(){
		$routes = array();

        $routes['module-leoblog-list'] = array(
            'controller' => 'list',
            'rule' => _LEO_BLOG_REWRITE_ROUTE_.'.html',
            'keywords' => array(
            ),
            'params' => array(
                'fc' => 'module',
                'module' => 'leoblog'
            )
        );
        
        $routes['module-leoblog-blog'] = array(
            'controller' => 'blog',
            'rule' => _LEO_BLOG_REWRITE_ROUTE_.'/{rewrite}-b{id}.html',
            'keywords' => array(
                'id' => array('regexp' => '[0-9]+', 'param' => 'id'),
                'rewrite' => array('regexp' => '[_a-zA-Z0-9-\pL]*'),
            ),
            'params' => array(
                'fc' => 'module',
                'module' => 'leoblog',
            )
        );  

        $routes['module-leoblog-category'] = array(
            'controller' => 'category',
            'rule' => _LEO_BLOG_REWRITE_ROUTE_.'/{rewrite}-c{id}.html',
            'keywords' => array(
                'id' => array('regexp' => '[0-9]+', 'param' => 'id'),
                'rewrite' => array('regexp' => '[_a-zA-Z0-9-\pL]*'),
            ),
            'params' => array(
                'fc' => 'module',
                'module' => 'leoblog',
            )
        );
		return $routes;
	}

	public static function loadMedia( $context, $_this ){  
		$context->controller->addCss( $_this->module->getPathUri().'assets/leoblog.css' );
		$context->controller->addJs( $_this->module->getPathUri().'assets/leoblog.js' );
	}
	/**
	 *
	 */
	public function getLinkObject(){
		return $this->bloglink;	
	}

	public function getModuleLink( $route_id, $controller, array $params = array(), $ssl = null, $id_lang = null, $id_shop = null){
		return $this->getLinkObject()->getLink( $route_id, $controller, $params , $ssl, $id_lang, $id_shop );
	}

	/**
	 *
	 */
	public function getFontBlogLink( ){
		return $this->getModuleLink( 'module-leoblog-list' ,'list', array() );
	}

	public function getPaginationLink(  $route_id, $controller, array $params = array(), $nb = false, $sort = false, $pagination = false, $array = true  ){
		return $this->getLinkObject()->getLeoPaginationLink( 'leoblog', $route_id, $controller, $params, $nb , $sort , $pagination , $array  );
	}
	
	/**
	 *
	 */
	public function getBlogLink( $blog, $params1=array() ){ 

		$params = array(
			'id'	  => $blog['id_leoblog_blog'],
			'rewrite' => $blog['link_rewrite'],
		);

		$params = array_merge( $params, $params1 );
		
		return $this->getModuleLink( 'module-leoblog-blog', 'blog', $params );
	}

	/**
	 *
	 */
	public function getTagLink( $tag ){ 

		$params = array(
			'tag'	  => $tag,
		);
	 
		return $this->getModuleLink( 'blog_user_filter_rule', 'blog', $params );
	}

	/**
	 *
	 */
	public function getBlogCatLink( $cparams ){ 
		
		$params = array(
			'id'	  =>  '',
			'rewrite' => ''
		);
		$params = array_merge($params, $cparams );
		return $this->getModuleLink( 'module-leoblog-category', 'category', $params );
	}

	/**
	 *
	 */
	public function getBlogTagLink( $tag, $cparams=array() ){ 
		$params = array(
			'tag'	  =>  urlencode($tag),
		);	
		$params = array_merge( $params, $cparams );
		return $this->getModuleLink( 'module-leoblog-list', 'list', $params );
	}	

	/**
	 *
	 */
	public function getBlogAuthorLink( $author, $cparams=array() ){ 
		$params = array(
			'author'	  =>  $author,
		);	
		$params = array_merge( $params, $cparams );
		return $this->getModuleLink( 'module-leoblog-list', 'list', $params );
	}

	public static function getTemplates(){
		$theme =  Context::getContext()->shop->getTheme();
		$path  = _PS_MODULE_DIR_ . 'leoblog';  
		$tpath = _PS_ALL_THEMES_DIR_.$theme.'modules/leoblog/front';

		$output = array();
		
		$templates = glob( $path.'/views/templates/front/*', GLOB_ONLYDIR );

		$ttemplates = glob(  $tpath , GLOB_ONLYDIR );
		if( $templates ){
			foreach( $templates as $t ){
				$output[basename($t)] = array( 'type'=>'module', 'template'=>basename($t) );
			}
		}
		if( $ttemplates ){
			foreach( $ttemplates as $t ){
				$output[basename($t)] = array( 'type'=>'module', 'template'=>basename($t) );
			}	
		}
 		
 		return $output;
	}
	
		
	public static function buildBlog( $helper, $blog, $image_w=0 , $image_h=0 , $config ){
			$blog['preview_url'] = '';
			$blog['image_url'] = '';
			if( $blog['image'] ){
				$blog['image_url'] = _PS_BASE_URL_._LEOBLOG_BLOG_IMG_URI_.'b/'.$blog['image'];
				if (!file_exists(_LEOBLOG_CACHE_IMG_DIR_.'b/'.$blog['id_leoblog_blog'].'/'.$image_w.'_'.$image_h.'/'.$blog['image'])){
						@mkdir( _LEOBLOG_CACHE_IMG_DIR_.'b/'.$blog['id_leoblog_blog'], 0755);
								@mkdir( _LEOBLOG_CACHE_IMG_DIR_.'b/'.$blog['id_leoblog_blog'].'/'.$image_w.'_'.$image_h, 0755);
									if( ImageManager::resize( _LEOBLOG_BLOG_IMG_DIR_.'b/'.$blog['image'], _LEOBLOG_CACHE_IMG_DIR_.'b/'.$blog['id_leoblog_blog'].'/'.$image_w.'_'.$image_h.'/'.$blog['image'], $image_w, $image_h) ){
									$blog['preview_url'] =  _LEOBLOG_CACHE_IMG_DIR_.'b/'.$blog['id_leoblog_blog'].'/'.$image_w.'_'.$image_h.'/'.$blog['image'];
					}	
				}
				$blog['image_url'] = _PS_BASE_URL_._LEOBLOG_BLOG_IMG_URI_.'b/'.$blog['image'];
				$blog['preview_url'] = _PS_BASE_URL_._LEOBLOG_CACHE_IMG_URI_.'b/'.$blog['id_leoblog_blog'].'/'.$image_w.'_'.$image_h.'/'.$blog['image'];
			} 
			$params = array(
				'rewrite' => $blog['category_link_rewrite'],
				'id'	  => $blog['id_leoblogcat']
			);
		//	if( !$config->get( 'listing_show_counter' , 1)  ) {	 
			if( $config->get('item_comment_engine','local')=='local' ){
				$blog['comment_count'] =  LeoBlogComment::countComments( $blog['id_leoblog_blog'], true, true );
			}
		//	}else {
			//	$blog['comment_count'] = 0;
		//	}
			$blog['category_link'] =  $helper->getBlogCatLink( $params );  
			$blog['link'] = $helper->getBlogLink( $blog );
			return $blog;
	} 
	
	public static function rrmdir($dir) {
				if (is_dir($dir)) {
					$objects = scandir($dir);
					foreach ($objects as $object) {
					  if ($object != "." && $object != "..") {
						if (filetype($dir."/".$object) == "dir") 
						   self::rrmdir($dir."/".$object); 
						else 
							unlink($dir."/".$object);
					  }
					}
					reset($objects);
					rmdir($dir);
					}
	}

}
