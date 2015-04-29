{*
* Pts Prestashop Theme Framework for Prestashop 1.6.x
*
* @package   ptsblockrelatedproducts
* @version   5.0
* @author    http://www.prestabrain.com
* @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
*               <info@prestabrain.com>.All rights reserved.
* @license   GNU General Public License version 2
*}
{if $products|@count gt 0 }
<div id="relatedproducts" class="block products_block exclusive ptsblockrelatedproducts carousel">
		<h3>{$products|@count} {l s='other products in the same category' mod='ptsblockrelatedproducts'}</h3>
		<div class="block_content">	
			{if !empty($products )}
				{$tabname="ptsblockrelatedproducts"}
				{include file="{$product_tpl}"} 
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
 