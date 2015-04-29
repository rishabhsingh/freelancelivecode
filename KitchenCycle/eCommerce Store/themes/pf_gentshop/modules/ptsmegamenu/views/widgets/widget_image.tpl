{if isset($images)}
<div class="widget-images">
	{if isset($widget_heading)&&!empty($widget_heading)}
	<div class="widget-heading title_block">
		{$widget_heading}
	</div>
	{/if}
	<div class="widget-inner block_content clearfix">
			<div class="images-list clearfix">	
		 	{foreach from=$images item=image name=images}
		 	<div class="image-item grid-{$columns}"><div><img src="{$image}"/></div></div>
		 {/foreach}</div>
	</div>
</div>
{/if} 