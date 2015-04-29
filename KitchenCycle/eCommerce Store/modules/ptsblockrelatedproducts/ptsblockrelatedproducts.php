<?php
/**
 * Pts Prestashop Theme Framework for Prestashop 1.6.x
 *
 * @package   ptsblockrelatedproducts
 * @version   2.0
 * @author    http://www.prestabrain.com
 * @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
 *               <info@prestabrain.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

if (!defined('_PS_VERSION_'))
	exit;

class PtsBlockRelatedProducts extends Module {

	private $_prefix;
	private $_fields_form = array();

	public function __construct()
	{
		$this->name = 'ptsblockrelatedproducts';
        $this->tab = 'front_office_features';
        $this->version = '1.1';
		$this->author = 'PrestaBrain';
		$this->need_instance = 0;
		$this->secure_key = Tools::encrypt($this->name);

		$this->bootstrap = true;
		parent::__construct();
		$this->_prefix = 'pts_relate_pro';
		
		$this->displayName = $this->l('Pts Related Products Block');
		$this->description = $this->l('Display Products In Same Category or Related by Tag.... in Carousel.');
	}

	public function install()
	{
		if( !parent::install() || !$this->registerHook('displayFooterProduct') || !$this->registerHook('header') )
			return false;

		$this->clearCache();
		return true;
	}

	public function uninstall() {
		if( !parent::uninstall() || !$this->unregisterHook('displayFooterProduct') || !$this->unregisterHook('header') )
			return false;
		$this->makeFormConfigs();
		$this->deleteConfigs();
		$this->clearCache();
		return true;
	}

	public function getContent() {
		$_html = '<h2>' . $this->displayName . '</h2>';

		if( Tools::isSubmit('submitPtsBlockRelatedProducts') )
		{
			$this->makeFormConfigs();
			$this->batchUpdateConfigs();

			$this->clearCache();
			$_html .= $this->displayConfirmation($this->l('Settings updated successfully.'));
		}

		return $_html . $this->renderForm();
	}

	public function makeFormConfigs()
	{
    	if($this->_fields_form)
    	{
            return ;
        }
        
        $orders = array(
            0 => array('value' => 'date_add', 'name' => $this->l('Date Add')),
            1 => array('value' => 'date_add DESC', 'name' => $this->l('Date Add DESC')),
            2 => array('value' => 'name', 'name' => $this->l('Name')),
            3 => array('value' => 'name DESC', 'name' => $this->l('Name DESC')),
            4 => array('value' => 'quantity', 'name' => $this->l('Quantity')),
            5 => array('value' => 'quantity DESC', 'name' => $this->l('Quantity DESC')),
            6 => array('value' => 'price', 'name' => $this->l('Price')),
            7 => array('value' => 'price DESC', 'name' => $this->l('Price DESC'))
        );

        $fields_form = array(
            'form' => array(
	            'legend' => array(
	                'title' => $this->l('Settings'),
	                'icon' => 'icon-cogs'
	            ),

	            'input' => array(
	            	array(
                        'type' => 'select',
                        'label' => $this->l('Order By:'),
                        'name' => $this->renderName('porder'),
                        'options' => array(
                            'query' => $orders,
                            'id' => 'value',
                            'name' => 'name'
                        ),
                        'default' => 'price',
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Items Per Page'),
                        'name' => $this->renderName('itemspage'),
                        'desc' => $this->l('The maximum number of products in each page tab (default: 4)'),
                        'default' => '4',
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Colums In Each Carousel'),
                        'name' => $this->renderName('columns'),
                        'desc' => $this->l('The maximum number of columns in each page tab (default: 4)'),
                        'default' => '4',
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Items In all Carousels'),
                        'name' => $this->renderName('itemstab'),
                        'desc' => $this->l('The maximum number of products in each Carousel (default: 8).'),
                        'default' => '8',
                    ),
	            ),

	            'submit' => array(
	              'title' => $this->l('Save'),
	              'class' => 'btn btn-default')
	        ),
		);

        $this->_fields_form[] = $fields_form;
    }

    public function renderForm()
    {
    	$this->makeFormConfigs();

    	$helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table =  $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPtsBlockRelatedProducts';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $helper->generateForm( ($this->_fields_form) );
    }

    public function getConfigFieldsValues()
    {
    	$fields_values = array();

        foreach ( $this->_fields_form as $f )
        {
            foreach ( $f['form']['input'] as $input )
            {
                if( isset($input['lang']) ) {
                    foreach ( $this->languages() as $lang )
                    {
                        $values = Tools::getValue( $input['name'].'_'.$lang['id_lang'], ( Configuration::hasKey($input['name']) ? Configuration::get($input['name'], $lang['id_lang']) : $input['default'] ) );
                        $fields_values[$input['name']][$lang['id_lang']] = $values;
                    }
                }
                else
                {
                    $values = Tools::getValue( $input['name'], ( Configuration::hasKey($input['name']) ? Configuration::get($input['name']) : $input['default'] ) );
                    $fields_values[$input['name']] = $values;
                }
            }
        }
    
        return $fields_values;
    }

    public function batchUpdateConfigs()
    {
        foreach ( $this->_fields_form as $f )
        {
            foreach ( $f['form']['input'] as $input )
            {
                if( isset($input['lang']) )
                {
                    $data = array();
                    foreach ( $this->languages() as $lang )
                    {
                        $val = Tools::getValue( $input['name'].'_'.$lang['id_lang'], $input['default'] );
                        $data[$lang['id_lang']] = $val;
                    }
                    Configuration::updateValue( trim($input['name']), $data );
                }
                else
                { 
                    $val = Tools::getValue( $input['name'], $input['default'] );
                    Configuration::updateValue( $input['name'], $val );
                }
            }
        }

    }

    public function deleteConfigs()
    {
        foreach ( $this->_fields_form as $f )
        {
            foreach ( $f['form']['input'] as $input )
            {
                if( isset($input['lang']) )
                {
                    foreach ( $this->languages() as $lang )
                    {
                        Configuration::deleteByName( $input['name'].'_'.$lang['id_lang'] );
                    }
                }
                else
                {
                    Configuration::deleteByName( $input['name'] );
                }
            }
        }

    }

    public function getConfigValue( $key, $value=null )
    {
      return( Configuration::hasKey( $this->renderName($key) )?Configuration::get($this->renderName($key)) : $value );
    }

    public function renderName($name)
    {
        return Tools::strtoupper($this->_prefix.'_'.$name);
    }

    public function languages()
    {
        return Language::getLanguages(false);
    }

    private function getCurrentProduct($products, $id_current)
	{
		if ($products)
			foreach ($products AS $key => $product)
				if ($product['id_product'] == $id_current)
					return $key;
		return false;
	}

	public function hookDisplayFooterProduct( $params )
	{
		return $this->displayRightColumnProduct( $params );
	}
	public function hookDisplayLeftColumnProduct( $params )
	{
		return $this->displayRightColumnProduct( $params );
	}

	public function displayRightColumnProduct( $params )
	{
		if (Tools::getValue('controller') != "product" )
			return ;

		$nb =  (int)$this->getConfigValue('itemstab');
		$porder = $this->getConfigValue('porder','date_add');
		$porder = preg_split("#\s+#",$porder);
		if( !isset($porder[1]) )
		{
			$porder[1] = null;
		}

		$dir = dirname(__FILE__)."/products.tpl";
		$tdir = _PS_ALL_THEMES_DIR_._THEME_NAME_.'/modules/'.$this->name.'/products.tpl';
	
		if( file_exists($tdir) )
		{
			$dir = $tdir;
		}

		$items_page = (int) $this->getConfigValue('itemspage', 4);
        $columns_page = (int) $this->getConfigValue('columns', 4);

        $idProduct = (int)(Tools::getValue('id_product'));
		$product = new Product((int)($idProduct));

		/* If the visitor has came to this product by a category, use this one */
		if (isset($params['category']->id_category))
			$category = $params['category'];
		/* Else, use the default product category */
		else
		{
			if (isset($product->id_category_default) AND $product->id_category_default > 1)
				$category = New Category((int)($product->id_category_default));
		}
		
		if (!Validate::isLoadedObject($category) OR !$category->active) 
			return;

		// Get infos
		$categoryProducts = $category->getProducts($this->context->language->id, 1, $nb, $porder[0], $porder[1] ); /* 100 products max. */
		$sizeOfCategoryProducts = (int)sizeof($categoryProducts);
		$middlePosition = 0;
		
		// Remove current product from the list
		if (is_array($categoryProducts) AND sizeof($categoryProducts))
		{
			foreach ($categoryProducts AS $key => $categoryProduct)
			{
				if ($categoryProduct['id_product'] == $idProduct)
				{
					unset($categoryProducts[$key]);
					break;
				}
			}	
		}
		Hook::exec('actionProductListModifier', array(
            'cat_products' => &$categoryProducts,
        ));
		
		$this->smarty->assign(array(
			'itemsperpage'=> $items_page,
			'columnspage' => $columns_page,
			'product_tpl' => $dir,
			'products'	 => $categoryProducts,
			'scolumn'     => 12/$columns_page,
			'homeSize'  => Image::getSize(ImageType::getFormatedName('home_default'))
		));
		return $this->display(__FILE__, 'ptsblockrelatedproducts.tpl');
	}

	public function hookHeader($params)
	{
		$this->context->controller->addCSS(($this->_path).'ptsblockrelatedproducts.css', 'all');
	}
	
	protected function getCacheId($name = null, $hook = '')
	{
		$cache_array = array(
			$name !== null ? $name : $this->name,
			$hook,
			date('Ymd'),
			(int)Tools::usingSecureMode(),
			(int)$this->context->shop->id,
			(int)Group::getCurrent()->id,
			(int)$this->context->language->id,
			(int)$this->context->currency->id,
			(int)$this->context->country->id
		);
		return implode('|', $cache_array);
	}

	public function clearCache()
	{
    	$this->_clearCache( 'ptsblockrelatedproducts.tpl' );
    }
}