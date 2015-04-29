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

<!-- MODULE Block specials -->
<div id="ptsproducttabs" class="box producttabs block products_block exclusive blockptsproducttabs clearfix">

	<div class="tab-nav">
			<ul id="productTabs" class="nav nav-theme">
                            {if $allproducts}	
              <li class="active"><a href="#taballproductsproducts" data-toggle="tab">{l s='All' mod='ptsblockproducttabs'}</a></li>
			  {/if}
			  {if $special}	
              <li><a href="#tabspecial" data-toggle="tab">{l s='Special' mod='ptsblockproducttabs'}</a></li>
			  {/if}
               {if $newproducts}	
              <li><a href="#tabnewproducts" data-toggle="tab">{l s='New Arrivals' mod='ptsblockproducttabs'}</a></li>
			  {/if}
			  {if $bestseller}	
              <li><a href="#tabbestseller" data-toggle="tab">{l s='Best Seller' mod='ptsblockproducttabs'}</a></li>
			  {/if}
			  {if $featured}	
              <li><a href="#tabfeaturedproducts" data-toggle="tab">{l s='Featured Products' mod='ptsblockproducttabs'}</a></li>
			  {/if}
			  {if $toprating}	
              <li><a href="#tabtopratingproducts" data-toggle="tab">{l s='Top Rating' mod='ptsblockproducttabs'}</a></li>
			  {/if}
			  
            </ul>
        </div>
			
            <div id="product_tab_content"><div class="product_tab_content tab-content">
                    {if $allproducts}		  
              <div class="tab-pane active" id="taballproductsproducts">
					{$products=$allproducts} {$tabname='taballproductsproducts-carousel'}
					{include file="$tpl_dir./sub/products_module.tpl" modulename='ptsblockproducttabs'}
              </div>   
                        {/if}	
			   {if $special}	
					<div class="tab-pane" id="tabspecial">
					{$products=$special}{$tabname='tabspecialcarousel'}
					{include file="$tpl_dir./sub/products_module.tpl" modulename='ptsblockproducttabs'}
	              </div>
			   {/if}
			  {if $newproducts}		  
              <div class="tab-pane" id="tabnewproducts">
					{$products=$newproducts} {$tabname='tabnewproducts-carousel'}
					{include file="$tpl_dir./sub/products_module.tpl" modulename='ptsblockproducttabs'}
              </div>   
			 {/if}	
			 {if $bestseller}		  
              <div class="tab-pane" id="tabbestseller">
					{$products=$bestseller} {$tabname='tabbestseller-carousel'}
					{include file="$tpl_dir./sub/products_module.tpl" modulename='ptsblockproducttabs'}
              </div>   
			 {/if}	
			 {if $featured}		  
              <div class="tab-pane" id="tabfeaturedproducts">
					{$products=$featured} {$tabname='tabfeaturedproducts-carousel'}
					{include file="$tpl_dir./sub/products_module.tpl" modulename='ptsblockproducttabs'}
              </div>   
			  {/if}	
			 {if $toprating}		  
              <div class="tab-pane" id="tabtopratingproducts">
					{$products=$toprating} {$tabname='tabtopratingproducts-carousel'}
					{include file="$tpl_dir./sub/products_module.tpl" modulename='ptsblockproducttabs'}
              </div>   
			  {/if}	
			 
			 
			</div></div>
     
</div>
<!-- /MODULE Block specials -->
<script>
$(document).ready(function() {
    $('#ptsproducttabs .carousel').each(function(){
        $(this).carousel({
            pause: 'hover',
            interval: {$interval}
        });
    });
 	
	$("#ptsproducttabs .nav-tabs li", this).first().addClass("active");
	$("#ptsproducttabs .tab-content .tab-pane", this).first().addClass("active");
 
});
</script>
 