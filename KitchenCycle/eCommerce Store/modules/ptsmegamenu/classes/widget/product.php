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

class PtsMegamenuWidgetProduct extends PtsMegamenuWidgetBase {

		public $name = 'product';

		
		public function getWidgetInfo(){
			return array('label' => $this->l('Product Item'), 'explain' => 'Product Item' );
		}


		public function renderForm( $args, $data ){
			$helper = $this->getFormHelper();
 

			$this->fields_form[1]['form'] = array(
	            'legend' => array(
	                'title' => $this->l('Widget Form.'),
	            ),
	            'input' => array(
	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Product ID'),
	                    'name'  => 'product_id',
	                    'default'=> 1,
	                )
	            ),
	      		 'submit' => array(
	                'title' => $this->l('Save'),
	                'class' => 'button'
           		 )
	        );

 
		 	$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
			
			$helper->tpl_vars = array(
	                'fields_value' => $this->getConfigFieldsValues( $data  ),
	                'languages' => Context::getContext()->controller->getLanguages(),
	                'id_language' => $default_lang
        	);  


			return  $helper->generateForm( $this->fields_form );

		}

		public function renderContent( $args, $setting ){
			$t = array(
				'product_id' => 0,
				'image_height' => '320',
				'image_width'	 =>  300
			);
			$setting = array_merge( $t, $setting );

			$id_lang = (int)$this->langID;
			$id_product = $setting['product_id'];

			$sql = 'SELECT p.*, product_shop.*, stock.`out_of_stock` out_of_stock, pl.`description`, pl.`description_short`,
						pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`,
						p.`ean13`, p.`upc`, MAX(image_shop.`id_image`) id_image, il.`legend`,
						DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
						INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).'
							DAY)) > 0 AS new
					FROM `'._DB_PREFIX_.'product` p
					LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (
						p.`id_product` = pl.`id_product`
						AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').'
					)
					'.Shop::addSqlAssociation('product', 'p').'
					LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`)'.
					Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
					LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang.')
					'.Product::sqlStock('p', 0).'
					WHERE p.id_product = '.(int)$id_product.'
					GROUP BY product_shop.id_product';

			$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
			if (!$row)
				return false;

			if (isset($row['id_product_attribute']) && $row['id_product_attribute'])
				$row['id_product_attribute'] = $row['id_product_attribute'];
			$p =  Product::getProductProperties($id_lang, $row);
			$setting['product'] = $p;

			$output = array('type'=>'product','data' => $setting );
			return $output;
		}

	}
?>