{*
* Pts Prestashop Theme Framework for Prestashop 1.6.x
*
* @package   ptsblockproducttabs
* @version   1.0
* @author    http://www.prestabrain.com
* @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
*               <info@prestabrain.com>.All rights reserved.
* @license   GNU General Public License version 2
*}
{if !empty($products)}
<div class="carousel slide" id="{$tabname}">
	 {if count($products)>$itemsperpage}	 
		
	 	<a class="carousel-control left" href="#{$tabname}"   data-slide="prev">&lsaquo;</a>
		<a class="carousel-control right" href="#{$tabname}"  data-slide="next">&rsaquo;</a>
	{/if}
	<div class="carousel-inner">
	{$mproducts=array_chunk($products,$itemsperpage)}
	{foreach from=$mproducts item=products name=mypLoop}
		<div class="item {if $smarty.foreach.mypLoop.first}active{/if}">
				{foreach from=$products item=product name=products}
				{if $product@iteration%$columnspage==1&&$columnspage>1}
				  <div class="row">
				{/if}
				<div class="col-xs-12 col-sm-6 col-md-{$scolumn} col-lg-{$scolumn} product_block ajax_block_product {if $smarty.foreach.products.first}first_item{elseif $smarty.foreach.products.last}last_item{/if}">
					<div class="product_container clearfix">
				 
							<div class="image">
								<a href="{$product.link|escape:'htmlall':'UTF-8'}" class="product_img_link product_image" title="{$product.name|escape:'htmlall':'UTF-8'}">						
									{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="on_sale product-label">{l s='On sale!' mod='ptsblockproducttabs'}</span>
								{elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="discount product-label">{l s='Reduced price!' mod='ptsblockproducttabs'}</span>{/if}
									<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')|escape:'html'}" alt="{$product.legend|escape:'htmlall':'UTF-8'}" class="img-responsive" />
									{if isset($product.new) && $product.new == 1}<span class="new product-label">{l s='New' mod='ptsblockproducttabs'}</span>{/if}
								</a>
							</div>
							<div class="product_meta">
								<h3 class="name">{if isset($product.pack_quantity) && $product.pack_quantity}{$product.pack_quantity|intval|cat:' x '}{/if}<a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|escape:'htmlall':'UTF-8'}">{$product.name|truncate:35:'...'|escape:'htmlall':'UTF-8'}</a></h3>
								
								<div class="description">{$product.description_short|strip_tags:'UTF-8'|truncate:360:'...'}</div>
								
								{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
									<div class="content_price">
										{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}<span class="price" style="display: inline;">{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}</span><br />{/if}
										{if isset($product.available_for_order) && $product.available_for_order && !isset($restricted_country_mode)}<span class="availability">{if ($product.allow_oosp || $product.quantity > 0)}{l s='Available' mod='ptsblockproducttabs'}{elseif (isset($product.quantity_all_versions) && $product.quantity_all_versions > 0)}{l s='Product available with different options' mod='ptsblockproducttabs'}{else}{l s='Out of stock' mod='ptsblockproducttabs'}{/if}</span>{/if}
									</div>
								
								{if isset($product.online_only) && $product.online_only}<span class="online_only">{l s='Online only' mod='ptsblockproducttabs'}</span>{/if}
								{/if}
								
								
									{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}
										{if ($product.allow_oosp || $product.quantity > 0)}
											{if isset($static_token)}
												<a class="button ajax_add_to_cart_button exclusive" rel="ajax_id_product_{$product.id_product|intval}" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)|escape:'html'}" title="{l s='Add to cart' mod='ptsblockproducttabs'}"><span></span>{l s='Add to cart' mod='ptsblockproducttabs'}</a>
											{else}
												<a class="button ajax_add_to_cart_button exclusive" rel="ajax_id_product_{$product.id_product|intval}" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}", false)|escape:'html'}" title="{l s='Add to cart' mod='ptsblockproducttabs'}"><span></span>{l s='Add to cart' mod='ptsblockproducttabs'}</a>
											{/if}						
										{else}
											<span class="exclusive"><span></span>{l s='Add to cart' mod='ptsblockproducttabs'}</span><br />
										{/if}
									{/if}
							
								
								<div class="view">
									<a class="lnk_view" href="{$product.link|escape:'htmlall':'UTF-8'}" title="{l s='View' mod='ptsblockproducttabs'}">{l s='View' mod='ptsblockproducttabs'}<span class="icon-play"></span></a>
								</div>
								
								<div class="action-buttons">
									<div class="wishlist">
		                        		<a href="#" id="wishlist_button{$product.id_product}" title="{l s='Add to wishlist' mod='ptsblockproducttabs'}" class="btn-add-wishlist" onclick="PtsWishlistCart('wishlist_block_list', 'add', '{$product.id_product}', $('#idCombination').val(), 1 ); return false;">{l s='Add to wishlist' mod='ptsblockproducttabs'}</a>                                                                    
		                            </div>
		                            <div class="compare"> 
		                            	<a class="comparator" title="{l s='Compare' mod='ptsblockproducttabs'}" id="comparator_item_{$product.id_product}" value="comparator_item_{$product.id_product}"><i class="{if isset($compareProducts) && in_array($product.id_product, $compareProducts)}icon-check{else}icon-check-empty{/if}">&nbsp;</i>{l s='compare' mod='ptsblockproducttabs'}</a>
		                            </div>
								</div>
								
							</div>
						</div>
				</div>
				
				{if ($product@iteration%$columnspage==0||$smarty.foreach.products.last)&&$columnspage>1}
				</div>
				{/if}
					
				{/foreach}
		</div>		
	{/foreach}
	</div>
</div>
{/if}