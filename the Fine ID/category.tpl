{*
* 2007-2014 PrestaShop
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
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{include file="$tpl_dir./errors.tpl"}
{if isset($category)}
	{if $category->id AND $category->active}
 
      <h1 class="page-heading{if (isset($subcategories) && !$products) || (isset($subcategories) && $products) || !isset($subcategories) && $products} product-listing{/if}">{$category->name|escape:'html':'UTF-8'}{if isset($categoryNameComplement)}&nbsp;{$categoryNameComplement|escape:'html':'UTF-8'}{/if}
        {include file="$tpl_dir./category-count.tpl"}
    </h1>

    <div class="categories clearfix">
    	{if $scenes || $category->id_image}
        <div class="inner">
            <div class="content_scene_cat">
            	 {if $scenes}
                 	<div class="content_scene">
                        <!-- Scenes -->
                        {include file="$tpl_dir./scenes.tpl" scenes=$scenes}
                        {if $category->description}
                            <div class="cat_desc rte">
                            {if Tools::strlen($category->description) > 350}
                                <div id="category_description_short">{$description_short}</div>
                                <div id="category_description_full" class="unvisible">{$category->description}</div>
                                <a href="{$link->getCategoryLink($category->id_category, $category.link_rewrite)|escape:'html':'UTF-8'}" class="lnk_more">{l s='More'}</a>
                            {else}
                                <div>{$category->description}</div>
                            {/if}
                            </div>
                        {/if}
                        </div>
                    {else}
                    <!-- Category image -->
                    <div class="content_scene_cat_bg">
                     {if $category->id_image}<img class="img-responsive" src="{$link->getCatImageLink($category->link_rewrite, $category->id_image, 'category_default')|escape:'html':'UTF-8'}" alt="" />{/if}
                    </div>
                    
                  {/if}
            </div>
        </div>
        {/if}
    </div>
    <div class="category-info">
        {if $category->description}
           <div class="cat_desc">
               {if strlen($category->description) > 350}
                   <div id="category_description_short">{$description_short}</div>
                   <div id="category_description_full" style="display:none">{$category->description}</div>
                  
               {else}
                   <div class="rte">{$category->description}</div>
               {/if}
           </div>
       {/if}
    </div>
    
    {if isset($subcategories)}
    <!-- Subcategories -->
    <div id="subcategories">
            <h6 class="subcategory-heading">{l s='Subcategories'}</h6>
            <ul class="links clearfix ">
            {foreach from=$subcategories item=subcategory}
                    <li>
                        <a class="subcategory-name" href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'html':'UTF-8'}">{$subcategory.name|truncate:25:'...'|escape:'html':'UTF-8'|truncate:350}</a>

                    </li>
            {/foreach}
            </ul>
    </div>
    {/if}
    {if $products}
    <div class="content_sortPagiBar product-filter clearfix"><div class="row">
        <div class="sortPagiBar col-lg-9 col-md-8 col-sm-8 col-xs-7">
            {include file="./product-sort.tpl"}
        </div>
        <div class="hidden-xs hidden-sm hidden-md hidden-lg">{include file="./nbr-product-page.tpl"}</div>
        <div class="top-pagination-content col-lg-3 col-md-4 col-sm-4 col-xs-5">
            {include file="./product-compare.tpl"}
        </div>
            </div></div>
        {include file="./product-list.tpl" products=$products}
        <div class="bottom-pagination-content col-xs-12 col-sm-12 content_sortPagiBar clearfix">
		
             {include file="./pagination.tpl" paginationId='bottom'}
        </div>
    {/if}
	{elseif $category->id}
		<p class="alert alert-warning">{l s='This category is currently unavailable.'}</p>
	{/if}
{/if}