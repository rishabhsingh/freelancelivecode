<?php
/**
 * Pts Prestashop Theme Framework for Prestashop 1.6.x
 *
 * @package   ptsstaticcontent
 * @version   2.1
 * @author    http://www.prestabrain.com
 * @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
 *               <info@prestabrain.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

if (!defined('_PS_VERSION_'))
	exit;	
require_once( dirname(__FILE__).'/sample/sample.php' );

class ptsstaticcontent extends Module
{
	protected $max_image_size = 1048576;
    protected $default_language;
    protected $languages;

    protected $modulehooks;

    protected $_prefix = 'PTSSTC_';

	public function __construct()
	{
		$this->name             = 'ptsstaticcontent';
		$this->tab              = 'front_office_features';
		$this->version          = '2.1';
        $this->author           = 'PrestaBrain';
		$this->bootstrap        = true;
        $this->secure_key       = Tools::encrypt($this->name);                
        $this->default_language = Language::getLanguage(Configuration::get('PS_LANG_DEFAULT'));
        $this->languages        = Language::getLanguages();

		parent::__construct();	
        
		$this->displayName      = $this->l('Pts Static Content Manager');
		$this->description      = $this->l('Manage Static Content, Banners Following postions supported by Leo Framework 3.0');
		$this->module_path      = _PS_MODULE_DIR_.$this->name.'/';
        $this->uploads_path     = _PS_MODULE_DIR_.$this->name.'/images/';
        $this->admin_tpl_path   = _PS_MODULE_DIR_.$this->name.'/views/templates/admin/';
        $this->hooks_tpl_path   = _PS_MODULE_DIR_.$this->name.'/views/templates/hooks/';

        $this->modulehooks      = array( 'home', 
                                         'topcolumn', 
                                         'slideshow', 
                                         'promotetop',
                                         'top', 
                                         'left', 
                                         'right', 
                                         'contentbottom', 
                                         'bottom',
                                         'footertop',
                                         'footer',
                                         'footerbottom' );
	}
	
    public function getConfigValue( $name ){
        return Configuration::get( $this->getConfigName($name) );
    }

    public function getConfigName( $name ){
        return strtoupper( $this->_prefix.$name );
    }

	public function install()
	{	
		PtsStaticContentSampe::onInstall( $this );
		if (!parent::install() ||          
            !$this->registerHook('displayHeader') ||
            !$this->registerHook('displayTop') ||
            !$this->registerHook('displayPromoteTop') ||
            !$this->registerHook('displayLeftColumn') ||
            !$this->registerHook('displayRightColumn') ||
            !$this->registerHook('displayHome') ||
            !$this->registerHook('displayTopColumn') ||
            !$this->registerHook('displayBottom') ||
            !$this->registerHook('displayFooterTop') ||
            !$this->registerHook('displayFooter') ||
            !$this->registerHook('displayFooterBottom') ||
	    !$this->registerHook('actionObjectLanguageAddAfter') ||
            !$this->registerHook('displayBackOfficeHeader') )
			return false; 

		return true;
	}
    public function hookActionObjectLanguageAddAfter($params) {
        
        $id_lang = (int)$params['object']->id;
        $table = _DB_PREFIX_.'ptsstaticcontent';
        $sql = ' SELECT * FROM `'._DB_PREFIX_.'ptsstaticcontent` WHERE 
                 id_shop = '.(int)$this->context->shop->id.' AND id_lang='.(int)$this->context->language->id;

        $data = Db::getInstance()->query( $sql );
        
        $query = array();
        
        while ($row = DB::getInstance()->nextRow($data)) {
            
            $fs = array();
            $vs = array();

            foreach( $row as $key => $value ){
                if( $key=='id_item'){
                    continue;
                }
                $fs[] = $key;
                if( $key == 'id_lang' ){
                    $value="_LANGUAGEID_";
                }elseif( $key == 'id_shop' ){
                    $value="_SHOPID_";
                }
                $vs[] = "'".DB::getInstance()->escape( $value, true )."'";
            }
            $query[] = 'INSERT INTO '.$table.'( `'.implode( "`,`", $fs).'` ) VALUES('.implode(", ",  $vs).')';  
        }
        
        if( $query ){
            foreach( $query as $s ){
                $s = str_replace( '_SHOPID_', (int)$this->context->shop->id, $s );
                $s = str_replace( '_LANGUAGEID_', (int)$id_lang, $s );
                if ( !Db::getInstance()->Execute($s) ) {
                    
                }

            }
        }    
    }

	    public function uninstall() 
        {
                $images = Db::getInstance()->executeS('SELECT image FROM `'._DB_PREFIX_.'ptsstaticcontent`');
                foreach ($images as $image)
                        $this->deleteImage($image['image']);

                if (!Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'ptsstaticcontent`') ||
                        !parent::uninstall())
                        return false;
                PtsStaticContentSampe::onUninstall();   
                return true;
        }

        public function hookDisplayBackOfficeHeader()
        {
            if (Tools::getValue('configure') != $this->name)
                    return;
            $this->context->controller->addCSS($this->_path.'views/css/admin.css');
            $this->context->controller->addJquery();
            $this->context->controller->addJS($this->_path.'views/js/admin.js');
            
            $this->context->controller->addJS(array(
                _PS_JS_DIR_.'tiny_mce/tiny_mce.js',
                _PS_JS_DIR_.'tinymce.inc.js'
            ));


        }

        public function hookdisplayHeader($params)
        {
            $this->context->controller->addCss($this->_path.'views/css/hooks.css', 'all');
        }

        public function hookDisplayTop()
        {
        	
            $this->context->smarty->assign(array(
                    'htmlitems'=> $this->getItemsFromHook('top'),
                    'hook' => 'top'
            ));
            return $this->display(__FILE__, 'hook.tpl');
        }

        /***/
        public function hookDisplaySlideshow() 
        {
                $this->context->smarty->assign(array(
                        'htmlitems'=> $this->getItemsFromHook('slideshow'),
                        'hook' => 'slideshow'
                ));
                 return $this->display(__FILE__, 'hook.tpl');
        } 
		public function hookdisplayTopColumn() 
        {
                $this->context->smarty->assign(array(
                        'htmlitems'=> $this->getItemsFromHook('topcolumn'),
                        'hook' => 'topcolumn'
                ));
                 return $this->display(__FILE__, 'hook.tpl');
        }

        public function hookDisplayPromoteTop() 
        {
                $this->context->smarty->assign(array(
                        'htmlitems'=> $this->getItemsFromHook('promotetop'),
                        'hook' => 'promotetop'
                ));
                 return $this->display(__FILE__, 'hook.tpl');
        }

        public function hookDisplayContentBottom() 
        {
                $this->context->smarty->assign(array(
                        'htmlitems'=> $this->getItemsFromHook('contentbottom'),
                        'hook' => 'contentbottom'
                ));
                 return $this->display(__FILE__, 'hook.tpl');
        }

        public function hookDisplayBottom() 
        {
                $this->context->smarty->assign(array(
                        'htmlitems'=> $this->getItemsFromHook('bottom'),
                        'hook' => 'bottom'
                ));
                 return $this->display(__FILE__, 'hook.tpl');
        }

        public function hookDisplayFooterTop() 
        {
                $this->context->smarty->assign(array(
                        'htmlitems'=> $this->getItemsFromHook('footertop'),
                        'hook' => 'footertop'
                ));
                 return $this->display(__FILE__, 'hook.tpl');
        }

        public function hookDisplayFooterBottom() 
        {
		
			$this->context->smarty->assign(array(
					'htmlitems'=> $this->getItemsFromHook('footerbottom'),
					'hook' => 'footerbottom'
			));
			
			return $this->display(__FILE__, 'hook.tpl');
        }

        /***/
        public function hookDisplayHome() 
        {
                $this->context->smarty->assign(array(
                        'htmlitems'=> $this->getItemsFromHook('home'),
                        'hook' => 'home'
                ));
                 return $this->display(__FILE__, 'hook.tpl');
        }


     
        public function hookDisplayLeftColumn() 
        {
                $this->context->smarty->assign(array(
                        'htmlitems'=> $this->getItemsFromHook('left'),
                        'hook' => 'left'
                ));
                 return $this->display(__FILE__, 'hook.tpl');
        }
        
        public function hookDisplayRightColumn() 
        {
                $this->context->smarty->assign(array(
                        'htmlitems'=> $this->getItemsFromHook('right'),
                        'hook' => 'right'
                ));
                 return $this->display(__FILE__, 'hook.tpl');
        }  
        
        public function hookDisplayFooter() 
        {
                $this->context->smarty->assign(array(
                        'htmlitems'=> $this->getItemsFromHook('footer'),
                        'hook' => 'footer'
                ));
                 return $this->display(__FILE__, 'hook.tpl');
        }  

        protected function getItemsFromHook($hook)
        {
                $this->context->smarty->assign( 'hookcols', $this->getConfigValue('col_'.$hook) );
                if (!$hook)
                        return false;

                return Db::getInstance()->ExecuteS('
                        SELECT * 
                        FROM `'._DB_PREFIX_.'ptsstaticcontent` 
                        WHERE id_shop = '.(int)$this->context->shop->id.' AND id_lang = '.(int)$this->context->language->id.' AND hook = \''.pSQL($hook).'\' AND active = 1 
                        ORDER BY item_order ASC'
                );
        }

        protected function deleteImage($image) 
        {
                $file_name = $this->uploads_path.$image;
                /*
                if (realpath(dirname($file_name)) != $this->uploads_path)
                        die;
                */
                if ($image != '' && is_file($file_name))
                        unlink($file_name);
        }

        protected function removeItem() 
        {
                $id_item = (int)Tools::getValue('item_id');
                
                if ($image = Db::getInstance()->getValue('SELECT image FROM `'._DB_PREFIX_.'ptsstaticcontent` WHERE id_item = '.(int)$id_item))
                        $this->deleteImage($image);
                        
                Db::getInstance()->delete(_DB_PREFIX_.'ptsstaticcontent', 'id_item = '.(int)$id_item);
        
                if (Db::getInstance()->Affected_Rows() == 1)
                {
                        Db::getInstance()->execute('
                                UPDATE `'._DB_PREFIX_.'ptsstaticcontent` 
                                SET item_order = item_order-1 
                                WHERE (
                                        item_order > '.(int)Tools::getValue('item_order').' AND 
                                        id_shop = '.(int)$this->context->shop->id.' AND
                                        hook = \''.pSQL(Tools::getValue('item_hook')).'\')
                        ');
                        
                        $this->context->smarty->assign('confirmation', $this->l('Successful deletion.'));
                }
                else
                        $this->context->smarty->assign('error', $this->l('Can\'t delete the slide.'));
        }
        
        protected function updateItem()
        {
            $id_item = (int)Tools::getValue('item_id');

            $title = Tools::getValue('item_title');
            $content = Tools::getValue('item_html');
            if (!Validate::isCleanHtml($title, (int)Configuration::get('PS_ALLOW_HTML_IFRAME')) || !Validate::isCleanHtml($content,(int)Configuration::get('PS_ALLOW_HTML_IFRAME')))
            {
                    $this->context->smarty->assign('error', $this->l('Invalid content'));
                    return false;
            }
            
            $new_image = '';
            if(Tools::getValue('delete_image') == 1){
                $new_image = 'image = \'\',';
                $old_image_name = Tools::getValue('old_image_name');
                @unlink(_PS_MODULE_DIR_.$this->name.'/images/'.$old_image_name);
            }
            $image_w = (is_numeric(Tools::getValue('item_img_w'))) ? (int)Tools::getValue('item_img_w') : '';
            $image_h = (is_numeric(Tools::getValue('item_img_h'))) ? (int)Tools::getValue('item_img_h') : '';
            
            if(!empty($_FILES['item_img']['name']))
            {
                    if ($old_image = Db::getInstance()->getValue('SELECT image FROM `'._DB_PREFIX_.'ptsstaticcontent` WHERE id_item = '.(int)$id_item)) {
                        $this->deleteImage($old_image);
                    }

                    if (!$image = $this->uploadImage($_FILES['item_img'], $image_w, $image_h))
                            return false;

                    $new_image = 'image = \''.pSQL($image).'\',';
            } 
            else 
            {
                    $image_w = '';
                    $image_h = '';
            }

            $collg = (int)Tools::getValue('col_lg');
            $smlg = (int)Tools::getValue('col_sm');

            if (!Db::getInstance()->execute('
                    UPDATE `'._DB_PREFIX_.'ptsstaticcontent` SET 
                            title = \''.pSQL($title).'\',
                            title_use = '.(int)Tools::getValue('item_title_use').',
                            hook = \''.pSQL(Tools::getValue('item_hook')).'\',
                            url = \''.pSQL(Tools::getValue('item_url')).'\',
                            target = '.(int)Tools::getValue('item_target').',
                            '.$new_image.'
                            image_w = '.(int)$image_w.',
                            image_h = '.(int)$image_h.',
                            col_lg  = '.(int)$collg.',
                            col_sm  = '.(int)$smlg.',
                            active = '.(int)Tools::getValue('item_active').',
                            html = \''.pSQL($content, true).'\',
                            class = \''.pSQL(Tools::getValue('class')).'\'
                    WHERE id_item = '.(int)Tools::getValue('item_id')
            ))
            {
                    if ($image = Db::getInstance()->getValue('SELECT image FROM `'._DB_PREFIX_.'ptsstaticcontent` WHERE id_item = '.(int)Tools::getValue('item_id')))
                            $this->deleteImage($image);
                    
                    $this->context->smarty->assign('error', $this->l('An error occured while saving data.'));
                    return false;
            }
            $this->context->smarty->assign('confirmation', $this->l('Successfully updated.'));
            return true;
    }

    protected function uploadImage($image, $image_w = '', $image_h = '') 
    {
        $res = false;
        if (is_array($image) && (ImageManager::validateUpload($image, $this->max_image_size) === false) && ($tmp_name = tempnam(_PS_TMP_IMG_DIR_, 'PS')) && move_uploaded_file($image['tmp_name'], $tmp_name))
        {
            $img_name = strtolower(preg_replace( "#\s+#", "_",  $image['name']) );
            Configuration::set('PS_IMAGE_QUALITY','png_all');
            if (ImageManager::resize($tmp_name, dirname(__FILE__).'/images/'.$img_name, $image_w, $image_h))
                $res = true;

        }

        if (isset($temp_name))
            @unlink($tmp_name);
        if (!$res) {
            $this->context->smarty->assign('error', $this->l('An error occurred during the image upload.'));
            return false;
        }

        return $img_name;
    }

	public function getContent()
    {
        if( Tools::getValue('id') && Tools::getValue('setActiveAction') ){
            $out  = new stdClass();
            $out->active = (int)Tools::getValue('current');
            $out->id = (int)Tools::getValue('id');
            $sql = ' UPDATE `'._DB_PREFIX_.'ptsstaticcontent` SET `active`='.$out->active.' WHERE `id_item`='.$out->id;
            
            Db::getInstance()->Execute( $sql );
            echo  json_encode( $out );die;
        }
        if (Tools::isSubmit('submitModule')) {
            foreach( $this->modulehooks as $mhook ){  
                Configuration::updateValue( $this->getConfigName("COL_".$mhook), (int)Tools::getValue($this->getConfigName("COL_".$mhook)) );        
            }
        }

        if (Tools::isSubmit('newItem'))
                $this->addItem();
        elseif (Tools::isSubmit('updateItem'))
                $this->updateItem();
        elseif (Tools::isSubmit('removeItem'))
                $this->removeItem();
        
        if(Tools::getValue('formedit')) {
            return $this->editForm();
        }
        
        $html = $this->renderptsstaticcontentForm();

        return $html;
    }
    
    protected function addItem() 
    {
        $title = Tools::getValue('item_title');
        $content = Tools::getValue('item_html');
        if (!Validate::isCleanHtml($title, (int)Configuration::get('PS_ALLOW_HTML_IFRAME')) || !Validate::isCleanHtml($content, (int)Configuration::get('PS_ALLOW_HTML_IFRAME')))
        {
            $this->context->smarty->assign('error', $this->l('Invalid content'));
            return false;
        }
        if (!$current_order = (int)Db::getInstance()->getValue('
            SELECT item_order + 1
            FROM `'._DB_PREFIX_.'ptsstaticcontent` 
            WHERE 
                    id_shop = '.(int)$this->context->shop->id.' 
                    AND id_lang = '.(int)Tools::getValue('id_lang').'
                    AND hook = \''.pSQL(Tools::getValue('item_hook')).'\' 
                    ORDER BY item_order DESC'
            ))
            $current_order = 1;
        
        $image_w = is_numeric(Tools::getValue('item_img_w')) ? (int)Tools::getValue('item_img_w') : '';
        $image_h = is_numeric(Tools::getValue('item_img_h')) ? (int)Tools::getValue('item_img_h') : '';
        
        if(!empty($_FILES['item_img']['name']))
        {
            if (!$image = $this->uploadImage($_FILES['item_img'], $image_w, $image_h))
                return false;
        } else {
            $image = '';
            $image_w = '';
            $image_h = '';
        }
        
        $collg = (int)Tools::getValue('col_lg');
        $colsm = (int)Tools::getValue('col_sm');

        if (!Db::getInstance()->Execute('
                INSERT INTO `'._DB_PREFIX_.'ptsstaticcontent` ( 
                        `id_shop`, `id_lang`, `item_order`, `title`, `title_use`, `hook`, `url`, `target`, `image`, `image_w`, `image_h`, `html`, `active`, `col_lg`, `class`
               ) VALUES ( 
                        \''.(int)$this->context->shop->id.'\',
                        \''.(int)Tools::getValue('id_lang').'\',
                        \''.(int)$current_order.'\',
                        \''.pSQL($title).'\',
                        \''.(int)Tools::getValue('item_title_use').'\',
                        \''.pSQL(Tools::getValue('item_hook')).'\',
                        \''.pSQL(Tools::getValue('item_url')).'\',
                        \''.(int)Tools::getValue('item_target').'\',
                        \''.pSQL($image).'\',
                        \''.pSQL($image_w).'\',
                        \''.pSQL($image_h).'\',
                        \''.pSQL($content, true).'\',
                        1 ,
                        \''.$collg.'\',
                        \''.pSQL(Tools::getValue('class')).'\'
                        )
                '))
        {
                if (!Tools::isEmpty($image))
                        $this->deleteImage($image);

                $this->context->smarty->assign('error', $this->l('An error occured while saving data.'));        
                return false;        
        }

        $this->context->smarty->assign('confirmation', $this->l('New item added successfull.'));
        return true;
    }
    
    protected function renderptsstaticcontentForm()
    {        
        $this->context->controller->addJS( __PS_BASE_URI__ . 'js/tiny_mce/tiny_mce.js' );
        $this->context->controller->addJS( __PS_BASE_URI__ . 'js/tinymce.inc.js' );
        $id_shop = (int)$this->context->shop->id;
        $items = array();

        $this->context->smarty->assign('htmlcontent', array(
                'admin_tpl_path' => $this->admin_tpl_path,
                'hooks_tpl_path' => $this->hooks_tpl_path,
                'info' => array(
                        'module'    => $this->name,
                        'name'      => $this->displayName,
                        'version'   => $this->version,
                        'psVersion' => _PS_VERSION_,
                        'context'   => (Configuration::get('PS_MULTISHOP_FEATURE_ACTIVE') == 0) ? 1 : ($this->context->shop->getTotalShops() != 1) ? $this->context->shop->getContext() : 1
                )
        ));

        foreach ($this->languages as $language) {
            $hooks[$language['id_lang']] = $this->modulehooks;
            foreach ($hooks[$language['id_lang']] as $hook)
                $items[$language['id_lang']][$hook] = Db::getInstance()->ExecuteS('
                        SELECT * FROM `'._DB_PREFIX_.'ptsstaticcontent` 
                        WHERE id_shop = '.(int)$id_shop.' 
                        AND id_lang = '.(int)$language['id_lang'].' 
                        AND hook = \''.pSQL($hook).'\' 
                        ORDER BY item_order ASC'
                );
        }

        $cols = array(1,2,3,4,6,8,9,10,11,12);
        $iso = $this->context->language->iso_code;
        $this->context->smarty->assign('htmlitems', array(
            'items' => $items,
            'cols' => $cols,
            'autocol' => '',
            'modulehooks' => $this->modulehooks,
            'lang' => array(
                    'default' => $this->default_language,
                    'all' => $this->languages,
                    'lang_dir' => _THEME_LANG_DIR_,
                    'user' => $this->context->language->id
            ),                                
            'postAction' => 'index.php?tab=AdminModules&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&tab_module=other&module_name='.$this->name.'',
            'id_shop' => $id_shop,
            'ad' => dirname($_SERVER["PHP_SELF"]),
            'isoTinyMCE' => (file_exists(_PS_ROOT_DIR_ . '/js/tiny_mce/langs/' . $iso . '.js') ? $iso : 'en'),
            '_THEME_CSS_DIR_' => _THEME_CSS_DIR_,
        ));
        
        return $this->display(__FILE__, 'views/templates/admin/admin.tpl');
    }
    
    public function editForm(){
        $this->context->controller->addCSS($this->_path.'views/css/widget.css');
        $this->context->controller->addJS( __PS_BASE_URI__ . 'js/tiny_mce/tiny_mce.js' );
        $this->context->controller->addJS( __PS_BASE_URI__ . 'js/tinymce.inc.js' );
        $id_item = Tools::getValue('id_item');
        $hItem = Db::getInstance()->getRow('
            SELECT * FROM `'._DB_PREFIX_.'ptsstaticcontent` 
            WHERE id_item = '.(int)$id_item
        );
        $iso = $this->context->language->iso_code;
        
        $this->context->smarty->assign(array(
            'hItem' => $hItem,
            'modulehooks' => $this->modulehooks,
            'lang' => array(
                    'default' => $this->default_language,
                    'all' => $this->languages,
                    'lang_dir' => _THEME_LANG_DIR_,
                    'id_lang' => $this->context->language->id
            ),                                
            'postAction' => 'index.php?tab=AdminModules&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&tab_module=other&module_name='.$this->name.'',
            'id_shop' => $this->context->shop->id,
            'ad' => dirname($_SERVER["PHP_SELF"]),
            'isoTinyMCE' => (file_exists(_PS_ROOT_DIR_ . '/js/tiny_mce/langs/' . $iso . '.js') ? $iso : 'en'),
            '_THEME_CSS_DIR_' => _THEME_CSS_DIR_,
        ));
        return $this->display(__FILE__, 'views/templates/admin/edit.tpl');
    }
    
}
