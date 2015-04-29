<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class PtsBlockManufacturer extends Module {

	private $_prefix;
	private $_fields_form = array();
	
    public function __construct()
    {
    	$this->name = 'ptsblockmanufacturer';
    	$this->tab  = 'front_office_features';
    	$this->version = 1.1;
		$this->author = 'PrestaBrain';
		$this->need_instance = 0;

        $this->bootstrap = true;
		parent::__construct();
        $this->_prefix = 'pts_manuf';	

		$this->displayName = $this->l('Pts Manufacturers block');
        $this->description = $this->l('Displays a block listing product manufacturers and/or brands.');
    }

    public function install() {
		$this->checkOwnerHooks();
        if( !parent::install()
            || !$this->registerHook('header')
            || !$this->registerHook('displayBottom')
            || !$this->registerHook('actionObjectManufacturerDeleteAfter')
            || !$this->registerHook('actionObjectManufacturerAddAfter')
            || !$this->registerHook('actionObjectManufacturerUpdateAfter') )
            return false;
        $this->clearCache();
        return true;
    }

     private function checkOwnerHooks()
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
            }
        }

        return true;
    }
    
    public function uninstall() {
        if( !parent::uninstall()
            || !$this->unregisterHook('header')
            || !$this->unregisterHook('displayBottom')
            || !$this->unregisterHook('actionObjectManufacturerDeleteAfter')
            || !$this->unregisterHook('actionObjectManufacturerAddAfter')
            || !$this->unregisterHook('actionObjectManufacturerUpdateAfter') )
            return false;

        $this->makeFormConfigs();
        $this->deleteConfigs();
        $this->clearCache();
        return true;
    }

    public function getContent() {
        $_html = '<h2>' . $this->displayName . '</h2>';
        
        if( Tools::isSubmit('submitPtsBlockManufacturer') ){

            $this->makeFormConfigs();
            $this->batchUpdateConfigs();

            $this->clearCache();
            $_html .= $this->displayConfirmation($this->l('Settings updated successfully.'));
        }

        return $_html . $this->renderForm();
    }

    public function makeFormConfigs() {
        if( $this->_fields_form ){
            return ;
        }

        $imagesTypes = ImageType::getImagesTypes('manufacturers');

        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),

                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Colums In Tab.'),
                        'name' => $this->renderName('col'),
                        'desc' => $this->l('The maximum column items  in tab.'),
                        'default' => 3
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Manufacturers Per Page:'),
                        'name' => $this->renderName('page'),
                        'desc' => $this->l('The maximum number of manufacturers displayed in this block.'),
                        'required' => true,
                        'default' => 6,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show title:'),
                        'name' => $this->renderName('active_title'),
                        'is_bool' => true,
                        'desc' => 'Display or none display Module title.',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                        'default' => 0,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Auto play:'),
                        'name' => $this->renderName('active_play'),
                        'is_bool' => true,
                        'desc' => 'For carousel.',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                        'default' => 0,
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Shipping method:'),
                        'desc' => $this->l('Type image'),
                        'name' => $this->renderName('type_img'),
                        'required' => true,
                        'options' => array(
                            'query' => $imagesTypes,
                            'id' => 'name',
                            'name' => 'name',
                        ),
                        'default' => 'pf_manufacturer',
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Interval .'),
                        'name' => $this->renderName('intv'),
                        'desc' => $this->l('Enter Time(miniseconds) to play carousel. Value 1 to stop.'),
                        'default' => 8000
                    ),
                ),

                'submit' => array(
                    'title' => $this->l('Save'),
                    'class' => 'btn btn-default'
                )
            ),
        );
        $this->_fields_form[] = $fields_form;
    }

    public function renderForm() {
        $this->makeFormConfigs();

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table =  $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPtsBlockManufacturer';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $helper->generateForm( ($this->_fields_form) );
    }

    public function getConfigFieldsValues() {
        $fields_values = array();

        foreach ( $this->_fields_form as $f ) {
            foreach ( $f['form']['input'] as $input ) {
                if( isset($input['lang']) ) {
                    foreach ( $this->languages() as $lang ) {
                        $values = Tools::getValue( $input['name'].'_'.$lang['id_lang'], ( Configuration::hasKey($input['name']) ? Configuration::get($input['name'], $lang['id_lang']) : $input['default'] ) );
                        $fields_values[$input['name']][$lang['id_lang']] = $values;
                    }
                }else {
                    $values = Tools::getValue( $input['name'], ( Configuration::hasKey($input['name']) ? Configuration::get($input['name']) : $input['default'] ) );
                    $fields_values[$input['name']] = $values;
                }
            }
        }
    
        return $fields_values;
    }

    public function batchUpdateConfigs() {

        foreach ( $this->_fields_form as $f ) {
            foreach ( $f['form']['input'] as $input ) {
                if( isset($input['lang']) ) {
                    $data = array();
                    foreach ( $this->languages() as $lang ) {
                        $val = Tools::getValue( $input['name'].'_'.$lang['id_lang'], $input['default'] );
                        $data[$lang['id_lang']] = $val;
                    }
                    Configuration::updateValue( trim($input['name']), $data );
                }else { 
                    $val = Tools::getValue( $input['name'], $input['default'] );
                    Configuration::updateValue( $input['name'], $val );
                }
            }
        }

    }

    public function deleteConfigs() {

        foreach ( $this->_fields_form as $f ) {
            foreach ( $f['form']['input'] as $input ) {
                if( isset($input['lang']) ) {
                    foreach ( $this->languages() as $lang ) {
                        Configuration::deleteByName( $input['name'].'_'.$lang['id_lang'] );
                    }
                }else {
                    Configuration::deleteByName( $input['name'] );
                }
            }
        }

    }

    public function getConfigValue( $key, $value=null ){
      return( Configuration::hasKey( $this->renderName($key) )?Configuration::get($this->renderName($key)) : $value );
    }

    public function renderName($name){
        return Tools::strtoupper($this->_prefix.'_'.$name);
    }

    public function languages(){
        return Language::getLanguages(false);
    }

     public function processHook(  ){
        if (!$this->isCached('ptsblockmanufacturer.tpl', $this->getCacheId())){
            $this->site_url = Tools::htmlentitiesutf8('http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__);


            
            $manuf_page   = $this->getConfigValue( 'page', 6 );
            $manuf_cols   = $this->getConfigValue( 'col', 3 );
            $show_title   = $this->getConfigValue( 'active_title',1 );
            $auto_play    = $this->getConfigValue( 'active_play',0 );
            $image_types  = $this->getConfigValue( 'type_img', 'pf_manufacturer' );
            $interval     = $this->getConfigValue( 'intv', 8000 );

         
            if( !$auto_play ){
                $interval  = 'false';
            }
            $manufacturers = Manufacturer::getManufacturers( false,$this->context->language->id, true );
            //echo '<pre>'.print_r($manufacturers,1);die;
            $id_manufacturers = array();
            foreach($manufacturers as $m){
                $id_manufacturers[] = $m['id_manufacturer'];
            }
            $manufs = array();
            foreach($id_manufacturers as $id_manufacturer){
                $manufacturer = new Manufacturer($id_manufacturer,$this->context->language->id);
                if(Validate::isLoadedObject($manufacturer)){
                    $manufs[$id_manufacturer]['link'] = $this->context->link->getManufacturerLink($id_manufacturer,$manufacturer->link_rewrite, $this->context->language->id);
                    $manufs[$id_manufacturer]['id_manufacturer'] = $id_manufacturer;
                    $manufs[$id_manufacturer]['name'] = $manufacturer->name;
                    $manufs[$id_manufacturer]['linkIMG'] = _THEME_MANU_DIR_.$id_manufacturer.'-'.$image_types.'.jpg';
                }
            }

            $this->smarty->assign(
                array(
                    'manuf_page'       => $manuf_page,
                    'manuf_cols'       => $manuf_cols,
                    'scolumn'          => 12 / $manuf_cols,
                    'show_title'       => $show_title,
                    'auto_play'        => $auto_play,      
                    'ptsmanufacturers' => $manufs,
                    'interval'         => $interval,
                )
            );

        }

        return $this->display(__FILE__, 'ptsblockmanufacturer.tpl', $this->getCacheId());
    }

    public function hookdisplayHome($params)
    {
        if(!$this->processHook())
            return;

        return $this->display(__FILE__, 'ptsblockmanufacturer.tpl', $this->getCacheId());
    } 
	public function hookdisplayHeader($params){
		$this->context->controller->addCSS( ($this->_path).'assets/css/ptsblockmanufacturer.css', 'all');
	}
	public function hookdisplayFooter($params){
		return $this->hookdisplayHome($params);
	}
    public function hookdisplayTopColumn($params)
    {
        return $this->hookdisplayHome($params);
    }    
    public function hookdisplayFootertop($params){
		return $this->hookdisplayHome($params);
	}
	public function hookdisplayBottom($params){
		return $this->hookdisplayHome($params);
	}
	
    public function hookDisplayPromoteTop($params) {
        return $this->hookdisplayHome($params);
    }

    public function hookDisplayContentBottom($params) {
        return $this->hookdisplayHome($params);
    }

    public function clearCache() {
    	$this->_clearCache( 'ptsblockmanufacturer.tpl' );
    }


}