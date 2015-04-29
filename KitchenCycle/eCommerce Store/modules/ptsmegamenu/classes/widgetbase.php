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

abstract class PtsMegamenuWidgetBase {
	

	public $modName = 'ptsmegamenu';
	
	public $name = 'base';

	public $id_shop = 0;

	public $fields_form = array();

	public $types = array();
	/**
	 * abstract method to return html widget form
	 */
	public function getWidgetInfo(){
		return array('key'=>'base','label'=>'Widget Base');
	}

	/**
	 * abstract method to return html widget form
	 */
	public function renderForm( $args, $data ){
		return ;
	}

	/**
	 * abstract method to return widget data 
	 */
	public function renderContent( $args, $data ){
		return ;
	}

	/**
	 * Get translation for a given module text
	 *
	 * Note: $specific parameter is mandatory for library files.
	 * Otherwise, translation key will not match for Module library
	 * when module is loaded with eval() Module::getModulesOnDisk()
	 *
	 * @param string $string String to translate
	 * @param boolean|string $specific filename to use in translation key
	 * @return string Translation
	 */
	public function l($string, $specific = false)
	{
		return Translate::getModuleTranslation( $this->modName, $string, ($specific) ? $specific : $this->modName);
	}

	/**
     * Asign value for each input of Data form
     */
    public function getConfigFieldsValues( $data=null ) {      
    
        $languages = Language::getLanguages(false);
        $fields_values = array();
        $obj = isset($data['params'])?$data['params']:array();

    
        foreach(  $this->fields_form as $k=> $f ){ 
            foreach( $f['form']['input']  as $j=> $input ){
        
               	if( isset($input['lang']) ) {
                    foreach ( $languages as $lang ){ 
                        $fields_values[$input['name']][$lang['id_lang']] = isset($obj[$input['name']."_".$lang['id_lang']]) ? $obj[$input['name']."_".$lang['id_lang']] : $input['default'];
                    }
                }else {
      
	                if( isset($obj[trim($input['name'])]) ){
	                    $value = $obj[trim($input['name'])];  
	          			
	                    if( $input['name'] == 'image' &&  $value  ){ 
	                        $thumb = __PS_BASE_URI__.'modules/'.$this->name.'/img/'. $value;   
	                        $this->fields_form[$k]['form']['input'][$j]['thumb'] =  $thumb; 
	                    }
	          			$fields_values[$input['name']] = $value;	
	                }else{
 
 	                    $v = Tools::getValue( $input['name'], Configuration::get( $input['name']) );
	                    $fields_values[$input['name']] =$v?$v:$input['default'];
 	 
	                } 
	            }    
            }   
        }
        if( isset($data['id_widget']) ){
        	$fields_values['id_widget'] =  $data['id_widget'];
        }
 		
        return $fields_values;
    }

    public function getFormHelper(){

    	$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
    	$action = AdminController::$currentIndex.'&configure='.$this->modName.'&save'.$this->modName.'&token='.Tools::getAdminTokenLite('AdminModules').'&widgets=1&rand='.rand().'&wtype='.Tools::getValue('wtype');
                  
    	$this->fields_form[0]['form'] = array(
	            'legend' => array(
	                'title' => $this->l('Widget Info.'),
	            ),
	            'input' => array(
	                
	                array(
	                    'type'  => 'hidden',
	                    'label' => $this->l('Megamenu ID'),
	                    'name'  => 'id_widget',
	                    'default'=> 0,
	                ),
	    
	                array(
	                    'type' => 'text',
	                    'label' => $this->l('Widget Name'),
	                    'name' => 'widget_name',
	                    'default'=> '',
	                    'desc' 	=> $this->l( 'Using for show in Listing Widget Management' )
 
	                ),
	                array(
	                    'type' => 'text',
	                    'label' => $this->l('Widget Title'),
	                    'name' => 'widget_title',
	                    'default'=> '',
	                    'lang'	=> true,
	                    'desc' 	=> $this->l( 'This tile will be showed as header of widget block. Empty to disable' )
 
	                ),
	                array(
	                    'type' => 'text',
	                    'label' => $this->l('Addition Class'),
	                    'name' => 'additionclss',
	                    'default'=> '',
	                    'lang'	=> true,
	                    'desc' 	=> $this->l( 'all your addition to make own style' )
 
	                ),
	                array(
	                    'type' 	  => 'hidden',
	                    'label'   => $this->l( 'Widget Type' ),
	                    'id'=> 'widget_type',
	                    'name' 	  => 'widget_type',
	                    'options' => array(  'query' => $this->types,
	                    'id' 	  => 'type',
	                    'name' 	  => 'label' ),
	                    'default' => Tools::getValue('wtype'),
	                    'desc'    => $this->l( 'Select a alert style' )
	                ),

	            ),
	      		 'submit' => array(
	                'title' => $this->l('Save'),
	                'class' => 'button'
           		 )
	        );

	    	$helper = new HelperForm();
	        $helper->module = $this;
	        $helper->name_controller = $this->modName;
	        $helper->identifier = $this->modName;
	        $helper->token = Tools::getAdminTokenLite('AdminModules');
	        foreach (Language::getLanguages(false) as $lang)
	            $helper->languages[] = array(
	                'id_lang' => $lang['id_lang'],
	                'iso_code' => $lang['iso_code'],
	                'name' => $lang['name'],
	                'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0)
	            );

	 		

	        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->modName.'&widgets=1&rand='.rand().'&wtype='.Tools::getValue('wtype');
	        $helper->default_form_language = $default_lang;
	        $helper->allow_employee_form_lang = $default_lang;
	        $helper->toolbar_scroll = true;
	        $helper->title = $this->modName;
	        $helper->submit_action = 'save'.$this->modName;
	        
	        $liveeditorURL = AdminController::$currentIndex.'&configure='.$this->modName.'&edit=1&token='.Tools::getAdminTokenLite('AdminModules'); 

	      
	        $helper->toolbar_btn =  array(
	            /*'save' =>
	            array(
	                'desc' => $this->l('Save'),
	                'href' => $action,
	            ),*/
	             'back' =>
	            array(
	                'desc' => $this->l('Back'),
	                'href' => AdminController::$currentIndex.'&configure='.$this->modName.'&save'.$this->modName.'&token='.Tools::getAdminTokenLite('AdminModules').'&widgets=1&rand='.rand(),
	            ),
	             
	        );

	        return $helper;
   		}

		 

	}
?>