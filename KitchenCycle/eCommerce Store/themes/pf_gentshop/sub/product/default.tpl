{*{if isset($images)}
<div id="thumbs_list">
	<ul id="thumbs_list_frame">
	
		{foreach from=$images item=image name=thumbnails}
			{assign var=imageIds value="`$product->id`-`$image.id_image`"}
			{if !empty($image.legend)}
				{assign var=imageTitle value=$image.legend|escape:'html':'UTF-8'}
			{else}
				{assign var=imageTitle value=$product->name|escape:'html':'UTF-8'}
			{/if}
			<li id="thumbnail_{$image.id_image}"{if $smarty.foreach.thumbnails.last} class="last"{/if}>
				<a 
					{if $jqZoomEnabled && $have_image && !$content_only}
						href="javascript:void(0);"
						rel="{literal}{{/literal}gallery: 'gal1', smallimage: '{$link->getImageLink($product->link_rewrite, $imageIds, 'large_default')|escape:'html':'UTF-8'}',largeimage: '{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox_default')|escape:'html':'UTF-8'}'{literal}}{/literal}"
					{else}
						href="{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox_default')|escape:'html':'UTF-8'}"
						data-fancybox-group="other-views"
						class="fancybox{if $image.id_image == $cover.id_image} shown{/if}"
					{/if}
					title="{$imageTitle}">
					<img class="img-responsive" id="thumb_{$image.id_image}" src="{$link->getImageLink($product->link_rewrite, $imageIds, 'cart_default')|escape:'html':'UTF-8'}" alt="{$imageTitle}" title="{$imageTitle}" height="{$cartSize.height}" width="{$cartSize.width}" itemprop="image" />
				</a>
			</li>
		{/foreach}
	
	</ul>
</div> <!-- end thumbs_list -->
{/if}*}

