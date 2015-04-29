<div id="ptsblockmanufacturer" class="block ptsblockmanufacturer carousel slide col-xs-12 col-sm-6">
	<div class="row">
		{if $show_title}
			<h3>{l s='Product Brands' mod='ptsblockmanufacturer'}</h3>
		{/if}

		<div class="block_content">
			{if !empty($ptsmanufacturers )}
				{$tabname="ptsblockmanufacturer"}
				{if !empty($ptsmanufacturers)}
					<div id="{$tabname}">
						{if count($ptsmanufacturers) > $manuf_page}
							<a class="carousel-control left" href="#{$tabname}"   data-slide="prev">&lsaquo;</a>
							<a class="carousel-control right" href="#{$tabname}"  data-slide="next">&rsaquo;</a>
						{/if}
						<div class="carousel-inner row">
							{$ptsmanufacterer=array_chunk($ptsmanufacturers,$manuf_page)}
							{foreach from=$ptsmanufacterer item=ptsmanufacturers name=mypLoop}
								<div class="item {if isset($active) && $active == 1} active{/if} item {if $smarty.foreach.mypLoop.first}active{/if}">
									{foreach from=$ptsmanufacturers item=manuf name=ptsmanufacturer}
										<div class="col-xs-12 col-sm-6 col-md-{$scolumn} col-lg-{$scolumn}">
											<div class="block_manuf clearfix">
												{if $manuf.linkIMG}
													<div class="blog-image">
														<a href="{$manuf.link|escape:'html':'UTF-8'}">
															<img class="img-responsive" src="{$manuf.linkIMG}" alt="{$manuf.name}" vspace="0" border="0" />
														</a>
													</div>
												{/if}
											</div>
										</div>
									{/foreach}
								</div>
							{/foreach}
						</div>
					</div>
				{/if}
			{/if}
		</div>
	</div>
</div>
<!-- /MODULE Block ptsblockmanufacturer -->

 {literal}
  <script type="text/javascript">
  $(document).ready(function() {
      $('#{/literal}{$tabname}'{literal}).each(function(){
          $(this).carousel({
              pause: 'hover',
              interval: {/literal}{$interval}{literal}
          });
      });
  });
  </script>
 {/literal}