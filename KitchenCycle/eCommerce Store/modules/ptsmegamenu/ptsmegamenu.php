<?php
/**
 * Pts Prestashop Theme Framework for Prestashop 1.6.x
 *
 * @package   ptsmegamenu
 * @version   2.5
 * @author    http://www.prestabrain.com
 * @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
 *               <info@prestabrain.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

if (!defined('_PS_VERSION_'))
    exit;

include_once(_PS_MODULE_DIR_ . 'ptsmegamenu/classes/Btmegamenu.php');
include_once(_PS_MODULE_DIR_ . 'ptsmegamenu/libs/Helper.php');
require_once( _PS_MODULE_DIR_.'ptsmegamenu/classes/widgetbase.php');
require_once( _PS_MODULE_DIR_.'ptsmegamenu/classes/widget.php');



class PtsMegaMenu extends Module {

    private $_html = '';
    private $_configs = '';
    protected $params = null;
    public $_languages;
    public $_defaultFormLanguage;
    public $base_config_url;

    public $widget;

    /**
     * Constructor
     */
    public function __construct() {
        global $currentIndex;
        $this->name = 'ptsmegamenu';
        $this->tab = 'front_office_features';
        $this->version = '2.5';
        $this->author = 'PrestaBrain';
        $this->need_instance = 0;
        $this->bootstrap = true;

        
        $this->secure_key = Tools::encrypt($this->name);

        parent::__construct();
        $this->base_config_url = $currentIndex . '&configure=' . $this->name . '&token=' . Tools::getValue('token');

        $this->displayName = $this->l('Pts Megamenu');
        $this->description = $this->l('Pts Megamenu Support Pts Framework Version 2.0');
        $this->Languages();
        
        $this->widget = new PtsMegamenuWidget();
    }

 
    /**
     *
     */
    public function Languages() {
        //global $cookie;
        $cookie = $this->context->cookie;
        $allowEmployeeFormLang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        if ($allowEmployeeFormLang && !$cookie->employee_form_lang)
            $cookie->employee_form_lang = (int) (Configuration::get('PS_LANG_DEFAULT'));
        $useLangFromCookie = false;
        $this->_languages = Language::getLanguages(false);
        if ($allowEmployeeFormLang)
            foreach ($this->languages AS $lang)
                if ($cookie->employee_form_lang == $lang['id_lang'])
                    $useLangFromCookie = true;
        if (!$useLangFromCookie)
            $this->_defaultFormLanguage = (int) (Configuration::get('PS_LANG_DEFAULT'));
        else
            $this->_defaultFormLanguage = (int) ($cookie->employee_form_lang);
    }

 

    /**
     * @see Module::install()
     */
    public function install() {
		 $this->checkOwnerHooks();
        /* Adds Module */
        if (parent::install() && $this->registerHook('displayMainmenu') && $this->registerHook('header')
                && $this->registerHook('actionObjectLanguageAddAfter')
                && Configuration::updateValue('btmenu_iscache', 1)
                && Configuration::updateValue('btmenu_cachetime', 24)) {
            $res = true;
            
            /* Creates tables */
            $this->createTables();
           
            return $res;
        }
        return false;
    }

    private function checkOwnerHooks()
        {   
            $hookspos = array(
                'displayTop',
                'displayHeaderRight',
                'displaySlideshow',
                'topNavigation',
				'displayMainmenu',
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
                }
            }

            return true;
        }


    /**
     * @see Module::uninstall()
     */
    public function uninstall() {
 
        if ( parent::uninstall() ) {
            $res = true;
            
            return $res;
        }
        return false;
    }

    /**
     * Creates tables
     */
    protected function createTables() {
        $res = 1;
        //include_once( dirname(__FILE__) . '/install/install.php' );
        return $res;
    }

    /**
     * render content info
     */
    public function getContent() {

        $this->_html .= $this->headerHTML();
        $this->_html .= '<h2>' . $this->displayName . '.</h2>';
        
        /* update tree megamenu positions */
        if( Tools::getValue('doupdatepos') && Tools::isSubmit('updatePosition') ){
            $list = Tools::getValue('list');
            $root = 1;
            $child = array();
            foreach( $list as $id => $parentId ){
                if( $parentId <=0 ){
                    $parentId = $root;
                }
                $child[$parentId][] = $id;
            }
            $res = true;
            foreach ($child as $id_parent => $menus ){
                $i = 0;
                foreach( $menus as $id_ptsmegamenu ){
                    $res &= Db::getInstance()->execute('
                        UPDATE `'._DB_PREFIX_.'ptsmegamenu` SET `position` = '.(int)$i.', id_parent = '.(int)$id_parent.' 
                        WHERE `id_ptsmegamenu` = '.(int)$id_ptsmegamenu
                    );
                    $i++;
                }
            }

            $this->clearCache(); 
            die( $this->l('Update Positions Done') );
        }
        /* delete megamenu item */
        if( Tools::getValue('dodel') ){
            $obj = new Btmegamenu((int) Tools::getValue('id_ptsmegamenu'));
            $res = $obj->delete();
            $this->clearCache(); 
           Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
        }
        if ( Tools::isSubmit('save'.$this->name) &&  Tools::isSubmit('active') ){ 
            if ($id_ptsmegamenu = Tools::getValue('id_ptsmegamenu')) {
                $megamenu = new Btmegamenu((int)$id_ptsmegamenu);
            } else {
                $megamenu = new Btmegamenu();
            }   
                    
            $megamenu->copyFromPost();
            $megamenu->id_shop = $this->context->shop->id;
            
            if( $megamenu->type && $megamenu->type !="html" && Tools::getValue($megamenu->type."_type") ){
                $megamenu->item = Tools::getValue( $megamenu->type."_type" );
            }
            if ($megamenu->validateFields(false) && $megamenu->validateFieldsLang(false)) {
                
                $megamenu->save();
                
                if ( isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name']) ) {

                    if ($error = ImageManager::validateUpload($_FILES['image']))
                        return false;
                    elseif (!($tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS')) || !move_uploaded_file($_FILES['image']['tmp_name'], $tmpName))
                        return false;
                    elseif (!ImageManager::resize($tmpName, dirname(__FILE__).'/img/'.$_FILES['image']['name']) )
                        return false;
                    unlink($tmpName);
                    $megamenu->image = $_FILES['image']['name'] ;
                    $megamenu->save();
                }else if(Tools::getIsset("delete_icon")){
                    if($megamenu->image){
                        unlink(dirname(__FILE__).'/img/'.$megamenu->image);
                        $megamenu->image = "";
                        $megamenu->save();
                    }
                } 

                $this->clearCache();

				Tools::redirectAdmin(AdminController::$currentIndex. '&configure=ptsmegamenu&save'.$this->name.'&token='.Tools::getValue('token').'&id_ptsmegamenu='.$megamenu->id);
            }else {
                $this->_html .= '<div class="conf error alert alert-warning">'.$this->l('An error occurred while attempting to save.').'</div>';
            }
        }

        
        return $this->_displayForm();
         
    }
		
	public function hookDisplayHeader(){   
		$this->context->controller->addCSS( $this->_path . 'ptsmegamenu.css', 'all' );
	}
    /**
     * show megamenu item configuration.
     */
    protected function _showFormSetting(){
        
        $this->context->controller->addJS( __PS_BASE_URI__.'modules/ptsmegamenu/assets/admin/jquery.nestable.js' ); 
        $this->context->controller->addJS( __PS_BASE_URI__.'modules/ptsmegamenu/assets/admin/form.js' ); 
    
        $this->context->controller->addJS( __PS_BASE_URI__.'js/jquery/plugins/jquery.cookie-plugin.js' ); 
        $this->context->controller->addJS( __PS_BASE_URI__.'js/jquery/ui/jquery.ui.tabs.min.js' ); 
        $this->context->controller->addCss( __PS_BASE_URI__.'js/jquery/ui/themes/base/jquery.ui.tabs.css' ); 
        $this->context->controller->addCss( __PS_BASE_URI__.'modules/ptsmegamenu/assets/admin/form.css' ); 

        $action_widget = $this->base_config_url.'&widgets=1';
        
        $this->widget->loadEngines();
        $widget        = $this->widget;
        
        $id_lang       = $this->context->language->id;
        $id_ptsmegamenu = (int) (Tools::getValue('id_ptsmegamenu'));
        $obj           = new Btmegamenu($id_ptsmegamenu);
        $tree          = $obj->getTree();
        $categories    = PtsMegamenuHelper::getCategories();
        $manufacturers = Manufacturer::getManufacturers(false, $id_lang, true);
        $suppliers     = Supplier::getSuppliers(false, $id_lang, true);
        $cmss          = CMS::listCms($this->context->language->id, false, true);
        $menus         = $obj->getDropdown(null, $obj->id_parent);
 
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

         $soption = array(
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
        );

        $this->fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Create New MegaMenu Item.'),
            ),
            'input' => array(
                 array(
                    'type'  => 'hidden',
                    'label' => $this->l('Megamenu ID'),
                    'name'  => 'id_ptsmegamenu',
                    'default'=> 0,
                ),
                array(
                    'type'  => 'text',
                    'label' => $this->l('Title:'),
                    'name'  => 'title',
                    'value' => true,
                    'lang'  => true,
                    'default'=> '',
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Sub Title:'),
                    'lang' => true,
                    'name' => 'text',
                    'cols' => 40,
                    'rows' => 10,
                    'default'=> '',
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l( 'Parent ID' ),
                    'name' => 'id_parent',
                    'options' => array(  'query' =>   $menus,
                    'id' => 'id',
                    'name' => 'title' ),
                    'default' => "url",
         
                 ),
                 array(
                    'type' => 'switch',
                    'label' => $this->l( 'Is Active' ),
                    'name' => 'active',
                    'values' => $soption,
                    'default' => "1",

                 ),
                array(
                    'type' => 'switch',
                    'label' => $this->l( 'Show Title' ),
                    'name' => 'show_title',
                    'values' => $soption,
                    'default' => "1",
    
                 ),
                 array(
                    'type' => 'select',
                    'label' => $this->l( 'Menu Type' ),
                    'name' => 'type',
                    'id'    => 'menu_type',
                    'desc' => $this->l('Select a menu link type and fill data for following input'),
                    'options' => array(  'query' => array(
                        array('id' => 'url', 'name' => $this->l('Url')),
                        array('id' => 'category', 'name' => $this->l('Category')),
                        array('id' => 'product', 'name' => $this->l('Product')),
                        array('id' => 'manufacture', 'name' => $this->l('Manufacture')),
                        array('id' => 'supplier', 'name' => $this->l('Supplier')),
                        array('id' => 'cms', 'name' => $this->l('Cms')),
                        array('id' => 'html', 'name' => $this->l('Html'))

                    ),
                     'id' => 'id',
                    'name' => 'name' ),
                    'default' => "url",
         
                 ),
            
                array(
                    'type' => 'text',
                    'label' => $this->l( 'Product ID' ),
                    'name' => 'product_type',
                    'id' => 'product_type',
                    'class'=> 'menu-type-group',
                    'default' => "",
                ),

                array(
                    'type' => 'select',
                    'label' => $this->l( 'CMS Type' ),
                    'name' => 'cms_type',
                    'id'   => 'cms_type',
                    'options' => array(  'query' => $cmss,
                    'id' => 'id_cms',
                    'name' => 'meta_title' ),
                    'default' => "",
                    'class'=> 'menu-type-group', 
                ),

                array(
                    'type' => 'text',
                    'label' => $this->l( 'URL' ),
                    'name' => 'url',
                    'id' => 'url_type',
                    'class'=> 'menu-type-group',
                    'default' => "",
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l( 'Category Type' ),
                    'name' => 'category_type',
                    'id'   => 'category_type',
                    'options' => array(  'query' => $categories,
                    'id' => 'id_category',
                    'name' => 'name' ),
                    'default' => "",
                    'class'=> 'menu-type-group', 
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l( 'Manufacture Type' ),
                    'name' => 'manufacture_type',
                    'id' => 'manufacture_type',
                    'options' => array(  'query' => $manufacturers,
                     'id' => 'id_manufacturer',
                    'name' => 'name' ),
                    'default' => "",
                    'class'=> 'menu-type-group', 
                ),
                 array(
                    'type' => 'select',
                    'label' => $this->l( 'Supplier Type' ),
                    'name' => 'supplier_type',
                    'id' => 'supplier_type',
                    'options' => array(  'query' => $suppliers,
                    'id' => 'id_supplier',
                    'name' => 'name' ),
                    'default' => "",
                    'class'=> 'menu-type-group', 
                ),

                array(
                    'type' => 'textarea',
                    'label' => $this->l('HTML Type'),
                    'name' => 'content_text',
                    'lang' => true,
                    'default' => '',
                    'autoload_rte' => true,
                    'class'=> 'menu-type-group-lang', 
                ),
                 
                array(
                    'type' => 'select',
                    'label' => $this->l( 'Target Open' ),
                    'name' => 'target',
                    'options' => array(  'query' => array(
                        array('id' => '_self', 'name' => $this->l('Self')),
                        array('id' => '_blank', 'name' => $this->l('Blank')),
                        array('id' => '_parent', 'name' => $this->l('Parent')),
                        array('id' => '_top', 'name' => $this->l('Top'))
                    ),
                    'id' => 'id',
                    'name' => 'name' ),
                    'default' => "_self",
                 ),

                array(
                    'type' => 'text',
                    'label' => $this->l('Menu Class'),
                    'name' => 'menu_class',
                    'display_image' => true,
                    'default' => ''
                ),

                array(
                    'type' => 'text',
                    'label' => $this->l('Menu Icon Class'),
                    'name' => 'icon_class',
                    'display_image' => true,
                    'default' => '',
                    'desc' => $this->l( 'The module integrated with FontAwesome' ).'. '
                             . $this->l('Check list of icons and class name in here')
                             . ' <a href="http://fontawesome.io/" target="_blank">http://fontawesome.io/</a> or your icon class' 
                ),
                array(
                    'type' => 'file',
                    'label' => $this->l('Or Menu Icon Image'),
                    'name' => 'image',
                    'display_image' => true,
                    'default' => '',
                    'desc' => $this->l('Use image icon if no use con Class'),
                    'thumb' =>  '',
                    'title'=> $this->l('Icon Preview'),
                ),
                
                 
                 array(
                    'type' => 'select',
                    'label' => $this->l( 'Sub Menu Type' ),
                    'name' => 'type_submenu',
                    'options' => array(  'query' => array(
                        array('id' => 'menu', 'name' => $this->l('Menu')),
                        array('id' => 'html', 'name' => $this->l('HTML'))
                    ),
                    'id' => 'id',
                    'name' => 'name' ),
                    'default' => "menu",
                    'desc'=> $this->l('Submenu will be showed if select option Menu')
                 ),
                
                 array(
                    'type'  => 'textarea',
                    'label' => $this->l('Sub Menu Content:'),
                    'name'  => 'submenu_content_text',
                    'value' => true,
                    'lang'  => true,
                    'default'=> '',
                    'autoload_rte' => true,
                ),

            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button btn btn-danger'
            )
        );


        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->identifier = $this->identifier;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        foreach (Language::getLanguages(false) as $lang)
            $helper->languages[] = array(
                'id_lang' => $lang['id_lang'],
                'iso_code' => $lang['iso_code'],
                'name' => $lang['name'],
                'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0)
            );

        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;
        $helper->toolbar_scroll = true;
        $helper->title = $this->displayName;
        $helper->submit_action = 'save'.$this->name;
        $helper->tpl_vars = array(
                'fields_value' => $this->getConfigFieldsValues( $obj ),
                'languages' => $this->context->controller->getLanguages(),
                'id_language' => $this->context->language->id
        );  
        $liveeditorURL = AdminController::$currentIndex.'&configure='.$this->name.'&liveeditor=1&token='.Tools::getAdminTokenLite('AdminModules'); 

        $action = AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules');
        $helper->toolbar_btn =  array(
        /*    'ssave' =>
            array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
            ),*/
            'back' =>
            array(
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            )
        );
        
            $html = $this->_html.'<div class="col-lg-12"> <div class="alert alert-info clearfix"><div class="pull-right">Using <a href="'.$liveeditorURL.'" class="btn btn-danger"> '
             . $this->l('Live Megamenu Editor').'</a> '.$this->l('To Make Rich Content For Megamenu').'</div></div></div>';
        
        $output = $html .  '
                 <ul class="nav nav-tabs clearfix" id="myTab">
                  <li class="active"><a href="#megamenu" data-toggle="tab">'.$this->l('Megamenu').'</a></li>
                  <li><a href="#widgets" data-toggle="tab">'.$this->l('Widgets').'</a></li>
                </ul>

 
            <div class="tab-content clearfix">
              <div class="tab-pane active" id="megamenu">
        ';
		$addnew = AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules').'&configure='.$this->name.'&tab_module=front_office_features&module_name='.$this->name;
        $output .= '<div class="col-md-4"><div class="panel panel-default"><h3 class="panel-title">'.$this->l('Tree Megamenu Management').'</h3>'
                . '<div class="panel-content"><div class="alert alert-warning">'. $this->l('To sort orders or update parent-child, you drap and drop expected menu, then click to Update button to Save').'</div>'
				 . '<hr>
					<p>
                    <div class="pull-right">
                    <input type="button" value="'.$this->l('New Category').'" id="addcategory" data-loading-text="'.$this->l('Processing ...').'" class="btn btn-default " name="addcategory">
                     <a href="'.$liveeditorURL.'" class="btn btn-danger"> '
             . $this->l('Editor').'</a> </div>
                    <input type="button" value="'.$this->l('Update Positions').'" id="serialize" data-loading-text="'.$this->l('Processing ...').'" class="btn btn-primary" name="serialize"></p><hr>'.$tree.'<p><input type="button" value="'.$this->l('Update Positions').'" id="serialize-tree" data-loading-text="'.$this->l('Processing ...').'" class="btn btn-primary" name="serialize"></p></div></div></div>'
                . '<div class="col-md-8">'.$helper->generateForm( $this->fields_form ).'</div>'
                . '<script type="text/javascript">var addnew ="'.$addnew.'"; var action="'.$action.'";$("#content").PavMegaMenuList({action:action,addnew:addnew});</script>';
        $output .= '</div>';         

        $output .= '  <div class="tab-pane" id="widgets">

                <div>
                    <p><a href="'.AdminController::$currentIndex.'&configure='.$this->name."&widgets=1".'&token='.Tools::getAdminTokenLite('AdminModules').'" class="btn btn-info pts-modal-action btn btn-modeal btn-success btn-action">'.$this->l( 'Create Widget' ).'</a></p>
                </div>
        '.$this->widgetsList().'</div>';
        $output .= '</div><script>$(\'#myTab a[href="#profile"]\').tab(\'show\')</script>';
        return $output;        
    }

    /**
     *  Generate widget list.
     */
    public function widgetsList(){
        $fields_list = array(
            'id_widget' => array(
                'title' => $this->l('Id'),
                'width' => 120,
                'type' => 'text',
            ),
            'name' => array(
                'title' => $this->l('Widget Name'),
                'width' => 140,
                'type' => 'text',
                'filter_key' => 'a!name'
            ),
        );

        

        $helper = new HelperList();
        $helper->shopLinkType = '';
        $helper->simple_header = true;
        $helper->identifier = 'id_widget';
        $helper->actions = array('edit', 'delete');
        $helper->show_toolbar = true;
        $helper->imageType = 'jpg';
        $helper->toolbar_btn['new'] =  array(
            'href' => AdminController::$currentIndex.'&configure='.$this->name.'&add'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules')."&widgets=1",
            'desc' => $this->l('Add new')
        );
		
        $helper->title = $this->displayName;
        $helper->table = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name."&widgets=1";
        $this->widget->loadEngines();
        $widgets = $this->widget->getWidgets();

        return $helper->generateList( $widgets, $fields_list);
               
    }

    /**
     * Asign value for each input of Data form
     */
    public function getConfigFieldsValues( $obj ) {      
        $languages = Language::getLanguages(false);
        $fields_values = array();
        $a = array();

        foreach(  $this->fields_form as $k=> $f ){ 
            foreach( $f['form']['input']  as $j=> $input ){
               
                if( isset($obj->{trim($input['name'])}) ){
                    $data = $obj->{trim($input['name'])};  
                    
                    if( $input['name'] == 'image' &&  $data  ){ 
                        $thumb = __PS_BASE_URI__.'modules/'.$this->name.'/img/'. $data;   
                        $this->fields_form[$k]['form']['input'][$j]['thumb'] =  $thumb; 
                    }

                    if( isset($input['lang']) ) {
                        foreach ( $languages as $lang ){
                            $fields_values[$input['name']][$lang['id_lang']] = isset($data[$lang['id_lang']]) ? $data[$lang['id_lang']] : $input['default'];
                        }
                    }else {
                        $fields_values[$input['name']] = isset($data) ? $data : $input['default'];
                    }           
                }else{
                  if( isset($input['lang']) ) {
                       foreach ($languages as $lang){
                            $v = Tools::getValue( 'title', Configuration::get($input['name'], $lang['id_lang']) );
                            $fields_values[$input['name']][$lang['id_lang']] = $v ? $v : $input['default'];
                        }
                    }else {
                        $v = Tools::getValue( $input['name'], Configuration::get( $input['name']) );
                        $fields_values[$input['name']] =$v?$v:$input['default'];
                    } 

                    if( $input['name'] == $obj->type."_type" ){
                        $fields_values[$input['name']] = $obj->item;
                    }
                } 
            }   
        }
        
        return $fields_values;
    }

    /**
     * render menu tree using for editing
     */
    protected function ajxgenmenu(){  

        $parent                 = '1';
        $params = array('params'=>array() );
        /* unset mega menu configuration */
        if( Tools::getValue('doreset') ){  
            Configuration::updateValue('PTS_MEGAMENU_PARAMS', '' );
            $this->clearCache(); 
        }

        $params['params']  =  Configuration::get('PTS_MEGAMENU_PARAMS');
        
        if( isset($params['params']) && !empty($params['params']) ){
             $params['params'] = json_decode( $params['params'] );
        }

        $obj = new Btmegamenu($parent);
        $tree = $obj->getFrontTree(1, true, $params['params'] );


          echo ' <div class="navbar navbar-default">
                    <nav id="mainmenutop" class="megamenu" role="navigation">
                        <div class="navbar-header">
                        <div class="collapse navbar-collapse navbar-ex1-collapse">
                                '. $tree.'
                         </div></div>
                    </nav>
            </div>';

      
    }

    /**
     * Ajax Menu Information Action
     */
    public function ajxmenuinfo(){
        if( Tools::getValue('params')  ){
            $params = trim(html_entity_decode( Tools::getValue('params') )  ); 
            $a = json_decode(($params));
            Configuration::updateValue('PTS_MEGAMENU_PARAMS', $params, true );
            $this->clearCache();  
        }
        return $this->ajxgenmenu();
        
    }

    /**
     * show live editor tools 
     */
    protected function _showLiveEditorSetting(){


        $this->context->controller->addJS( __PS_BASE_URI__.'js/jquery/ui/jquery.ui.dialog.min.js' ); 
        $this->context->controller->addJS( __PS_BASE_URI__.'js/jquery/ui/jquery.ui.draggable.min.js' ); 
        $this->context->controller->addJS( __PS_BASE_URI__.'js/jquery/ui/jquery.ui.droppable.min.js' ); 

         $this->context->controller->addJS( __PS_BASE_URI__.'modules/ptsmegamenu/assets/admin/form.js' ); 
        $this->context->controller->addJS( __PS_BASE_URI__.'modules/ptsmegamenu/assets/bootstrap/js/bootstrap.js' ); 
        $this->context->controller->addCss( __PS_BASE_URI__.'modules/ptsmegamenu/assets/bootstrap/css/bootstrap.css' );

        $this->context->controller->addCss( __PS_BASE_URI__.'modules/ptsmegamenu/assets/admin/liveeditor.css' ); 
        $this->context->controller->addJS( __PS_BASE_URI__.'modules/ptsmegamenu/assets/admin/liveeditor.js' ); 
        $this->context->controller->addCss( __PS_BASE_URI__.'modules/ptsmegamenu/assets/admin/widget.css' ); 

        $tcss = _PS_ROOT_DIR_.'/themes/'.$this->context->shop->getTheme().'/css/modules/ptsmegamenu/ptsmegamenu.css';
      
        if( file_exists($tcss) ){  
            $this->context->controller->addCss( _THEMES_DIR_.$this->context->shop->getTheme().'/css/modules/ptsmegamenu/ptsmegamenu.css' ); 
        }else {
            $this->context->controller->addCss( __PS_BASE_URI__.'modules/ptsmegamenu/ptsmegamenu.css' ); 
        } 
        $live_site_url = __PS_BASE_URI__;

        $liveedit_action  = $this->base_config_url.'&liveeditor=1&do=livesave' ; 
        $action_backlink  = $this->base_config_url;  
        //$action_widget    = __PS_BASE_URI__.'index.php?fc=module&module=ptsmegamenu&controller=widget';
        //$action_widget    = Context::getContext()->link->getModuleLink($this->name, 'widget', array(), null, null, $this->context->shop->id) . "&secure_key=" . $this->secure_key;
		$action_widget 		= _MODULE_DIR_.$this->name.'/widget.php';
		$action_addwidget = $this->base_config_url.'&liveeditor=1&do=addwidget';  
        $ajxgenmenu       = $this->base_config_url.'&liveeditor=1&do=ajxgenmenu'; 
        $ajxmenuinfo      = $this->base_config_url.'&liveeditor=1&do=ajxmenuinfo'; 

        $model = $this->widget;
        $widgets = $model->getWidgets();
        $model->loadEngines();

        ob_start();
        require_once ( dirname(__FILE__) . '/liveeditor.php' );
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    /**
     *
     */
    public function _showWidgetsSetting(){
        global $currentIndex;


        $this->context->controller->addCss( __PS_BASE_URI__.'modules/ptsmegamenu/assets/admin/widget.css' ); 
        
        if( Tools::isSubmit('deleteptsmegamenu') && Tools::getValue('id_widget') ){ 
            $model = new PtsMegamenuWidget( Tools::getValue('id_widget') );
            $model->deleteItem( Tools::getValue('id_widget') ); 
            
             $this->clearCache();

            Tools::redirectAdmin( $this->base_config_url ); 
        }
        $warning = '';
        $disabled        = false;
        $form            = '';
        $widget_selected = '';
        $id              = (int)Tools::getValue('id_widget') ;
        $key              = (int)Tools::getValue('key') ;

        $fb_widget_action  = $this->base_config_url.'&widgets=1&wtype='.Tools::getValue('wtype');
		
        
        if( Tools::getValue('key_widget') ){
              $key  =  Tools::getValue('key_widget');
        } 

        if(Tools::getValue('id_widget')) {
			$model = new PtsMegamenuWidget( $id );
		} else {
			$model =   $this->widget;
        }    
       
            
		$model->loadEngines();		
        $model->id_shop = Context::getContext()->shop->id;

        $types = $model->getTypes();
        $resulHtml = array("error"=>"","confirm"=>"");
     
        if( Tools::isSubmit('widgets') && Tools::isSubmit('saveptsmegamenu') 
            && Tools::isSubmit('widget_name') && Tools::isSubmit('widget_type')
            && Tools::getValue('widget_type')
            && Tools::getValue('widget_name')  ){

            foreach( $_POST as $key => $value ){
                $_POST[$key] = str_replace( '"', "'", str_replace("\n\r", " ",trim($value)) ); 
            }
 
            $data = array(
                'id'     => $id ,
                'params' => base64_encode(serialize($_POST)),
                'type'   => Tools::getValue('widget_type'),
                'name'   =>Tools::getValue('widget_name')
            );  
            
            foreach($data as $k=>$v)
                $model->{$k} = $v;
            if($model->id){
                if($model->update()){
                    $url = $this->base_config_url.'&widgets=1&id_widget='.Tools::getValue('id_widget').'&updateptsmegamenu';
                    Tools::redirectAdmin($url);
                    $resulHtml["confirm"]  = $this->l('Save Widget Setting, Done');
                }
                else
                    $resulHtml["error"] = $this->l('Can not update widget');
            }else{
                $model->key_widget = time();
                if($model->add()){
                    $url = $this->base_config_url.'&widgets=1&id_widget='.Tools::getValue('id_widget').'&updateptsmegamenu';
                    Tools::redirectAdmin($url);
                    $resulHtml["confirm"]  = $this->l('Add New Widget, Done');
                }
                else   
                    $resulHtml["error"] = $this->l('Can not add new widget');
            }
            $id   = $model->id;
            $this->clearCache();
        } else { 
         //   $warning = $this->l( 'Could not save widget data, please fill and re-correct all information in input fields.' );
        }  
        if( $key ){
            $widget_data = $model->getWidetByKey( $key );
        }else {
            $widget_data = $model->getWidetById( $id );
        }
         
        $id = (int)$widget_data['id']; 
        $widget_selected = array();
        $widget_selected =  trim(strtolower( Tools::getValue('wtype') )); 
        if( $widget_data['type']){
            $widget_selected = $widget_data['type'];
            $disabled=true;
        }

 
        $form = $model->getForm( $widget_selected, $widget_data );
            
        $this->context->smarty->assign('resulHtml',  $resulHtml );
        $this->context->smarty->assign('form',  $form );
        $this->context->smarty->assign('types',  $types );
        $this->context->smarty->assign('widget_selected',  $widget_selected );
        $this->context->smarty->assign('fb_widget_action',  $fb_widget_action );

        $this->context->smarty->assign( 'backtolist_action', $this->base_config_url.'&widgets=1' );


        return $this->display(__FILE__, 'views/templates/admin/widget.tpl');
    }

    /**
     * render widgets
     */
    public function renderwidget(){  
        $widgets = Tools::getValue('widgets');
        $widgets = explode( '|wid-', '|'.$widgets );

        if( !empty($widgets) ){
            unset( $widgets[0] );
            $model = new PtsMegamenuWidget();
            $model->setTheme( Context::getContext()->shop->getTheme());
            $model->langID =  $this->context->language->id;
            $model->loadWidgets();
            $model->loadEngines();
            $output = '';

            foreach( $widgets as $wid ){
                $content = $model->renderContent( $wid );
                $output .= $this->getWidgetContent($wid, $content['type'], $content['data'] );
            }

            echo $output;
        }
        die;
    }


    public function renderWidgetButton(){
        $widgets = Tools::getValue('widgets');
        $widgets = explode( '|wid-', '|'.$widgets );

        if( !empty($widgets) ){
            unset( $widgets[0] );
            $model = new PtsMegamenuWidget();
            $model->setTheme( Context::getContext()->shop->getTheme());
            $model->langID =  $this->context->language->id;
            $model->loadWidgets();
            $model->loadEngines();
            $output = '';

            foreach( $widgets as $wid ){
                $content = $model->renderContent( $wid );

                 
                if( $content && $info = $model->getWidgetInfo( $content['type'] ) ) {
                    $output .= '<div class="pts-widget"><div class="widget-inner wpo-wg-button">';
                    $output .= '<div class="widget-title"><div class="wpo-wicon wpo-icon-'.$content['type'].'"></div>'.$info['label'].'</div>';
                    $output .= '<div class="widget-desc"><i>'.($content['data']['widget_name']?$content['data']['widget_name']:$info['explain']).'</i></div>';
                    $output .= '</div></div>';
                }   
            }

            echo $output;
        }
        die; 
    }
    /**
     *
     */
    public function getWidgetContent( $id, $type, $data ){
        $output = '';
		if($type){
            $data['id_lang'] =   $this->context->language->id;

            $this->smarty->assign( $data );  
            $output = '<div class="pts-widget" id="wid-'.$id.'-'.rand().'">';
                $output .= $this->display(__FILE__, 'views/widgets/widget_'.$type.'.tpl' );
            $output .= '</div>';
        }
        return $output;

    }

    /**
     *
     */
    private function _displayForm() {
        if( Tools::getValue("liveeditor") ){
 
            if( Tools::getValue("do") ){
                switch ( Tools::getValue("do") ) {
                    case 'ajxmenuinfo':
                       echo $this->ajxmenuinfo();
                        break;
                    case 'ajxgenmenu':
                    case 'ajxgenmenu':
                        echo $this->ajxgenmenu();

                        break; 
                    case 'renderwidget':
                        $this->renderwidget();

                    default:
                    
                        break;
                }
                die;
            }else { 
               return $this->_showLiveEditorSetting(); 
            }
        }else if( Tools::getValue("widgets") ) {
            return $this->_showWidgetsSetting( );   
        }else {
           return $this->_showFormSetting();      
        }
    }

    /**
     *
     */
    private function _postProcess() {
        $errors = array();
         
 
    }

     
    public function hookDisplayHeaderRight() {
        return $this->hookDisplayTop();
    }

    public function hookDisplaySlideshow() {
        return $this->hookDisplayTop();
    }
	public function hookDisplayMainmenu(){
		return $this->hookDisplayTop();
	}
    public function hookTopNavigation() {
        return $this->hookDisplayTop();
    }

    public function hookDisplayPromoteTop() {
        return $this->hookDisplayTop();
    }

    public function hookDisplayBottom() {
        return $this->hookDisplayTop();
    }

    public function hookDisplayContentBottom() {
        return $this->hookDisplayTop();
    }

    public function hookRightColumn() {
        return $this->hookDisplayTop();
    }

	public function hookLeftColumn() {
        return $this->hookDisplayTop();
    }

	public function hookdisplayHome() {
        return $this->hookDisplayTop();
    }

    function hookFooter() {
        return $this->hookDisplayTop();
    }

    /**
     * Display Bootstrap MegaMenu
     */
    public function hookDisplayTop() {

   
        $cacheId = $this->getCacheId() ;
        $tpl = 'megamenu.tpl';
		
	
        if (!$this->isCached( 'megamenu.tpl', $cacheId) ){
	
            
            $params = array();
			// echo  $this->_path . 'ptsmegamenu.css';die; 
            $params['params']  =  Configuration::get('PTS_MEGAMENU_PARAMS' );
            
            
          
            $menu_config = array();
      
            if( isset($params['params']) && !empty($params['params']) ){
                 $params['params'] = json_decode( $params['params'] );
            }
            
            $obj = new Btmegamenu();
            $obj->setModule( $this );
            $ptsmegamenu = $obj->getFrontTree(1, false, $params['params'] );

            $this->smarty->assign( 'ptsmegamenu', $ptsmegamenu );
        }    
        
        return $this->display( __FILE__, $tpl, $cacheId );
    }

    public function hookActionObjectLanguageAddAfter($params) {
        $id_lang_default = Configuration::get('PS_LANG_DEFAULT');
        $id_lang_current = $params['object']->id;
        $obj = new PtsMegamenuWidget();
        $widgets = $obj->getWidgets();

        if($widgets) {
            foreach ($widgets as $key => $value) {
                $param = unserialize( base64_decode($value['params']) );
                
                if($param) {
                    foreach ($param as $k => $p) {
                        $arrs = explode('_', $k);
                        $end = end($arrs);
                        $new = array_pop($arrs);
                        if($end == $id_lang_default){
                            $param[implode('_', $arrs).'_'.$id_lang_current] = $p;
                        }
                    }
                    $post = array(
                        'id' => $value['id_widget'],
                        'params' => $param,
                        'type' => $value['type'],
                        'name' => $value['name'],
                    );
                    $obj->saveData($post);
                }
                
            }
        }
    }

    protected function getCacheId($name = null, $hook = '') {
        $cache_array = array(
            $name !== null ? $name : $this->name,
            $hook,
            date('Ymd'),
            (int) Tools::usingSecureMode(),
            (int) $this->context->shop->id,
            (int) Group::getCurrent()->id,
            (int) $this->context->language->id,
            (int) $this->context->currency->id,
            (int) $this->context->country->id,
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443)
        );
        return implode('|', $cache_array);
    }
    
    public function _clearBLHLCache() { 
        $this->_clearCache( '*' );
    }
    
    public function clearCache(){ 
        $this->_clearBLHLCache(  );
    }

    /**
     *
     */
    public function headerHTML() {
        if (Tools::getValue('controller') != 'AdminModules' && Tools::getValue('configure') != $this->name)
            return;
        $this->context->controller->addJqueryUI('ui.sortable');
        /* Style & js for fieldset 'slides configuration' */
        $html = '
		';
        return $html;
    }

}