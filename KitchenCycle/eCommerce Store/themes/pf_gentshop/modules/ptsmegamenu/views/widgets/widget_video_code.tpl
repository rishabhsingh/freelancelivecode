
 {if isset($video_link)}
<div class="widget-video">
	{if isset($widget_heading)&&!empty($widget_heading)}
	<div class="widget-heading">
		{$widget_heading}
	</div>
	{/if}
	<div class="widget-inner">
		<iframe src="{$video_link}" style="width:{$width};height:{$height};" allowfullscreen></iframe>
	</div>
</div>
{/if}