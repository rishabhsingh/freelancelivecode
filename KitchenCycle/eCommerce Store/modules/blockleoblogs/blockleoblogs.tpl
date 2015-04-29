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

<!-- MODULE Block blockleoblogstabs -->
<div id="blockleoblogstabs" class="block blogs_block exclusive blockleoblogs">
	<h3 class="title_block">{l s='Latest Blogs' mod='blockleoblogs'}</h3>
	<div class="block_content">	
		{if !empty($blogs )}
			{$tabname="blockleoblogs"}
			{if !empty($blogs)}
<div class="carousel slide" id="{$tabname}">
	 {if count($blogs)>$itemsperpage}	 
		<div class="carousel-controls">
		 	<a class="carousel-control left" href="#{$tabname}"   data-slide="prev">&lsaquo;</a>
			<a class="carousel-control right" href="#{$tabname}"  data-slide="next">&rsaquo;</a>
		</div>
	{/if}
	<div class="carousel-inner">
	{$mblogs=array_chunk($blogs,$itemsperpage)}
	{foreach from=$mblogs item=blogs name=mypLoop}
		<div class="item {if $smarty.foreach.mypLoop.first}active{/if}">
				{foreach from=$blogs item=blog name=blogs}
				{if $blog@iteration%$columnspage==1&&$columnspage>1}
				  <div class="row">
				{/if}
				<div class="col-xs-12 col-sm-6 col-md-{$scolumn} col-lg-{$scolumn} blog_block ajax_block_blog {if $smarty.foreach.blogs.first}first_item{elseif $smarty.foreach.blogs.last}last_item{/if}">
					<div class="blog_container clearfix">
							{if $config->get('blockleo_blogs_title',1)}
							<h5><a href="{$blog.link|escape:'html':'UTF-8'}" title="{$blog.title}">{$blog.title}</a></h5>
							{/if}	
							<div class="blog-meta">
								 
								{if $config->get('blockleo_blogs_cat',1)}
								<span class="blog-cat"> <span class="icon-list">{l s='In' module='blockleoblogs'}</span> 
									<a href="{$blog.category_link|escape:'html':'UTF-8'}" title="{$blog.category_title|escape:'html':'UTF-8'}">{$blog.category_title}</a>
								</span>
								{/if}
								
								{if $config->get('blockleo_blogs_cre',1)} 
								<span class="blog-created"><span class=""></span>
									<span class="icon-calendar"> {l s='On' module='blockleoblogs'} </span> {strtotime($blog.date_add)|date_format:"%A, %B %e, %Y"}
								</span>
								{/if} 
								
								{if $config->get('blockleo_blogs_cout',1)} 
								<span class="blog-ctncomment">
									<span class="icon-comment"> {l s='Comment' mod='blockleoblogs'}:</span> {$blog.comment_count}
								</span>
								{/if}  
								
								{if $config->get('blockleo_blogs_aut',1)} 
								<span class="blog-author">
									<span class="icon-author"> {l s='Author' mod='blockleoblogs'}:</span> {$blog.author}
								</span>
								{/if}
								{if $config->get('blockleo_blogs_hits',1)} 
								<span class="blog-hits">
									<span class="icon-hits"> {l s='Hits' mod='blockleoblogs'}:</span> {$blog.hits}
								</span>	
								{/if}
							</div>
							{if $blog.image && $config->get('blockleo_blogs_img',1)}
							<div class="blog-image">
								<img src="{$blog.preview_url}" title="{$blog.title}" class="img-responsive"/>
							</div>
							{/if}

							<div class="blog-shortinfo">
								{if $config->get('blockleo_blogs_des',1)} 
								{$blog.description}
								{/if}  
								<p>
									<a href="{$blog.link|escape:'html':'UTF-8'}" title="{$blog.title|escape:'html':'UTF-8'}" class="btn btn-default">{l s='Read more' mod='blockleoblogs'}</a>
								</p>
						 
							</div>
						</div>
				</div>
				
				{if ($blog@iteration%$columnspage==0||$smarty.foreach.blogs.last)&&$columnspage>1}
				</div>
				{/if}
					
				{/foreach}
		</div>		
	{/foreach}
	</div>
</div>
{/if}
		{/if}
	</div>
		{if $config->get('blockleo_blogs_show',1)}
		<div><a class="pull-right" href="{$view_all_link|escape:'html':'UTF-8'}" title="{l s='View All' mod='blockleoblogs'}">{l s='View All' mod='blockleoblogs'}</a></div>
		{/if}	
</div>
<!-- /MODULE Block blockleoblogstabs -->
<script type="text/javascript">
$(document).ready(function() {
    $('{$tabname}').each(function(){
        $(this).carousel({
            pause: 'hover',
            interval: {$interval}
        });
    });
});
</script>
 