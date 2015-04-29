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

class PtsMegamenuWidgetRaw_html extends PtsMegamenuWidgetBase {

		public $name = 'raw_html';

		
		public function getWidgetInfo(){
			return array('label' => $this->l('Raw HTML'), 'explain' => 'Put Raw HTML Code' );
		}


		public function renderForm( $args, $data ){
			$helper = $this->getFormHelper();

			$this->fields_form[1]['form'] = array(
	            'legend' => array(
	                'title' => $this->l('Widget Form.'),
	            ),
	            'input' => array(
 
	                array(
	                    'type' => 'textarea',
	                    'label' => $this->l('Content'),
	                    'name' => 'raw_html',
	                    'cols' => 40,
	                    'rows' => 10,
	                    'value' => true,
	    
	                    'default'=> '',
	                    'autoload_rte' => false,
	                    'desc'	=> 'Enter HTML CODE in here'
	                ),
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
				'name'=> '',
				'raw_html'   => '',
			);

			$setting = array_merge( $t, $setting );
			$html =  $setting['raw_html'];
			
	 		$html = html_entity_decode( $html, ENT_QUOTES, 'UTF-8' );
			$header= '';
			$content = $html;

			$output = array('type'=>'raw_html','data' => $setting );
	  		return $output;
		}
	}
?>