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

class PtsMegamenuWidgetNewsletter extends PtsMegamenuWidgetBase {

		public $name = 'map';

		
		public function getWidgetInfo(){
			return array('label' => $this->l('Newsletter Form'), 'explain' => 'Create Newsletter Form Working With Newsletter Block Of Prestashop.' );
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
	                    'label' => $this->l('Css Class'),
	                    'name'  => 'class',
	                    'default'=> "pts-newsletter",
	                ),
	                array(
	                    'type' => 'textarea',
	                    'label' => $this->l('Information'),
	                    'name' => 'information',
	                    'cols' => 20,
	                    'rows' => 10,
	                    'value' => true,
	                    'lang'  => true,
	                    'default'=> 'Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!',
	                    'autoload_rte' => true,
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

		public function renderContent( $args, $setting ){
			$t = array(
				'class' => "pts-newsletter",
			);
			$setting = array_merge( $t, $setting );

			
			$languageID = Context::getContext()->language->id;	
			$setting['information']= isset($setting['information_'.$languageID])?html_entity_decode($setting['information_'.$languageID],ENT_QUOTES,'UTF-8'): "";

			 
 
			$output = array('type'=>'newsletter','data' => $setting );

			return $output;
		}

	}
?>