<div class="product-block" itemscope="" itemtype="http://schema.org/Product"><div class="product-container">
			<div class="product-image-container image">
						{if isset($product.new) && $product.new == 1}
							<span class="product-label product-label-special new-box">
								<span class="new-label">{l s='New'}</span>
							</span>
						{/if}
						{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
							<span class="product-label product-label-special sale-box">
								<span class="sale-label">{l s='Sale!'}</span>
							</span>
						{/if}

						<a class="img product_img_link"	href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url">
							<img class="replace-2x img-responsive" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{if !empty($product.legend)}{$product.legend|escape:'html':'UTF-8'}{else}{$product.name|escape:'html':'UTF-8'}{/if}" title="{if !empty($product.legend)}{$product.legend|escape:'html':'UTF-8'}{else}{$product.name|escape:'html':'UTF-8'}{/if}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} itemprop="image" />
						</a>

						{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
							<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="content_price price">

								{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}
									{if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
										<span class="old-price">
											{displayWtPrice p=$product.price_without_reduction}
										</span>
										
									{/if}
									<span itemprop="price" class="product-price">
										{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}
									</span>
									<meta itemprop="priceCurrency" content="{$priceDisplay}" />
									{if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
									
										{if $product.specific_prices.reduction_type == 'percentage'}
										<span class="content_price_percent sale-percent-box" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
											<span class="price-percent-reduction">-{$product.specific_prices.reduction * 100}%</span>
										</span>
										{/if}
									{/if}
								{/if}
							</div>
						{/if}

				<div class="right">
					<div class="action hidden-xs">
						<div>
							{if isset($quick_view) && $quick_view}
								<div class="quick-view col-lg-6 col-md-3 col-xs-3">
									<a class="quick-view pts-colorbox btn btn-outline cboxElement" href="{$product.link|escape:'html':'UTF-8'}" rel="{$product.link|escape:'html':'UTF-8'}">
										<span class="hidden-md hidden-sm hidden-xs">{l s='Quick view'}</span>
									</a>
								</div>
							{/if}	
							<div class="col-lg-6 col-md-9 col-xs-9 btn-action">
								<div class="zoom"> 
									<a class="info-view colorbox product-zoom btn-tooltip pts-fancybox cboxElement" href="{$link->getImageLink($product.link_rewrite, $product.id_image, 'large_default')|escape:'html':'UTF-8'}" rel="nofollow" data-toggle="tooltip" title="{l s='zoom'}">
									</a>
								</div>
								{if isset($comparator_max_item) && $comparator_max_item}
									<div class="compare">
										<a class="btn-tooltip add_to_compare" href="{$product.link|escape:'html':'UTF-8'}" data-id-product="{$product.id_product}" data-toggle="tooltip" title="{l s='Compare'}"> </a>
									</div>
								{/if}

								<div class="wishlist">
									{hook h='displayProductListFunctionalButtons' product=$product}
								</div>
							</div>
							
							<div class="product-zoom">
								<a class="btn-tooltip pts-fancybox btn btn-highlighted cboxElement" href="{$link->getImageLink($product.link_rewrite, $product.id_image, 'large_default')|escape:'html':'UTF-8'}" rel="nofollow" data-toggle="tooltip" title="{l s='zoom'}">
									<i class="icon-search-plus"></i>
									<span>{l s='zoom'}</span>
								</a>
							</div>	
						
						</div>
					</div>
				</div>

				</div>

				<div class="product-meta">		
					<div class="left">
							<h3 class="name" itemprop="name">
								{if isset($product.pack_quantity) && $product.pack_quantity}{$product.pack_quantity|intval|cat:' x '}{/if}
								<a href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url" >
									{$product.name|truncate:45:'...'|escape:'html':'UTF-8'}
								</a>
							</h3>
							<div class="product-desc description" itemprop="description">
								{$product.description_short|strip_tags:'UTF-8'|truncate:200:'...'}
							</div>

							{hook h='displayProductListReviews' product=$product}


							{if isset($product.color_list)}
								<div class="color-list-container product-colors">{$product.color_list} </div>
							{/if}
		
					
							<div class="product-flags">
								{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
									{if isset($product.online_only) && $product.online_only}
										<span class="online_only">{l s='Online only'}</span>
									{/if}
								{/if}
								{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
									{elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
										<span class="discount">{l s='Reduced price!'}</span>
									{/if}
							</div>

							{if (!$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
								{if isset($product.available_for_order) && $product.available_for_order && !isset($restricted_country_mode)}
									<span itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="availability">
										{if ($product.allow_oosp || $product.quantity > 0)}
											<span class="{if $product.quantity <= 0}out-of-stock{else}available-now{/if}">
												<link itemprop="availability" href="http://schema.org/InStock" />
												{if $product.quantity <= 0}
													{if $product.allow_oosp}
														{$product.available_later}
													{else}
														{l s='Out of stock'}
													{/if}
												{else}
												{if isset($product.available_now) && $product.available_now}{$product.available_now}{else}{l s='In Stock'}{/if}{/if}
											</span>
										{elseif (isset($product.quantity_all_versions) && $product.quantity_all_versions > 0)}
											<span class="available-dif">
												<link itemprop="availability" href="http://schema.org/LimitedAvailability" />{l s='Product available with different options'}
											</span>
										{else}
											<span class="out-of-stock">
												<link itemprop="availability" href="http://schema.org/OutOfStock" />{l s='Out of stock'}
											</span>
										{/if}
									</span>
								{/if}
							{/if}
						

							<div class="bottom">					
								<div class="wrap-hover">
									{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
									<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="content_price price">

										{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}
											{if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
												<span class="old-price">
													{displayWtPrice p=$product.price_without_reduction}
												</span>
												
											{/if}
											<span itemprop="price" class="product-price">
												{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}
											</span>
											<meta itemprop="priceCurrency" content="{$priceDisplay}" />
											{if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
											
												{if $product.specific_prices.reduction_type == 'percentage'}
												<span class="content_price_percent sale-percent-box" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
													<span class="price-percent-reduction">-{$product.specific_prices.reduction * 100}%</span>
												</span>
												{/if}
											{/if}
										{/if}
									</div>
									{/if}						
								</div>

							<div class="action-btn">
								
								{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.customizable != 2 && !$PS_CATALOG_MODE}
										{if (!isset($product.customization_required) || !$product.customization_required) && ($product.allow_oosp || $product.quantity > 0)}
											{capture}add=1&amp;id_product={$product.id_product|intval}{if isset($static_token)}&amp;token={$static_token}{/if}{/capture}
											<div class="addtocart cart">
												<a data-toggle="tooltip"  class="btn btn-shopping-cart btn-outline-default ajax_add_to_cart_button" href="{$link->getPageLink('cart', true, NULL, $smarty.capture.default, false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart'}" data-id-product="{$product.id_product|intval}" data-minimal_quantity="{if isset($product.product_attribute_minimal_quantity) && $product.product_attribute_minimal_quantity > 1}{$product.product_attribute_minimal_quantity|intval}{else}{$product.minimal_quantity|intval}{/if}">
													<i class="icon-shopping-cart"></i>
												<span>{l s='Add to cart'}</span>
												</a>
											</div>


										{else}
											<div class="addtocart cart"><span data-toggle="tooltip"  class="btn btn-shopping-cart btn-outline-default ajax_add_to_cart_button disabled">
												<i class="icon-shopping-cart"></i>
												<span>{l s='Add to cart'}</span>
											</span></div>
										{/if}
									{/if}


								{if isset($quick_view) && $quick_view}
									<div class="quickview"><a class="quick-view pts-colorbox btn btn-outline cboxElement" href="{$product.link|escape:'html':'UTF-8'}" rel="{$product.link|escape:'html':'UTF-8'}">
										<i class="icon-eye"></i>
										<span>{l s='Quick view'}</span>
									</a></div>
								{/if}	
							</div>
										
							</div>						
						
						
					</div>
				</div>
				
			

				
		</div><!-- .product-container> --></div>
<script type="text/javascript">
	$("a.pts-fancybox").fancybox();
</script>