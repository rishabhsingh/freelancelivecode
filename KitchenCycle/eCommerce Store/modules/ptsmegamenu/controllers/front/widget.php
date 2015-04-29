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

class PtsMegaMenuWidgetModuleFrontController extends ModuleFrontController
{
	public $php_self ;
	public function init() {
		parent::init();

		  require_once( $this->module->getLocalPath().'ptsmegamenu.php' );
	}

	public function initContent()
	{
		$this->php_self = 'widget';
		parent::initContent();

 			$module = new PtsMegaMenu();

			echo $module->renderwidget();
		  die;
	}
}
?>