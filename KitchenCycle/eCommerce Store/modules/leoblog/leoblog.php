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

if (!defined('_PS_VERSION_'))
    exit;

include_once(_PS_MODULE_DIR_ . 'leoblog/loader.php');
include_once(_PS_CLASS_DIR_.'../tools/pear/PEAR.php');
include_once(_PS_PEAR_XML_PARSER_PATH_.'Parser.php');
class leoblog extends Module {

    /**
     * 
     */
	private static $leoxmlFields = array('title', 'guid', 'description', 'author', 'comments', 'pubDate', 'source', 'link', 'content');
    public $base_config_url;

    /**
     * Constructor
     */
    public function __construct() {

        global $currentIndex;
           
        $this->name = 'leoblog';
        $this->tab = 'front_office_features';
        $this->version = '2.0';
        $this->author = 'LeoTheme';
        $this->need_instance = 0;
        $this->bootstrap = true;

        
        $this->secure_key = Tools::encrypt($this->name);

        parent::__construct();
 
        $this->base_config_url = $currentIndex . '&configure=' . $this->name . '&token=' . Tools::getValue('token');
        $this->displayName = $this->l('Leo Blog Management');
        $this->description = $this->l('Manage Blog Content');
    }

    
    /**
     * Uninstall
     */
    private function uninstallModuleTab($class_sfx = '') {
        $tabClass = 'Admin' . ucfirst($this->name) . ucfirst($class_sfx);

        $idTab = Tab::getIdFromClassName($tabClass);
        if ($idTab != 0) {
            $tab = new Tab($idTab);
            $tab->delete();
            return true;
        }
        return false;
    }

