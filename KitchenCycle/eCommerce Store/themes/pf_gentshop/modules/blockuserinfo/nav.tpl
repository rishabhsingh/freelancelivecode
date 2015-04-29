
<!-- Block user information module NAV  -->
<div id="header_user_info" class="hidden-xs hidden-sm ">
	<span>{l s='Welcome to the KitchenCycle Web Store! You can' mod='blockuserinfo'}</span>
	{if $logged}
		<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" title="{l s='View my customer account' mod='blockuserinfo'}" class="account" rel="nofollow"><span>{$cookie->customer_firstname} {$cookie->customer_lastname}</span></a>
		<a href="{$link->getPageLink('index', true, NULL, "mylogout")|escape:'html':'UTF-8'}" title="{l s='Log me out' mod='blockuserinfo'}" class="logout" rel="nofollow">{l s='Log out' mod='blockuserinfo'}</a>
	{else}
		<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" title="{l s='Login to your customer account' mod='blockuserinfo'}" class="login " rel="nofollow">{l s='login' mod='blockuserinfo'}</a>
		<span class="account">{l s='or' mod='blockuserinfo'}</span>
		<a class="account" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" title="{l s='View my customer account' mod='blockuserinfo'}" rel="nofollow">{l s='create an account.' mod='blockuserinfo'}</a>
	{/if}
</div>

<div class="btn-group">
	<div data-toggle="dropdown" class="dropdown-toggle">
		<i class="icon-user"></i>
		<span class="title hidden-xs">{l s='Settings' mod='blockuserinfo'}</span> 
		<span class="icon-angle-down"></span>									
	</div>

	<div class="header_user_info quick-setting dropdown-menu tree-menu">

						<ul class="links">
						<li class="first">
							<a id="wishlist-total-topbar" href="{$link->getModuleLink('blockwishlist', 'mywishlist', array(), true)|addslashes|escape:'html':'UTF-8'}" title="{l s='My wishlists' mod='blockuserinfo'}"><i class="icon icon-heart"></i>{l s='Wish List' mod='blockuserinfo'}</a>
						</li>

						<li>
							<a id="wishlist-total" href="{$link->getPageLink('products-comparison')|escape:'html':'UTF-8'}" title="{l s='Compare' mod='blockuserinfo'}"><i class="icon icon-retweet"></i>{l s='Compare' mod='blockuserinfo'}</a>
						</li>
						
						{if $is_logged}
							<li><a class="logout" href="{$link->getPageLink('index', true, NULL, "mylogout")|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log me out' mod='blockuserinfo'}">
								<i class="icon icon-unlock-alt"></i>{l s='Sign out' mod='blockuserinfo'}
							</a></li>
						{else}
							<li><a class="login" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Login to your customer account' mod='blockuserinfo'}">
								<i class="icon icon-unlock-alt"></i>{l s='Sign in' mod='blockuserinfo'}
							</a></li>
						{/if}

						<li>
							<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" title="{l s='My account' mod='blockuserinfo'}"><i class="icon icon-user"></i>{l s='My Account' mod='blockuserinfo'}</a>
						</li>
						<li class="last"><a href="{$link->getPageLink($order_process, true)|escape:'html':'UTF-8'}" title="{l s='Checkout' mod='blockuserinfo'}" class="last"><i class="icon icon-share"></i>{l s='Checkout' mod='blockuserinfo'}</a></li>
						
					</ul>
			</div>	
</div>		
					