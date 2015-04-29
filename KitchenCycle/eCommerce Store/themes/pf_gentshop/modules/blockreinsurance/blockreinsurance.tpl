{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $infos|@count > 0}
<!-- MODULE Block reinsurance -->
<div id="reinsurance_block" class="block-module-ptsreassurances">
	<div class="row block-outer">	
		{foreach from=$infos item=info}
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 column">
				<img src="{$link->getMediaLink("`$module_dir`img/`$info.file_name|escape:'htmlall':'UTF-8'`")}" alt="{$info.text|escape:html:'UTF-8'}" /> 
				<div class="reassurances-center" data-original-title="" title="">
					<span>{$info.text|escape:html:'UTF-8'}</span>
				</div> 
			</div>                        
		{/foreach}
	</ul>
</div>
<!-- /MODULE Block reinsurance -->
{/if}


