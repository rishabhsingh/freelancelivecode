 <div class="widget-manufacture">
	{if isset($widget_heading)&&!empty($widget_heading)}
	<div class="widget-heading title_block">
		{$widget_heading}
	</div>
	{/if}
	<div class="widget-inner block_content">
		<div class="manu-logo">
			{foreach from=$manufacturers item=manufacturer name=manufacturers}
			<a  href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)|escape:'html':'UTF-8'}"  title="{l s='view products'}">
			<img src="{$img_manu_dir}{$manufacturer.image|escape:'htmlall':'UTF-8'}-logo_brand.jpg" alt=""/> </a>
			{/foreach}
		</div>
	</div>
</div>
 