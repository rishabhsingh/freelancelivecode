{*
* 2007-2012 PrestaShop
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
*  @copyright  2007-2012 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<!-- MODULE Block ptsblockrelatedproducts -->
{if $products|@count gt 0 }
<div id="relatedproducts" class="block products_block exclusive ptsblockrelatedproducts carousel">
		<h4 class="title_block">{$products|@count} {l s='other products in the same category' mod='ptsblockrelatedproducts'}</h4>
		<div class="block_content">	
			{if !empty($products )}
				{$tabname="ptsblockrelatedproducts"}
				{include file="$tpl_dir./sub/products_module.tpl" modulename='ptsblockrelatedproducts'}
			{/if}
		</div>
</div>
{/if}
<!-- /MODULE Block ptsblockrelatedproducts -->
<script>
$(document).ready(function() {
    $('{$tabname}').each(function(){
        $(this).carousel({
            pause: true,
            interval: {$interval}
        });
    });
	 
});
</script>
 