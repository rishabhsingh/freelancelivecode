{if isset($links)}
<div class="widget-links">
	{if isset($widget_heading)&&!empty($widget_heading)}
	<div class="widget-heading title_block">
		{$widget_heading}
	</div>
	{/if}
	<div class="widget-inner block_content">	
		<div class="panel-group">
			<ul class="nav-links">
			  {foreach $links as $key => $ac}  
			  <li ><a href="{$ac.link|escape:'html':'UTF-8'}" >{$ac.text}</a></li>
			  {/foreach}
			</ul>
	</div>
</div>
</div>
{/if}