    /**
     * Install Module Tabs
     */
    private function installModuleTab($title, $class_sfx = '', $parent = '') {
        $class = 'Admin' . ucfirst($this->name) . ucfirst($class_sfx);
        @copy(_PS_MODULE_DIR_ . $this->name . '/logo.gif', _PS_IMG_DIR_ . 't/' . $class . '.gif');
        if ($parent == '') {
            $position = Tab::getCurrentTabId();
        } else {
            $position = Tab::getIdFromClassName($parent);
        }

        $tab1 = new Tab();
        $tab1->class_name = $class;
        $tab1->module = $this->name;
        $tab1->id_parent = intval($position);
        $langs = Language::getLanguages(false);
        foreach ($langs as $l) {
            $tab1->name[$l['id_lang']] = $title;
        }
        $id_tab1 = $tab1->add(true, false);
    }

    
    /**
     * @see Module::install()
     */
    public function install() {
         $hookspos = array(
            'displayTop',
            'displayHeaderRight',
            'displaySlideshow',
            'topNavigation',
            'displayMainmenu',
            'displayPromoteTop',
            'displayRightColumn',
            'displayLeftColumn',
            'moduleRoutes',
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
            

        /* Adds Module */
        if (parent::install() && $this->registerHook('moduleRoutes')&&$this->registerHook('displayBackOfficeHeader')
                && Configuration::updateValue('btmenu_iscache', 1)
                && Configuration::updateValue('btmenu_cachetime', 24)) {
            $res = true;

            Configuration::updateValue('LEOBLOG_CATEORY_MENU', 1 );
            /* Creates tables */
            $res &= $this->createTables();

        

            $class = 'Admin' . ucfirst($this->name) .'Management';
            $tab1 = new Tab();
            $tab1->class_name = $class;
            $tab1->module = $this->name;
            $tab1->id_parent = 0;
            $langs = Language::getLanguages(false);
            foreach ($langs as $l) {
                $tab1->name[$l['id_lang']] = $this->l( 'Blog Management' );
            }
            $id_tab1 = $tab1->add(true, false);



            $this->installModuleTab('Blog Dashboard', 'dashboard', 'AdminLeoblogManagement');
            $this->installModuleTab('Categories Management', 'categories', 'AdminLeoblogManagement');
            $this->installModuleTab('Blogs Management', 'blogs', 'AdminLeoblogManagement');
            $this->installModuleTab('Comment Management', 'comments', 'AdminLeoblogManagement');

            return (bool)$res;
        }
        return false;
    }

 
    public function hookDisplayBackOfficeHeader()
    {  
            $this->context->controller->addCss($this->_path.'assets/admin/blogmenu.css');
    }

    public function getContent()
    {   
        if (Tools::isSubmit('submitBlockCategories')){
            Configuration::updateValue('LEOBLOG_CATEORY_MENU', (int)Tools::getValue('LEOBLOG_CATEORY_MENU'));
        }
        return $this->renderForm();
    }
    public function renderForm()
    {
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
 
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Enable Categories Tree Block'),
                        'name' => 'LEOBLOG_CATEORY_MENU',
                        'desc' => $this->l('Activate  The Module.'),
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                 
                ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'btn btn-default')
            ),
        );
        
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table =  $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitBlockCategories';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $helper->generateForm(array($fields_form));
    }

    public function getConfigFieldsValues()
    {
        return array(
          
            'LEOBLOG_CATEORY_MENU' => Tools::getValue('LEOBLOG_CATEORY_MENU', Configuration::get('LEOBLOG_CATEORY_MENU')),
       
        );
    }
    
    public function _prepareHook(){
        
            $this->context->controller->addCSS(($this->_path).'assets/leoblog.css', 'all');
            $helper = LeoBlogHelper::getInstance();

            $category = new Leoblogcat( Tools::getValue('id_leoblogcat') , $this->context->language->id  );


            $tree = $category->getFrontEndTree(  (int)$category->id_leoblogcat>1?$category->id_leoblogcat:1 , $helper );
            $this->smarty->assign( 'tree', $tree );
            if( $category->id_leoblogcat ){
                $this->smarty->assign( 'currentCategory', $category );
            }
            
        return true;
    }

    public function hookLeftColumn($params) {
		//$html ="";
		//$config = LeoBlogConfig::getInstance();
		//$en_rss = $config->get('indexation');
		//if($en_rss && $en_rss == 1)
			//$html .=  $this->hookRSS($params); 
        if(Configuration::get('LEOBLOG_CATEORY_MENU') && $this->_prepareHook()) 
			return	$this->display(__FILE__, 'views/templates/hook/categories_menu.tpl');
		else
			return false;
    }
	
	/*function hookRSS($params)
	{

		if (!$this->isCached('leoblogrss.tpl', $cacheId))
		{
			// Getting data
			$config = LeoBlogConfig::getInstance();
			$title = strval($config->get('rss_title_item', 'RSS FEED'));
			$url = Tools::htmlentitiesutf8('http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__).'modules/leoblog/rss.php';
			$nb = (int)$config->get('rss_limit_item', 1);
			$cacheId = $this->getCacheId($this->name.'-'.date("YmdH"));
			$rss_links = array();
			if ($url && ($contents = Tools::file_get_contents($url)))
				try
				{
					if (@$src = new XML_Feed_Parser($contents))
						for ($i = 0; $i < ($nb ? $nb : 5); $i++)
							if (@$item = $src->getEntryByOffset($i))
							{
								$xmlValues = array();
								foreach(self::$leoxmlFields as $xmlField)
									$xmlValues[$xmlField] = $item->__get($xmlField);
								$xmlValues['enclosure'] = $item->getEnclosure();
								# Compatibility
								$xmlValues['url'] = $xmlValues['link']; 
								$rss_links[] = $xmlValues;
							}
				}
				catch (XML_Feed_Parser_Exception $e)
				{
					Tools::dieOrLog(sprintf($this->l('Error: invalid RSS feed in "leoblogrss" module: %s'), $e->getMessage()), false);
				}
				
			// Display smarty
			$this->smarty->assign(array('title' => ($title ? $title : $this->l('RSS feed')), 'rss_links' => $rss_links));
		}

 	 	return $this->display(__FILE__, 'views/templates/hook/leoblogrss.tpl', $cacheId);
 	} */



    protected function getCacheId($name = null)
    {
        $name = ($name ? $name.'|' : '').implode('-', Customer::getGroupsStatic($this->context->customer->id));
        return parent::getCacheId($name);
    }



    public function hookRightcolumn($params) {
        return $this->hookLeftColumn( $params );
    }

    /**
     * @see Module::uninstall()
     */
    public function uninstall() {
 
        if ( parent::uninstall() ) {
            $res = true;

            $this->uninstallModuleTab("management");

            $this->uninstallModuleTab("categories");
            $this->uninstallModuleTab("blogs");
            $this->uninstallModuleTab("comments");
            $this->uninstallModuleTab("dashboard");
            $res = $this->deleteTables();

            return (bool)$res;
        }
        return false;
    }
    
    public function deleteTables()
    {
            return true;
            return Db::getInstance()->execute('
                    DROP TABLE IF EXISTS
                    `'._DB_PREFIX_.'leoblogcat`,
                    `'._DB_PREFIX_.'leoblogcat_lang`,
                    `'._DB_PREFIX_.'leoblogcat_shop`,
                    `'._DB_PREFIX_.'leoblog_comment`,
                    `'._DB_PREFIX_.'leoblog_blog`,
                    `'._DB_PREFIX_.'leoblog_blog_lang`,
                    `'._DB_PREFIX_.'leoblog_blog_shop`');
    }

    /**
     * Creates tables
     */
    protected function createTables() {
        if($this->_installDataSample()) return true;
        $res = 1;
        include_once( dirname(__FILE__) . '/install/install.php' );
        return $res;
    }
    
    private function _installDataSample(){
        if (!file_exists(_PS_MODULE_DIR_ . 'leotempcp/libs/DataSample.php')) return false;        
        require_once( _PS_MODULE_DIR_ . 'leotempcp/libs/DataSample.php' );
        
        $sample = new Datasample(1);
        return $sample->processImport($this->name);
    }

    protected function installSample(){
        $res = 1;
        include_once( dirname(__FILE__) . '/install/sample.php' );
        return $res;
    }

    public function hookdisplayNav( $params ){
        return $this->hookDisplayTop( $params );
    }

    /**
     * Hook Display Top
     */
    public function hookDisplayTop( $params ){
        
        $params = array();
        $link = LeoBlogHelper::getInstance()->getFontBlogLink( );
        $config = LeoBlogConfig::getInstance();

        return '<a href="'.$link.'">' . $config->get('blog_link_title_'.$this->context->language->id,'Blog') . '</a>';


    }
    
    
    /**
     * Hook ModuleRoutes
     */
    public function hookModuleRoutes( $route='', $detail=array() ){
       return LeoBlogHelper::buildBlogRoutes();
    }

}