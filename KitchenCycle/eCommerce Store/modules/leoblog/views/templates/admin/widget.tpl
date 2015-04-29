 {if $warning}
 <div class="alert alert-danger">{$warning}</div>
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
			
	 
			<div class="col-md-4 col-sm-4">
				<div class="widget-item">
					<h4><a href="{html_entity_decode($fb_widget_action)}&wtype={$widget}">{$text.label}</a></h4>
					<p><i>{$text.explain}</i></p>	
				</div>
			</div>	

		{/foreach} <div class="row">
	</div>
{/if}