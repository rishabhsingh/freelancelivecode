{*
* 2007-2015 PrestaShop
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
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<!-- Block search module TOP -->

<div class="block-search">
	<div class="btn-group search-focus">
		<div class="dropdown-toggle btn-theme-normal">
			<span class="text-label title">{l s='SEARCH' mod='blocksearch'}</span>
		</div>
	</div>
	<div style="" id="search_block_top" class="inner nav-search visible">
	<form id="searchbox" method="get" action="{$link->getPageLink('search', null, null, null, false, null, true)|escape:'html':'UTF-8'}" >
			<div class="input-group">
				<input type="hidden" name="controller" value="search" />
				<input type="hidden" name="orderby" value="position" />
				<input type="hidden" name="orderway" value="desc" />
				<input id="search_query_top" class="search-control search_query form-control ac_input" type="text" placeholder="{l s='Enter keyword here...' mod='blocksearch'}" id="search_query_top" name="search_query" value="{$search_query|escape:'htmlall':'UTF-8'|stripslashes}"  />
				<span class="input-group-addon button-close">
					<i class="icon-times"></i>
				</span>
			</div>	
		</form>
	</div>
</div>
<!-- /Block search module TOP -->