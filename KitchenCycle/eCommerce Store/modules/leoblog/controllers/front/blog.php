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

include_once(_PS_MODULE_DIR_ . 'leoblog/loader.php');

class LeoblogblogModuleFrontController extends ModuleFrontController
{
	 
 	public $php_self;
 	protected $_template_path = '';
	public function __construct()
	{
		parent::__construct();
		$this->context = Context::getContext();
		$this->_template_path = _PS_MODULE_DIR_.'leoblog/views/templates/front/';
		$tmpl = _PS_THEME_DIR_.'modules/leoblog/views/templates/front/';
		if( is_dir($tmpl))
			$this->_template_path = $tmpl;
	}

	public function captcha() {
		include_once(_PS_MODULE_DIR_ . 'leoblog/classes/captcha.php');
		$captcha = new LeoCaptcha();
		$this->context->cookie->leocaptch = $captcha->getCode();
		$captcha->showImage();
	}	


	/**
	 * Copy datas from $_POST to object
	 *
	 * @param object &$object Object
	 * @param string $table Object table
	 */
	protected function copyFromPost(&$object, $table)
	{
		/* Classical fields */
		foreach ($_POST as $key => $value)
			if (key_exists($key, $object) && $key != 'id_'.$table)
			{
				/* Do not take care of password field if empty */
				if ($key == 'passwd' && Tools::getValue('id_'.$table) && empty($value))
					continue;
				/* Automatically encrypt password in MD5 */
				if ($key == 'passwd' && !empty($value))
					$value = Tools::encrypt($value);
				$object->{$key} = $value;
			}

		/* Multilingual fields */
		$rules = call_user_func(array(get_class($object), 'getValidationRules'), get_class($object));
		if (count($rules['validateLang']))
		{
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
				foreach (array_keys($rules['validateLang']) as $field)
					if (isset($_POST[$field.'_'.(int)($language['id_lang'])]))
						$object->{$field}[(int)($language['id_lang'])] = $_POST[$field.'_'.(int)($language['id_lang'])];
		}
	}

	/**
	 * Save user comment
	 */
	protected function comment(){  
		if( !empty($_POST) ){
			
			$comment = new LeoBlogComment();
			$captcha = Tools::getValue( 'captcha' );
			$this->copyFromPost($comment, 'comment');
			$error = new stdClass();
			$error->error = true;

			if( isset($this->context->cookie->leocaptch)  && $captcha && $captcha == $this->context->cookie->leocaptch ){
				if ($comment->validateFields(false) && $comment->validateFieldsLang(false)) { 
		 			$comment->save();
					$error->message = Tools::displayError( $this->module->l('Thanks for your comment, it will be published soon!!!') );
					$error->error = false;
				} else{
					$error->message =  Tools::displayError( $this->module->l('An error occurred while sending the comment. Please recorrect data in fields!!!') );
				}
			}else {
				$error->message =  Tools::displayError( $this->module->l('An error with captcha code, please try to recorrect!!!') );
			}

		 
			die( json_encode( $error ) );
		}		
	}

	/**
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{	

		if( Tools::getValue('captchaimage') ){
			$this->captcha();
			exit();
		}
 		$config = LeoBlogConfig::getInstance();

 	 	/* Load Css and JS File */
		LeoBlogHelper::loadMedia( $this->context, $this );

		parent::initContent();
		
		if( Tools::isSubmit('submitcomment') ){
			 $this->comment();
		}
	
		$helper = LeoBlogHelper::getInstance();
		$blog = new LeoBlogBlog( Tools::getValue('id'), $this->context->language->id );
        $_GET['rewrite'] = $blog->link_rewrite;
		if( !$blog->id_leoblog_blog ){
			$full_path = '<a href="'.$helper->getFontBlogLink().'">'.htmlentities( $config->get('blog_link_title_'.$this->context->language->id,'Blog'), ENT_NOQUOTES, 'UTF-8').'</a>';
			$vars = array(
				'error' => true,
				'path'	=> $full_path
			);
			$this->context->smarty->assign( $vars );
		
	  		return $this->setTemplate( $config->get('template','default').'/blog.tpl');
		}

		$category = new leoblogcat( $blog->id_leoblogcat, $this->context->language->id );


		$image_w =  $config->get( 'item_img_width',690 );
		$image_h =  $config->get( 'item_img_height',300 );
		
		$template = $category->template; 
		$this->_template_path .= $template.'/';
		$module_tpl = $this->_template_path;
		
		$blog->preview_url  = '';
		if( $blog->image ){
			$blog->image_url = _PS_BASE_URL_._LEOBLOG_BLOG_IMG_URI_.'b/'.$blog->image; 
			if( ImageManager::resize( _LEOBLOG_BLOG_IMG_DIR_.'b/'.$blog->image, _LEOBLOG_CACHE_IMG_DIR_.'b/lg-'.$blog->image, $image_w, $image_h) ){
				$blog->preview_url = _PS_BASE_URL_._LEOBLOG_CACHE_IMG_URI_.'b/lg-'.$blog->image;
			} 
		}

		

		$captcha_image = $helper->getBlogLink( get_object_vars( $blog ), array('captchaimage'=>1) );
		$blog_link = $helper->getBlogLink( get_object_vars( $blog ) );
 	 
