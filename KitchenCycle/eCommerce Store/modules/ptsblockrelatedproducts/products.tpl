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
{if !empty($products)}
	{*define numbers of product per line in other page for desktop*}
	{if $page_name !='index' && $page_name !='product'}
		{assign var='nbItemsPerLine' value=3}
		{assign var='nbItemsPerLineTablet' value=2}
		{assign var='nbItemsPerLineMobile' value=3}
	{else}
		{assign var='nbItemsPerLine' value=4}
		{assign var='nbItemsPerLineTablet' value=3}
		{assign var='nbItemsPerLineMobile' value=2}
	{/if}
	{*define numbers of product per line in other page for tablet*}
	{assign var='nbLi' value=$products|@count}
	{math equation="nbLi/nbItemsPerLine" nbLi=$nbLi nbItemsPerLine=$nbItemsPerLine assign=nbLines}
	{math equation="nbLi/nbItemsPerLineTablet" nbLi=$nbLi nbItemsPerLineTablet=$nbItemsPerLineTablet assign=nbLinesTablet}
<div class="boxcarousel slide" id="{$tabname}">
	{if count($products)>$itemsperpage}	
		<div class="carousel-controls">
		 	<a class="carousel-control left" href="#{$tabname}"   data-slide="prev">&lsaquo;</a>
			<a class="carousel-control right" href="#{$tabname}"  data-slide="next">&rsaquo;</a>
		</div>
	{/if}
	<div class="carousel-inner">
	{$mproducts=array_chunk($products,$itemsperpage)}
	{foreach from=$mproducts item=products name=mypLoop}
		<!-- Products list -->
		<ul{if isset($id) && $id} id="{$id}"{/if} class="product_list grid row{if isset($class) && $class} {$class}{/if}{if isset($active) && $active == 1} active{/if} item {if $smarty.foreach.mypLoop.first}active{/if}">
		{foreach from=$products item=product name=products}
			{math equation="(total%perLine)" total=$smarty.foreach.products.total perLine=$nbItemsPerLine assign=totModulo}
			{math equation="(total%perLineT)" total=$smarty.foreach.products.total perLineT=$nbItemsPerLineTablet assign=totModuloTablet}
			{math equation="(total%perLineT)" total=$smarty.foreach.products.total perLineT=$nbItemsPerLineMobile assign=totModuloMobile}
			{if $totModulo == 0}{assign var='totModulo' value=$nbItemsPerLine}{/if}
			{if $totModuloTablet == 0}{assign var='totModuloTablet' value=$nbItemsPerLineTablet}{/if}
			{if $totModuloMobile == 0}{assign var='totModuloMobile' value=$nbItemsPerLineMobile}{/if}
			<li class="ajax_block_product col-xs-12 col-sm-4 col-md-{$scolumn} {if $smarty.foreach.products.iteration%$nbItemsPerLine == 0} last-in-line{elseif $smarty.foreach.products.iteration%$nbItemsPerLine == 1} first-in-line{/if}{if $smarty.foreach.products.iteration > ($smarty.foreach.products.total - $totModulo)} last-line{/if}{if $smarty.foreach.products.iteration%$nbItemsPerLineTablet == 0} last-item-of-tablet-line{elseif $smarty.foreach.products.iteration%$nbItemsPerLineTablet == 1} first-item-of-tablet-line{/if}{if $smarty.foreach.products.iteration%$nbItemsPerLineMobile == 0} last-item-of-mobile-line{elseif $smarty.foreach.products.iteration%$nbItemsPerLineMobile == 1} first-item-of-mobile-line{/if}{if $smarty.foreach.products.iteration > ($smarty.foreach.products.total - $totModuloMobile)} last-mobile-line{/if}">
				<div class="product-container" itemscope itemtype="http://schema.org/Product">
					<div class="left-block">
						<div class="product-image-container">
							<a class="product_img_link"	href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url">
								<img class="replace-2x img-responsive" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{if !empty($product.legend)}{$product.legend|escape:'html':'UTF-8'}{else}{$product.name|escape:'html':'UTF-8'}{/if}" title="{if !empty($product.legend)}{$product.legend|escape:'html':'UTF-8'}{else}{$product.name|escape:'html':'UTF-8'}{/if} mod='ptsblockrelatedproducts'" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} itemprop="image" />
							</a>
							<div class="price_reduction">
							{if isset($product.specific_prices.reduction) && $product.specific_prices.reduction && $product.specific_prices.reduction_type == 'percentage'}
								<span class="price-percent-reduction">-{$product.specific_prices.reduction * 100}%</span>
							{/if}
							</div>
							{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
								<div class="content_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
									{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}
										{if isset($product.specific_prices) && $product.specific_prices}
											<span class="old-price product-price">
												{displayWtPrice p=$product.price_without_reduction}
											</span>
											{*{if isset($product.specific_prices.reduction) && $product.specific_prices.reduction && $product.specific_prices.reduction_type == 'percentage'}
												<span class="price-percent-reduction">-{$product.specific_prices.reduction * 100}%</span>
											{/if}*}
										{/if}
										<span itemprop="price" class="product-price {if isset($product.specific_prices) && $product.specific_prices}price_red{else}price_yellow{/if}">
											{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}
										</span>
										<meta itemprop="priceCurrency" content="{$priceDisplay}" />
									{/if}
								</div>
							{/if}
							{if isset($product.new) && $product.new == 1}
								<span class="new-box">
									<span class="new-label">{l s='New' mod='ptsblockrelatedproducts'}</span>
								</span>
							{/if}
							{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
								<span class="sale-box">
									<span class="sale-label">{l s='Sale!' mod='ptsblockrelatedproducts'}</span>
								</span>
							{/if}
						</div>
					</div>
					<div class="right-block">
						<h5 itemprop="name">
							{if isset($product.pack_quantity) && $product.pack_quantity}{$product.pack_quantity|intval|cat:' x '}{/if}
							<a class="product-name" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url" >
								{$product.name|truncate:45:'...'|escape:'html':'UTF-8'}
							</a>
						</h5>
						{hook h='displayProductListReviews' product=$product}
						<p class="product-desc" itemprop="description">
							{$product.description_short|strip_tags:'UTF-8'|truncate:360:'...'}
						</p>
						{*{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
						<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
							{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}
								<span itemprop="price" class="price product-price">
									{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}
								</span>
								<meta itemprop="priceCurrency" content="{$priceDisplay}" />
								{if isset($product.specific_prices) && $product.specific_prices}
									<span class="old-price product-price">
										{displayWtPrice p=$product.price_without_reduction}
									</span>
									{if isset($product.specific_prices.reduction) && $product.specific_prices.reduction && $product.specific_prices.reduction_type == 'percentage'}
										<span class="price-percent-reduction">-{$product.specific_prices.reduction * 100}%</span>
									{/if}
								{/if}
							{/if}
						</div>
						{/if}*}
						<div class="button-container">
							{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}
								{if ($product.allow_oosp || $product.quantity > 0)}
									{if isset($static_token)}
										<a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='ptsblockrelatedproducts'}" data-id-product="{$product.id_product|intval}">
											<span>{l s='Add to cart' mod='ptsblockrelatedproducts'}</span>
										</a>
									{else}
										<a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$product.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='ptsblockrelatedproducts'}" data-id-product="{$product.id_product|intval}">
											<span class="icon-car">{l s='Add to cart' mod='ptsblockrelatedproducts'}</span>
										</a>
									{/if}
									{hook h='displayProductListFunctionalButtons' product=$product}
									{if isset($comparator_max_item) && $comparator_max_item}
											<a class="button btn btn-default add_to_compare" title="{l s='Add to Compare' mod='ptsblockrelatedproducts'}" href="#" data-id-product="{$product.id_product}">
												<span class="icon-refresh"></span>
											</a>
									{/if}						
								{else}
									<span class="button ajax_add_to_cart_button btn btn-default disabled">
										<span>{l s='Add to cart' mod='ptsblockrelatedproducts'}</span>
									</span>
									{hook h='displayProductListFunctionalButtons' product=$product}
									{if isset($comparator_max_item) && $comparator_max_item}
											<a class="button btn btn-default add_to_compare" title="{l s='Add to Compare' mod='ptsblockrelatedproducts'}" href="#" data-id-product="{$product.id_product}">
												<span class="icon-refresh"></span>
											</a>
									{/if}
								{/if}
							{/if}
							{*<a itemprop="url" class="button lnk_view btn btn-default" href="{$product.link|escape:'html':'UTF-8'}" title="{l s='View' mod='ptsblockrelatedproducts'}">
								<span>{l s='More' mod='ptsblockrelatedproducts'}</span>
							</a>*}
						</div>
						<div class="product-flags">
							{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
								{if isset($product.online_only) && $product.online_only}
									<span class="online_only">{l s='Online only' mod='ptsblockrelatedproducts'}</span>
								{/if}
							{/if}
							{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
								{elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
									<span class="discount">{l s='Reduced price!' mod='ptsblockrelatedproducts'}</span>
								{/if}
						</div>
					</div>
					<div class="functional-buttons clearfix">
						{if isset($quick_view) && $quick_view}
							<a class="quick-view" title="{l s='Quick view' mod='ptsblockrelatedproducts'}" href="#" rel="{$product.link|escape:'html':'UTF-8'}">
								<span class="icon-plus">&nbsp;{l s='Quick view' mod='ptsblockrelatedproducts'}</span>
							</a>
						{/if}
					</div>
				</div><!-- .product-container> -->
			</li>
		{/foreach}
		</ul>	
	{/foreach}
	</div>
</div>
{/if}