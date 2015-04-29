<header id="header" class="header-top-v4 navbar">

    <section class="main-menu mainnav-v4">
        <div class="container">
        	<div class="row">
        		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 logo inner">
					<div id="logo-theme" class="logo-store">
					{if Configuration::get('PTS_CP_LOGOTYPE') == 'logo-theme'}
						<div class="logo-theme">
							<a href="{$base_dir}" title="{$shop_name|escape:'html':'UTF-8'}">
								<img src="{$img_dir}logo-theme-white.png" alt="logo"/>
							</a>
						</div>
					{else}
						<a href="{$base_dir}" title="{$shop_name|escape:'html':'UTF-8'}">
								<img class="logo img-responsive" src="{$logo_url}" alt="{$shop_name|escape:'html':'UTF-8'}"{if isset($logo_image_width) && $logo_image_width} width="{$logo_image_width}"{/if}{if isset($logo_image_height) && $logo_image_height} height="{$logo_image_height}"{/if}/>
						</a>
					{/if}
					</div>
				</div>

				<div id="pts-mainnav" class="col-lg-10 col-md-10 col-sm-12 col-xs-12">	
					<div class="quick-action pull-right">
						{hook h="displayNav"}
						{if isset($HOOK_TOP)}{$HOOK_TOP}{/if}
					</div>
					<div class="pull-right pts-mainmenu">
            			{hook h="displayMainmenu"}
            		</div>	
            	</div>
        	</div>
        </div>
    </section>

</header>