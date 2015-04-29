{if isset($html)}
<div class="widget-html">
	{if isset($widget_heading)&&!empty($widget_heading)}
	<div class="widget-heading title_block">
		{$widget_heading}
	</div>
	{/if}
	<div class="widget-inner block_content">
		{$html}
	</div>
</div>
{/if}