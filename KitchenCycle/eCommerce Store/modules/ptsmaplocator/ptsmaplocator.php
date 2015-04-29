<?php
/**
 * Pts Prestashop Theme Framework for Prestashop 1.6.x
 *
 * @package   ptsmaplocator
 * @version   1.0
 * @author    http://www.prestabrain.com
 * @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
 *               <info@prestabrain.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

if (!defined('_PS_VERSION_'))
	exit;

class PtsMapLocator extends Module
{
    protected $_prefix = 'PTSMAPL_';

	public function __construct()
	{
		$this->name             = 'ptsmaplocator';
		$this->tab              = 'front_office_features';
		$this->version          = '1.0';
        $this->author           = 'PrestaBrain';
		$this->bootstrap        = true;
        $this->secure_key       = Tools::encrypt($this->name);
		parent::__construct();	
        
		$this->displayName      = $this->l('Pts Map Locator');
		$this->description      = $this->l('Pts Map Locator supported by pts Framework 3.0');
	}
	
    public function getConfigValue( $name ){
        return Configuration::get( $this->getConfigName($name) );
    }

    public function getConfigName( $name ){
        return strtoupper( $this->_prefix.$name );
    }

	public function install()
	{
		if (!parent::install() ||            
            !$this->registerHook('displayHeader') ||
            !$this->registerHook('displayFooter') )
			return false; 
        
        $langs = Language::getLanguages(false);
        $des = array();
        foreach ($langs as $lang) {
            $des[$lang['id_lang']] = '';
        }
        Configuration::updateValue( $this->getConfigName("height"), 500 );        
        Configuration::updateValue( $this->getConfigName("description"), $des, true ); 
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
			'displayMapLocal',
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
    
    public function uninstall() 
    {
            if (!parent::uninstall())
                return false;  
            return true;
    }
    
    public function hookdisplayHeader($params)
    {
        $this->context->controller->addCss($this->_path.'views/css/styles.css', 'all');
        $str = '
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;language=en"></script>
            <script type="text/javascript" src="'.$this->_path.'views/js/gmap3.min.js"></script>
            <script type="text/javascript" src="'.$this->_path.'views/js/gmap3.infobox.js"></script>
        ';
        return $str;
    }
    
    public function hookDisplayTop()
    {
        return $this->hookDisplayHome();
    }
	public function hookDisplayMaplocal()
    {
        return $this->hookDisplayHome();
    }
    /***/
    public function hookDisplaySlideshow() 
    {
        return $this->hookDisplayHome();
    }

    public function hookDisplayPromoteTop() 
    {
        return $this->hookDisplayHome();
    }

    public function hookDisplayContentBottom() 
    {
        return $this->hookDisplayHome();
    }

    public function hookDisplayBottom() 
    {
        return $this->hookDisplayHome();
    }

    public function hookDisplayFooterTop() 
    {
        return $this->hookDisplayHome();
    }

    public function hookDisplayFooterBottom() 
    {
        return $this->hookDisplayHome();
    }

    public function hookDisplayLeftColumn() 
    {
        return $this->hookDisplayHome();
    }

    public function hookDisplayRightColumn() 
    {
        return $this->hookDisplayHome();
    }  

    public function hookDisplayFooter() 
    {
        return $this->hookDisplayHome();
    }  

    /***/
    public function hookDisplayHome() 
    {
        $stores = Db::getInstance()->executeS('
            SELECT s.*, cl.name country, st.iso_code state
            FROM '._DB_PREFIX_.'store s
            '.Shop::addSqlAssociation('store', 's').'
            LEFT JOIN '._DB_PREFIX_.'country_lang cl ON (cl.id_country = s.id_country)
            LEFT JOIN '._DB_PREFIX_.'state st ON (st.id_state = s.id_state)
            WHERE s.active = 1 AND cl.id_lang = '.(int)$this->context->language->id);
        
        foreach ($stores as &$store)
		{
			$store['has_picture'] = file_exists(_PS_STORE_IMG_DIR_.(int)($store['id_store']).'.jpg');
			$store['icon'] = '';
			if ($working_hours = $this->renderStoreWorkingHours($store))
				$store['working_hours'] = $working_hours;
		}
        
        $this->context->smarty->assign(array(
            'pts_stores' => $stores,
            'mod_id' => $this->id,
            'pts_height' => Configuration::get($this->getConfigName('height')),
            'pts_description' => Configuration::get($this->getConfigName('description'), $this->context->language->id),
        ));
        return $this->display(__FILE__, 'hook.tpl');
    }
    
    public function renderStoreWorkingHours($store)
	{
		$days[1] = 'Monday';
		$days[2] = 'Tuesday';
		$days[3] = 'Wednesday';
		$days[4] = 'Thursday';
		$days[5] = 'Friday';
		$days[6] = 'Saturday';
		$days[7] = 'Sunday';
		
		$days_datas = array();
		$hours = array_filter(unserialize($store['hours']));
		if (!empty($hours))
		{
			for ($i = 1; $i < 8; $i++)
			{
				if (isset($hours[(int)($i) - 1]))
				{
					$hours_datas = array();
					$hours_datas['hours'] = $hours[(int)($i) - 1];
					$hours_datas['day'] = $days[$i];
					$days_datas[] = $hours_datas;
				}
			}
			$this->context->smarty->assign('days_datas', $days_datas);
			$this->context->smarty->assign('id_country', $store['id_country']);
            $str = '';
            foreach ($days_datas as $one_day)
                $str .= "<p><strong class='dark'>".$this->l($one_day['day']).": </strong> &nbsp;<span>".$one_day['hours']."</span></p>";
            return $str;
		}
		return false;
	}
    
	public function getContent()
    {
        if (Tools::isSubmit('submitStoreConf')) {
            $langs = Language::getLanguages(false);
            $des = array();
            foreach ($langs as $lang) {
                $des[$lang['id_lang']] = Tools::getValue('description_'.$this->context->language->id);
            }
            Configuration::updateValue( $this->getConfigName("height"), (int)Tools::getValue("height") );        
            Configuration::updateValue( $this->getConfigName("description"), $des, true );                      
        }

        $html = $this->__renderForm();

        return $html;
    }

    public function __renderForm()
    {   
       
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                   array(
                    'type'  => 'textarea',
                    'label' => $this->l('Description:'),
                    'name'  => 'description',
                    'value' => true,
                    'lang'  => true,
                    'default'=> '',
                    'autoload_rte' => true,
                     ),
                   array(
                    'type'  => 'text',
                    'label' => $this->l('Height:'),
                    'name'  => 'height',
                    'default'=> '500'
                     ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
            ),
        );
        
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table =  $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitStoreConf';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->__getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $helper->generateForm(array($fields_form));
    }
    
    public function __getConfigFieldsValues()
    {
        $langs = Language::getLanguages(false);
        $des = array();
        foreach ($langs as $lang) {
            $des[$lang['id_lang']] = Configuration::get($this->getConfigName('description'), $this->context->language->id);
        }
        $data['description'] = $des;
        $data['height'] = Configuration::get($this->getConfigName('height'));
        return $data;
    }
    
}
