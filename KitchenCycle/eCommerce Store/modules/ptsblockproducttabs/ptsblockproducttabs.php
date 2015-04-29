<?php
/**
 * Pts Prestashop Theme Framework for Prestashop 1.6.x
 *
 * @package   ptsblockproducttabs
 * @version   2.0
 * @author    http://www.prestabrain.com
 * @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
 *               <info@prestabrain.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

if (!defined('_PS_VERSION_'))
    exit;

class PtsBlockProductTabs extends Module {

	private $_prefix;
    private $_fields_form = array();

    public function __construct() {
    	$this->name = 'ptsblockproducttabs';
        $this->tab = 'pricing_promotion';
        $this->version = '2.0';
        $this->author = 'PrestaBrain';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();
        $this->_prefix = 'ptsprotab';

        $this->displayName = $this->l('Pts Product Tabs Block');
        $this->description = $this->l('Adds a block with current product specials powered by leo framework 2.0.');
    }

    public function install() {
    	if( !parent::install()
    		|| !$this->registerHook('displayHome')
    		|| !$this->registerHook('header') )
    		return false;
    	$this->_clearBLCCache();

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
    		|| !$this->unregisterHook('displayHome')
    		|| !$this->unregisterHook('header') )
    		return false;

    	$this->makeFormConfig();
    	$this->deleteConfigs();
    	$this->_clearBLCCache();
    	return true;
    }

    public function getContent() {
    	$output = '<h2>' . $this->displayName . '</h2>';
    	if ( Tools::isSubmit('submitPtsBlockProductTabs') && Tools::isSubmit($this->renderName('items_tab')) ) {

            $this->makeFormConfig();
            $this->batchUpdateConfigs();

            $this->_clearCache('ptsblockproducttabs.tpl');
            $output .= $this->displayConfirmation($this->l('Settings updated successfully.'));
            $this->_clearBLCCache();

        }
        return $output . $this->renderForm();
    }

    public function makeFormConfig() {
    	if( $this->_fields_form ){
            return ;
        }

    	$fields_form = array(
            'form' => array(
	            'legend' => array(
	                'title' => $this->l('Settings'),
	                'icon' => 'icon-cogs'
	            ),

	            'input' => array(
	                array(
	                	'type'  => 'text',
		                'label' => $this->l('Number of Items In Page'),
		                'name'  => $this->renderName( 'items_page' ),
		                'desc'  => $this->l('The maximum number of products in each page tab (default: 3).'),
		                'default' => '3'
	                ),

	                array(
		                'type'  => 'text',
		                'label' => $this->l('Number of Columns In Page'),
		                'name'  => $this->renderName( 'columns_page' ),
		                'desc'  => $this->l('The maximum number of columns in each page tab (default: 3).'),
		                'default' => '3'
	                ),

	              	array(
		                'type'  => 'text',
		                'label' => $this->l('Number of products displayed In Tab'),
		                'name'  => $this->renderName( 'items_tab' ),
		                'desc'  => $this->l('The maximum number of products in each page tab (default: 6).'),
		                'default' => '6'
	              	),
                    
                    array(
		                'type' => 'switch',
		                'label' => $this->l('All Products Tab'),
		                'name' => $this->renderName( 'all' ),
		                'desc' => $this->l('Show all products of all tabs in this tab.'),
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
		                'default' => '0'
	              	),
                    
              		array(
		                'type' => 'switch',
		                'label' => $this->l('Special Tab'),
		                'name' => $this->renderName( 'specials_display' ),
		                'desc' => $this->l('Show the block even if no product is available.'),
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
		                'default' => '1'	
	              	),

	              	array(
		                'type' => 'switch',
		                'label' => $this->l('BestSeller Tab'),
		                'name' => $this->renderName( 'bestseller' ),
		                'desc' => $this->l('Show the block even if no product is available.'),
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
		                'default' => '1'
	              	),

	              	array(
		                'type' => 'switch',
		                'label' => $this->l('Featured Tab'),
		                'name' => $this->renderName( 'featured' ),
		                'desc' => $this->l('Show the block even if no product is available.'),
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
		                'default' => '1'
	              	),

	              	array(
		                'type' => 'switch',
		                'label' => $this->l('New Arrials Tab'),
		                'name' => $this->renderName( 'newarrials' ),
		                'desc' => $this->l('Show the block even if no product is available.'),
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
		                'default' => '0'
	              	),

	              	array(
		                'type' => 'switch',
		                'label' => $this->l('Top Rating'),
		                'name' => $this->renderName( 'toprating' ),
		                'desc' => $this->l('Show the block even if no product is available.'),
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
		                'default' => '0'
	              	),
                    
	              	array(
		                'type'  => 'text',
		                'label' => $this->l('Interval'),
		                'name'  => $this->renderName( 'interval' ),
		                'desc'  => $this->l('Enter Time(miniseconds) to play carousel. Value 0 to stop.'),
		                'default' => '8000'
	              	),

	            ),

	            'submit' => array(
	              'title' => $this->l('Save'),
	              'class' => 'btn btn-default')
	        ),
		);

		$this->_fields_form[] = $fields_form;
		
    }

    public function renderForm() {
    	$this->makeFormConfig();

    	$helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table =  $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPtsBlockProductTabs';
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
                } else {
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

    public function hookDisplayHome($params) {
        return $this->hookRightColumn($params);
    }

    public function hookDisplaySlideshow($params) {
        return $this->hookRightColumn($params);
    }

    public function hookDisplayPromoteTop($params) {
        return $this->hookRightColumn($params);
    }

    public function hookDisplayBottom($params) {
        return $this->hookRightColumn($params);
    }

    public function hookDisplayContentBottom($params) {
        return $this->hookRightColumn($params);
    }

    public function hookDisplayMassBottom($params) {
        return $this->hookRightColumn($params);
    }

    public function hookRightColumn($params) {
        if (!$this->isCached('ptsblockproducttabs.tpl', $this->getCacheId())) {
            $special = array();
            $bestseller = array();
            $featured = array();
            $newProducts = array();
            $toprating = array();
            $allproducts = array();



            $category = new Category(Context::getContext()->shop->getCategory(), (int) Context::getContext()->language->id);

            $nb = (int) $this->getConfigValue('items_tab',6);

            if ( Configuration::get($this->renderName('featured')) ) {
                $featured = $category->getProducts((int) Context::getContext()->language->id, 1, $nb);
                Hook::exec('actionProductListModifier', array(
                    'cat_products' => &$featured,
                ));
            }
            if ( Configuration::get($this->renderName('newarrials')) ) {
                $newProducts = Product::getNewProducts((int) ($params['cookie']->id_lang), 0, $nb);
                Hook::exec('actionProductListModifier', array(
                    'cat_products' => &$newProducts,
                ));
            }
            if ( Configuration::get($this->renderName('specials_display')) ) {
                $special = Product::getPricesDrop((int) ($params['cookie']->id_lang), 0, $nb);
                Hook::exec('actionProductListModifier', array(
                    'cat_products' => &$special,
                ));
            }
            if (Configuration::get($this->renderName('bestseller'))) {
                $bestseller = ProductSale::getBestSales((int) ($params['cookie']->id_lang), 0, $nb, 'sales', 'DESC');
                Hook::exec('actionProductListModifier', array(
                    'cat_products' => &$bestseller,
                ));
            }
            if (Configuration::get($this->renderName('toprating'))) {
                $obj = Module::getInstanceByName('productcomments');
                if(Validate::isLoadedObject($obj) && $obj->active && $obj->id){
                    $toprating = $this->getProducts( 0, $nb );
                    Hook::exec('actionProductListModifier', array(
                        'cat_products' => &$toprating,
                    ));
                }
            }
            if (Configuration::get($this->renderName('all'))) {
                $allproducts = $this->array_interlace($featured, $newProducts, $special, $bestseller, $toprating);
            }

            $items_page = (int) $this->getConfigValue( 'items_page', 3 );
            $columns_page = (int) $this->getConfigValue( 'columns_page', 3 );
            $interval = (int) $this->getConfigValue( 'interval', 8000 );

            $dir = dirname(__FILE__) . "/products.tpl";
            $tdir = _PS_ALL_THEMES_DIR_ . _THEME_NAME_ . '/modules/' . $this->name . '/products.tpl';

            if (file_exists($tdir)) {
                $dir = $tdir;
            }

            $this->smarty->assign(array(
                'itemsperpage' => $items_page,
                'columnspage' => $columns_page,
                'product_tpl' => $dir,
                'special' => $special,
                'bestseller' => $bestseller,
                'featured' => $featured,
                'newproducts' => $newProducts,
                'toprating' => $toprating,
                'allproducts' => $allproducts,
                'scolumn' => 12 / $columns_page,
                'interval'  => $interval
            ));
        }
        return $this->display(__FILE__, 'ptsblockproducttabs.tpl', $this->getCacheId());
    }

    public function hookLeftColumn($params) {
        return $this->hookRightColumn($params);
    }

    public function hookHeader($params) {
        $this->context->controller->addCSS(($this->_path) . 'ptsblockproducttabs.css', 'all');
    }
    
    public function array_interlace() {
        $args = func_get_args();
        $total = count($args);
        if($total < 2) {
            return false;
        }
        $arr = array();
        foreach($args as $arg) {
            if($arg)
                foreach($arg as $v) {
                    $arr[$v['id_product']] = $v;
                }
        }

        ksort($arr);
        return array_values($arr);
    }

    public static function getProducts($p = 1, $n, $active = true, Context $context = null)
    {
        if (!$context)
            $context = Context::getContext();
        $id_lang = $context->language->id;

        $front = true;
        if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
            $front = false;

        if ($p < 1) $p = 1;

        $id_supplier = (int)Tools::getValue('id_supplier');

        $sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, MAX(product_attribute_shop.id_product_attribute) id_product_attribute, product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`, pl.`description_short`, pl.`available_now`,
                pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, MAX(image_shop.`id_image`) id_image,
                il.`legend`, m.`name` AS manufacturer_name, cl.`name` AS category_default,
                DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
                INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).'
                    DAY)) > 0 AS new, product_shop.price AS orderprice, AVG(pc.grade) as avg_grade
            FROM `'._DB_PREFIX_.'category_product` cp
            LEFT JOIN `'._DB_PREFIX_.'product` p
                ON p.`id_product` = cp.`id_product`
            '.Shop::addSqlAssociation('product', 'p').'
            LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
            ON (p.`id_product` = pa.`id_product`)
            '.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
            '.Product::sqlStock('p', 'product_attribute_shop', false, $context->shop).'
            LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
                ON (product_shop.`id_category_default` = cl.`id_category`
                AND cl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('cl').')
            LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
                ON (p.`id_product` = pl.`id_product`
                AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').')
            LEFT JOIN `'._DB_PREFIX_.'image` i
                ON (i.`id_product` = p.`id_product`)'.
            Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
            LEFT JOIN `'._DB_PREFIX_.'image_lang` il
                ON (image_shop.`id_image` = il.`id_image`
                AND il.`id_lang` = '.(int)$id_lang.')
            LEFT JOIN `'._DB_PREFIX_.'manufacturer` m
                ON m.`id_manufacturer` = p.`id_manufacturer`
            JOIN `'._DB_PREFIX_.'product_comment` pc ON (cp.id_product = pc.id_product)
            
            WHERE product_shop.`id_shop` = '.(int)$context->shop->id
            .($active ? ' AND product_shop.`active` = 1' : '')
            .($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '')
            .($id_supplier ? ' AND p.id_supplier = '.(int)$id_supplier : '')
            .' GROUP BY product_shop.id_product';

        $sql .= ' ORDER BY avg_grade DESC ';
        $sql .=' LIMIT '.(((int)$p - 1) * (int)$n).','.(int)$n;
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (!$result)
            return array();
        /* Modify SQL result */
        return Product::getProductsProperties($id_lang, $result);
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
            (int) $this->context->country->id
        );
        return implode('|', $cache_array);
    }

    public function _clearBLCCache(){
        $this->_clearCache('ptsblockproducttabs.tpl');
        $this->_clearCache('products.tpl');
    }
    public function hookAddProduct($params) {
        $this->_clearBLCCache();
    }

    public function hookUpdateProduct($params) {
        $this->_clearBLCCache();
    }

    public function hookDeleteProduct($params) {
        $this->_clearBLCCache();
    }

}