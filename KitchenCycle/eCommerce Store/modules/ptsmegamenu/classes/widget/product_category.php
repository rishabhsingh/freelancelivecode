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

class PtsMegamenuWidgetProduct_category extends PtsMegamenuWidgetBase {

		public $name = 'product_category';

		
		public function getWidgetInfo(){
			return array('label' => $this->l('Products By Category ID'), 'explain' => 'Created Product List From Category ID' );
		}


		public function renderForm( $args, $data ){

			$helper = $this->getFormHelper();
 			$this->fields_form[1]['form'] = array(
	            'input' => array(
	            	array(
						'type'  => 'categories',
						'label' => $this->l('Parent category'),
						'name'  => 'id_parent'
					)
	            )
	        );
 			$fields_value = $this->getConfigFieldsValues( $data  );
	 		$selected_categories = array((isset($fields_value['id_parent']) && $fields_value['id_parent']) ? $fields_value['id_parent'] : 0);
			
			$this->fields_form[1]['form'] = array(
	            'legend' => array(
	                'title' => $this->l('Widget Form.'),
	            ),
	            'input' => array(
	                array(
						'type'  => 'categories',
						'label' => $this->l('Parent category'),
						'name'  => 'id_parent',
						'tree'  => array(
							'id'                  => 'categories-tree',
							'selected_categories' => $selected_categories,
							'disabled_categories' => null
						)
					),
	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Limit'),
	                    'name'  => 'limit',
	                    'default'=> 6,
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

		public function renderContent(  $args, $setting ){
			$t  = array(
				'id_parent'=> '',
				'limit'   => '12',
				'image_width'=>'200',
				'image_height' =>'200',
			);
			$setting = array_merge( $t, $setting );
			$nb = (int)$setting['limit'];


			$category = new Category( $setting['id_parent'], $this->langID );
			$products = $category->getProducts((int)$this->langID, 1, ($nb ? $nb : 8));

			$setting['products'] = $products;
			$output = array('type'=>'product_category','data' => $setting );
	 
			return $output;

		 
		}	
	}
?>