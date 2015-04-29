
	{if !empty($ptsmanufacturers )}
		<div id="ptsblockmanufacturer" class="block ptsblockmanufacturer carousel slide">
			
				{if $show_title}
					<h4 class="title_block nostyle">{l s='Our Brand' mod='ptsblockmanufacturer'}</h4>
				{/if}

				<div class="block_content">
						{$tabname="ptsblockmanufacturer"}
						{if !empty($ptsmanufacturers)}
							<div id="{$tabname}">
								{if count($ptsmanufacturers) > $manuf_page}
									<div class="carousel-controls">
										<a class="carousel-control left" href="#{$tabname}" data-slide="prev">&lsaquo;</a>
										<a class="carousel-control right" href="#{$tabname}" data-slide="next">&rsaquo;</a>
									</div>
								{/if}
								<div class="carousel-inner">
									{$ptsmanufacterer=array_chunk($ptsmanufacturers,$manuf_page)}
									{foreach from=$ptsmanufacterer item=ptsmanufacturers name=mypLoop}
										<div class="item {if isset($active) && $active == 1} active{/if} item {if $smarty.foreach.mypLoop.first}active{/if}">
											{foreach from=$ptsmanufacturers item=manuf name=ptsmanufacturer}
												<div class="col-xs-12 col-sm-6 col-md-{$scolumn} col-lg-{$scolumn}">
													<div class="block_manuf clearfix">
														{if $manuf.linkIMG}
															<div class="blog-image">
																<a href="{$manuf.link|escape:'html':'UTF-8'}">
																	<img class="img-responsive" src="{$manuf.linkIMG}" alt="{$manuf.name}" />
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
				</div>
			
		</div>
	{/if}
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
