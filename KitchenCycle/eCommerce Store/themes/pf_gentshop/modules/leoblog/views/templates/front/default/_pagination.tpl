{*
* 2007-2013 PrestaShop
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
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if isset($no_follow) AND $no_follow}
	{assign var='no_follow_text' value='rel="nofollow"'}
{else}
	{assign var='no_follow_text' value=''}
{/if}

{if isset($p) AND $p}
	 

	<!-- Pagination -->
	<div id="pagination{if isset($paginationId)}_{$paginationId}{/if}" class="pagination pull-left clearfix">
     
	{if $start!=$stop}
		<ul class="pagination pagination-sm">
		{if $p != 1}
			{assign var='p_previous' value=$p-1}
			<li id="pagination_previous{if isset($paginationId)}_{$paginationId}{/if}" class="pagination_previous"><a {$no_follow_text} href="{$link->goPage($requestPage, $p_previous)}">{l s='Previous' mod='leoblog'}</a></li>
		{else}
			<li id="pagination_previous{if isset($paginationId)}_{$paginationId}{/if}" class="disabled pagination_previous"><span>{l s='Previous' mod='leoblog'}</span></li>
		{/if}
		{if $start==3}
			<li><a {$no_follow_text}  href="{$link->goPage($requestPage, 1)}"><span>1</span></a></li>
			<li><a {$no_follow_text}  href="{$link->goPage($requestPage, 2)}"><span>2</span></a></li>
		{/if}
		{if $start==2}
			<li><a {$no_follow_text}  href="{$link->goPage($requestPage, 1)}"><span>1</span></a></li>
		{/if}
		{if $start>3}
			<li><a {$no_follow_text}  href="{$link->goPage($requestPage, 1)}"><span>1</span></a></li>
			<li class="truncate"><span><span>...</span></span></li>
		{/if}
		{section name=pagination start=$start loop=$stop+1 step=1}
			{if $p == $smarty.section.pagination.index}
				<li class="active current"><span><span>{$p|escape:'html':'UTF-8'}</span></span></li>
			{else}
				<li><a {$no_follow_text} href="{$link->goPage($requestPage, $smarty.section.pagination.index)}"><span>{$smarty.section.pagination.index|escape:'html':'UTF-8'}</span></a></li>
			{/if}
		{/section}
		{if $pages_nb>$stop+2}
			<li class="truncate"><span><span>...</span></span></li>
			<li><a href="{$link->goPage($requestPage, $pages_nb)}"><span>{$pages_nb|intval}</span></a></li>
		{/if}
		{if $pages_nb==$stop+1}
			<li><a href="{$link->goPage($requestPage, $pages_nb)}"><span>{$pages_nb|intval}</span></a></li>
		{/if}
		{if $pages_nb==$stop+2}
			<li><a href="{$link->goPage($requestPage, $pages_nb-1)}"><span>{$pages_nb-1|intval}</span></a></li>
			<li><a href="{$link->goPage($requestPage, $pages_nb)}"><span>{$pages_nb|intval}</span></a></li>
		{/if}
		{if $pages_nb > 1 AND $p != $pages_nb}
			{assign var='p_next' value=$p+1}
			<li id="pagination_next{if isset($paginationId)}_{$paginationId}{/if}" class="pagination_next"><a {$no_follow_text} href="{$link->goPage($requestPage, $p_next)}">{l s='Next' mod='leoblog'}</a></li>
		{else}
			<li id="pagination_next{if isset($paginationId)}_{$paginationId}{/if}" class="disabled pagination_next"><span>{l s='Next' mod='leoblog'}</span></li>
		{/if}
		</ul>
	{/if}
	</div>
    
    <div class="product-count pull-right">
    	{if ($n*$p) < $nb_items }
    		{assign var='blogShowing' value=$n*$p}
        {else}
        	{assign var='blogShowing' value=($n*$p-$nb_items-$n*$p)*-1}
        {/if}
        {if $p==1}
        	{assign var='blogShowingStart' value=1}
        {else}
        	{assign var='blogShowingStart' value=$n*$p-$n+1}
        {/if}
        {if $nb_items > 1}
        	{l s='Showing %1$d - %2$d of %3$d items' sprintf=[$blogShowingStart, $blogShowing, $nb_items]}
		{else}
        	{l s='Showing %1$d - %2$d of 1 item' sprintf=[$blogShowingStart, $blogShowing]}
       	{/if}
    </div>

	<!-- /Pagination -->
{/if}
