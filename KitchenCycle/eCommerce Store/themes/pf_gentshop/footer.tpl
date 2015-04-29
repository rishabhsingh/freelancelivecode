{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if !isset($content_only) || !$content_only}
						</div>
					</div><!-- #center_column -->
							{if isset($right_column_size) && !empty($right_column_size)}
								<div class="sidebar-content">
									<div id="right_column" class="col-xs-12 col-sm-{$right_column_size|intval} column sidebar">{$HOOK_RIGHT_COLUMN}</div>
								</div>
							{/if}
			
						</div><!-- #columns -->
				</div>

				{if $page_name =='index'}
				<div id="content-bottom" class="parallax">
					<div class="container">
						{hook h='displayContentBottom'}
					</div>
				</div>
				{/if}
			</section ><!-- .columns-container -->
			
			<!-- Bottom-->
			{if $page_name =='index'}
			<section id="bottom">
				<div class="">
					{hook h='displayBottom'}
				</div>
			</section>
			{/if}
		
			{if isset($HOOK_FOOTER)}
			<!-- Footer -->
			<footer id="footer">
				<section id="pts-footer-top" class="footer-top parallax">
					<div class="container">
					<div class="inner">
						<div class="row">
							{if class_exists('PtsthemePanel')}
								<div class="footer-block col-lg-12 col-md-12 col-sm-12 col-xs-12">
									{plugin module='blocknewsletter' hook='footer'}
								</div>
							{/if}
							
							{hook h='displayFootertop'}
						</div>
					</div>
				</div>
				</section>
				<section id="pts-footercenter" class="footer-center">
					<div class="container"><div class="inner">
						<div class="row">
							{$HOOK_FOOTER}
							
						</div>
					</div></div>
				</section>
				<section class="maplocal">
      				{hook h='displayMapLocal'}
	      			<div class="clearfix"></div>	
    			</section>

				<section id="powered">
					<div class="container"><div class="inner">
						<div class="row">
							<div id="pts-copyright" class="copyright">
								<div class="row">
									<div class="col-md-8 col-xs-12">
										{if isset($COPYRIGHT)&&$COPYRIGHT}
										<div class="copyright">{$COPYRIGHT}</div>
										{else}
										<p><span> Kitchen Cycle, LLC © {date('Y')} All Rights Reserved</span></p>
										{/if}
										<p></p>
									</div>
									<div class="col-md-4 col-xs-12">
									{if Configuration::get('PTS_CP_PAYPAL_SETTING')}
											<div class="paypal-copyright"></div>
										{/if}
									</div>
								</div>
							</div>
							<div id="footer-bottom" class="pull-right">
								{hook h='displayFooterbottom'}
							</div>
						</div>
					</div></div>
				</section>

			</footer>
				{/if}
		</div>

		<!-- #page -->
{/if}
{include file="$tpl_dir./global.tpl"}
	</body>
</html>