		$params = array(
			'rewrite' => $category->link_rewrite,
			'id'	  => $category->id_leoblogcat
		);

		$blog->category_link =  $helper->getBlogCatLink( $params );  
		$blog->category_title = $category->title;

		
	 	 
	 	$employee = new Employee( $blog->id_employee );

		$blog->author 	   = $employee->firstname . " " . $employee->lastname; 
		$blog->author_link = $helper->getBlogAuthorLink( $employee->id ); 
		 

		$tags = array();

		if( $blog->tags && $tmp=explode(",",$blog->tags) ){
			foreach( $tmp as $tag ){
				$tags[] = array( 
					'tag' => $tag,
					'link' => $helper->getBlogTagLink( $tag )
				);	
			}
		}

		
		$blog->hits = $blog->hits+1;
		//$blog->save();
                $blog->updateField($blog->id, array("hits"=>$blog->hits));
                
		/* breadscrumb */
 		$params = array(
			'rewrite' => $category->link_rewrite,
			'id'	  => $category->id_leoblogcat
		);

 
		$category_link = $helper->getBlogCatLink( $params );  
		$full_path = '<a href="'.$helper->getFontBlogLink().'">'.htmlentities( $config->get('blog_link_title_'.$this->context->language->id,'Blog'), ENT_NOQUOTES, 'UTF-8')
				   .'</a><span class="navigation-pipe">'.Configuration::get('PS_NAVIGATION_PIPE').'</span>';	
		$full_path .= '<a href="'.Tools::safeOutput( $category_link ).'">'.htmlentities($category->title, ENT_NOQUOTES, 'UTF-8').'</a><span class="navigation-pipe">'.Configuration::get('PS_NAVIGATION_PIPE').'</span>'.$blog->meta_title;

		$limit = 5;
		
		$samecats = LeoBlogBlog::getListBlogs(  $category->id_leoblogcat, 
											     $this->context->language->id , 0,  
											     $limit, 'date_add', 'DESC', array( 'type'=> 'samecat', 'id_leoblog_blog'=>$blog->id_leoblog_blog ), true  
		);
		foreach( $samecats as $key => $sblog ){
			$sblog['link'] = $helper->getBlogLink( $sblog );
			$samecats[$key] = $sblog;
		}

		$tagrelated = array();
 
		if( $blog->tags ){

			$tagrelated = LeoBlogBlog::getListBlogs(  $category->id_leoblogcat, 
												     $this->context->language->id , 0,  
												     $limit, 'date_add', 'DESC', array( 'type'=> 'tag', 'tag'=> $blog->tags ), true  
			);

			foreach( $tagrelated as $key => $tblog ){
				$tblog['link'] = $helper->getBlogLink( $tblog );
				$tagrelated[$key] = $tblog;
			}
		}	

		/* Comments */
			$evars = array();
		if( $config->get('item_comment_engine','local')=='local' ){
			$countComment = 0;
			if( $config->get('comment_engine','local') == 'local' ){
				$countComment = LeoBlogComment::countComments( $blog->id_leoblog_blog, true );
			}


			$blog_link = $helper->getBlogLink( get_object_vars($blog) ); 
			$limit = (int)$config->get( 'item_limit_comments', 10 );
			$n=$limit;
	    	$p = abs((int)(Tools::getValue('p', 1))); 

			$comment = new LeoBlogComment();
			$comments = $comment->getList( $blog->id_leoblog_blog, $this->context->language->id, $p, $limit );

			
			$nbBlogs = $countComment;
		    $range = 2; /* how many pages around page selected */
		    if ($p > (($nbBlogs / $n) + 1))
		        Tools::redirect(preg_replace('/[&?]p=\d+/', '', $_SERVER['REQUEST_URI']));
		    $pages_nb = ceil($nbBlogs / (int)($n));
		    $start = (int)($p - $range);
		    if ($start < 1)
		        $start = 1;
		    $stop = (int)($p + $range);
		    if ($stop > $pages_nb)
		        $stop = (int)($pages_nb);


	 		$evars = array(	'pages_nb' => $pages_nb, 
							'nb_items' => $countComment,
							'p' => (int)$p,
							'n' => (int)$n, 
							'requestPage' => $blog_link,
							'requestNb' => $blog_link,
							'start' => $start,
							'comments'	 => $comments,
							'range' => $range,
							'blog_count_comment' => $countComment,
							'stop'  => $stop   );
	 	}  
		
	    $vars = array(
		
			'tags'		 	   => $tags,
			'meta_title' 	   => ucfirst($blog->meta_title) . ' - '. $this->context->shop->name ,
			'meta_keywords'    => $blog->meta_keywords,
			'meta_description' => $blog->meta_description,
			'blog'   	 => $blog,
			'samecats'	 => $samecats,
			'tagrelated' => $tagrelated,
			
			'path'		 => $full_path,
			'config'	 => $config, 
			'id_leoblog_blog' 	 => $blog->id_leoblog_blog,
			'is_active'  => $blog->active,
			'productrelated'=> array(),
			'module_tpl' => $module_tpl,
			'captcha_image'	     => $captcha_image,
			'blog_link' 	     => $blog_link,
			
 		) ;
 		 $vars = array_merge(  $vars, $evars );

		$this->context->smarty->assign( $vars );
		
	  	$this->setTemplate($template.'/blog.tpl');
	} 
}
?>