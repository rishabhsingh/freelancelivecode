{*
* Pts Prestashop Theme Framework for Prestashop 1.6.x
*
* @package   ptsmegamenu
* @version   2.5
* @author    http://www.prestabrain.com
* @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
*               <info@prestabrain.com>.All rights reserved.
* @license   GNU General Public License version 2
*}
{if $resulHtml.error}
 <div class="alert alert-danger">{$resulHtml.error}</div>
 {else if $resulHtml.confirm}
 <div class="alert alert-info">{$resulHtml.confirm}</div>    
 {/if}
 {if $widget_selected}
	{$form}
	 <script type="text/javascript">
		$('#widget_type').change( function(){
			location.href = '{html_entity_decode($fb_widget_action)}&wtype='+$(this).val();
		} );
	</script>	
 {else}
	<div class="widgets">
		{$i=0} <div class="row">
		{foreach $types as $widget => $text}
			<div class="col-md-3 col-sm-3">
				<div class="widget-item wpo-wg-button">
					<a href="{html_entity_decode($fb_widget_action)}&wtype={$widget}"><span class="wpo-wicon wpo-icon-{$widget}"></span></a>
					<div class="widget-title"><a href="{html_entity_decode($fb_widget_action)}&wtype={$widget}">{$text.label}</a></div>
					<div class="widget-desc"><i>{$text.explain}</i></div>	
				</div>
			</div>	

		{/foreach} <div class="row">
	</div>
{/if}
<hr>
 
<div class="row"><div class="col-lg-12 col-md-12">
	<a href="{html_entity_decode($backtolist_action)}" class="btn btn-primary">{l s='Back To List'}</a></div>
</div>
 