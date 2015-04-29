<header id="header" class="header-v2">
	<section id="topbar" class="topbar-v2 col-md-12 col-sm-7 col-xs-7">
		<div class="container clearfix">
			<div class="quick-access">
				{hook h="displayNav"}
			</div>
		</div>
	</section>	
	<div class="clearfix"></div>
	<section class="main-menu mainnav-v2">
	    <div class="container">
	    	<div class="row">
	    		<div class="hidden-lg col-md-3 col-sm-3 col-xs-12 logo inner">
					<div id="logo-theme-1" class="logo-store">
					{if Configuration::get('PTS_CP_LOGOTYPE') == 'logo-theme'}
						<div class="logo-theme">
							<a href="{$base_dir}" title="{$shop_name|escape:'html':'UTF-8'}">
								<img src="{$img_dir}logo-theme-black.png" alt="logo"/>
							</a>
						</div>
					{else}
						<a href="{$base_dir}" title="{$shop_name|escape:'html':'UTF-8'}">
								<img class="logo img-responsive" src="{$logo_url}" alt="{$shop_name|escape:'html':'UTF-8'}"{if isset($logo_image_width) && $logo_image_width} width="{$logo_image_width}"{/if}{if isset($logo_image_height) && $logo_image_height} height="{$logo_image_height}"{/if}/>
						</a>
					{/if}
					</div>
				</div>

	    		<div id="pts-mainnav" class="mainnav-v2 col-lg-5 col-md-9 col-sm-9 col-xs-10">	
	        		{hook h="displayMainmenu"}
	        	</div>

	    		<div class="col-lg-2 hidden-md hidden-sm hidden-xs logo inner">
					<div id="logo-theme" class="logo-store">
					{if Configuration::get('PTS_CP_LOGOTYPE') == 'logo-theme'}
						<div class="logo-theme">
							<a href="{$base_dir}" title="{$shop_name|escape:'html':'UTF-8'}">
								<img src="{$img_dir}logo-theme-black.png" alt="logo"/>
							</a>
						</div>
					{else}
						<a href="{$base_dir}" title="{$shop_name|escape:'html':'UTF-8'}">
								<img class="logo img-responsive" src="{$logo_url}" alt="{$shop_name|escape:'html':'UTF-8'}"{if isset($logo_image_width) && $logo_image_width} width="{$logo_image_width}"{/if}{if isset($logo_image_height) && $logo_image_height} height="{$logo_image_height}"{/if}/>
						</a>
					{/if}
					</div>
				</div>


				<div class="col-lg-5 quick-action pull-right">
					{if isset($HOOK_TOP)}{$HOOK_TOP}{/if}
				</div>	
					
	    	</div>
	    </div>
	</section>
</header>