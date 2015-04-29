 {if isset($products) && !empty($products)}
<div class="widget-products">
	{if isset($widget_heading)&&!empty($widget_heading)}
	<div class="widget-heading title_block">
		{$widget_heading}
	</div>
	{/if}
	<div class="widget-inner block_content">
		
		{if isset($products) AND $products}
		<ul class="products-block">
			{assign var='liHeight' value=140}
			{assign var='nbItemsPerLine' value=4}
			{assign var='nbLi' value=$limit}
			{math equation="nbLi/nbItemsPerLine" nbLi=12 nbItemsPerLine=$limit assign=cols_lg}

			{foreach from=$products item=product name=homeFeaturedProducts}
				{math equation="(total%perLine)" total=$smarty.foreach.homeFeaturedProducts.total perLine=$nbItemsPerLine assign=totModulo}
				{if $totModulo == 0}{assign var='totModulo' value=$nbItemsPerLine}{/if}
			<li class="w-product pull-left col-lg-{$cols_lg} col-md-{$cols_lg} col-sm-{$cols_lg} col-xs-12">
			<div class="product-block">
			 <div class="product-container">	
					
					<div class="image ">
						<a href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:html:'UTF-8'}" class="product_image">
							<img class="img-responsive" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')}"  alt="{$product.name|escape:html:'UTF-8'}" />
							{if isset($product.new) && $product.new == 1}
							<span class="product-label new-box">
								<span class="new-label">{l s='New'}</span>
							</span>
						{/if}
						{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
							<span class="product-label  sale-box">
								<span class="sale-label">{l s='Sale!'}</span>
							</span>
						{/if}
						</a>
					</div>

					<div class="product-meta">
						<h3 class="name"><a href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}">{$product.name|truncate:35:'...'|escape:'htmlall':'UTF-8'}</a></h3>


						{hook h='displayProductListReviews' product=$product}

						 
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
										{/if}
									</div>
									{/if}						
								</div>	

							<div class="action-btn">
								{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}
									{if ($product.allow_oosp || $product.quantity > 0)}
										{if isset($static_token)}
											<div class="addtocart cart"><a data-toggle="tooltip"  class="btn btn-shopping-cart btn-outline ajax_add_to_cart_button" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart'}" data-id-product="{$product.id_product|intval}">
												<i class="icon-shopping-cart"></i>
												<em>{l s='Add to cart'}</em>
											</a></div>
										{else}
											<div class="addtocart cart"><a data-toggle="tooltip"  class="btn btn-shopping-cart btn-outline ajax_add_to_cart_button" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$product.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart'}" data-id-product="{$product.id_product|intval}">
												<i class="icon-shopping-cart"></i>
												<span>{l s='Add to cart'}</span>
											</a></div>
										{/if}						
									{else}
										<div class="addtocart cart"><span data-toggle="tooltip"  class="btn btn-shopping-cart btn-outline ajax_add_to_cart_button disabled">
											<i class="icon-shopping-cart"></i>
											<span>{l s='Add to cart'}</span>
										</span></div>
									{/if}
								{/if}

							</div>
						
						</div>
				    </div>
				</div>	
			</div>
			</li>				
			{/foreach}
		</ul>
		{/if}
	</div>
</div>
{/if}