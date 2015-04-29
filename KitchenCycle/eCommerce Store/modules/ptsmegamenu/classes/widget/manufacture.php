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

class PtsMegamenuWidgetManufacture extends PtsMegamenuWidgetBase {

		public $name = 'Manufacture';

		
		public function getWidgetInfo(){
			return  array('label' => $this->l('Manufacture Logos'), 'explain' => 'Manufacture Logo' ) ;
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
	                    'label' => $this->l('Limit'),
	                    'name'  => 'limit',
	                    'default'=> 10,
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
			
			global $link; 

			$t  = array(
				'name'=> '',
				'html'   => '',
			);
			$setting = array_merge( $t, $setting );

			$data = Manufacturer::getManufacturers(false, 0, true, 1, $setting['limit']);

			foreach ($data as $key => $item) {
				
				$item['image'] = (!file_exists(_PS_MANU_IMG_DIR_.$item['id_manufacturer'].'-'.ImageType::getFormatedName('medium').'.jpg')) ?Context::getContext()->language->iso_code.'-default' : $item['id_manufacturer'];
				
				$data[$key] = $item;
			}
		


			$setting['manufacturers'] = $data; 
			$setting['link'] = $link; 
			$output = array('type'=>'manufacture','data' => $setting );

			return $output;
		} 

	}
?>