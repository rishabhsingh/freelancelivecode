{*
* Pts Prestashop Theme Framework for Prestashop 1.6.x
*
* @package   ptsstaticcontent
* @version   2.1
* @author    http://www.prestabrain.com
* @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
*               <info@prestabrain.com>.All rights reserved.
* @license   GNU General Public License version 2
*}
<div id="gear-right">
	<i class="icon-cogs icon-2x icon-light"></i>
</div>
<form action="?live_configurator=1" method="post">
	<input type="hidden" name="theme" id="theme" value="{$theme}"/>
	<div id="tool_customization">
		<p>
			{l s='The customization tool allows you to make color and font changes in your theme.' mod='ptsstaticcontent'}<br /><br />
			<span>
				{l s='Only you, as a merchant can see this tool (as you are currently logged in your Back-office), your visitors will not see this tool.' mod='ptsstaticcontent'}
			</span>
		</p>
		<div class="list-tools">
			<p id="theme-title">
			  {l s='Color theme' mod='ptsstaticcontent'} 
			  <i class="icon-caret-down pull-right"></i> 
			</p>
		</div>
		{if isset($themes)}
		<div id="color-box">
			<ul>
				{foreach $themes as $theme}
				<li class="{$theme}">
					<div class="color-theme1 color1"></div>
					<div class="color-theme2 color2"> </div>
				</li>
				{/foreach}
			</ul>
		</div>
		{/if}
		<div class="list-tools">
			<p id="font-title">
			  {l s='Font' mod='ptsstaticcontent'} 
			  <i class="icon-caret-down pull-right"></i> 
			</p>
		</div>
		<div id="font-box">
			<p>{l s='Global' mod='ptsstaticcontent'}</p>
			<select name="font" id="font" class="font-list">
				<option value="">{l s='Choose a font' mod='ptsstaticcontent'}</option>
				{foreach $fonts as $key => $font}
				<option value="{$key}">{$font}</option>
				{/foreach}
			</select>
		</div>
		<div class="btn-tools">
			<button type="reset" class="btn btn-1" id="reset">{l s='Reset' mod='ptsstaticcontent'}</button>
			<button type="submit" class="btn btn-2" name="submitLiveConfigurator">{l s='Save' mod='ptsstaticcontent'}</button>
		</div>
		<div id="block-advertisement">
			<img src="{$advertisement_image}" alt="{$advertisement_text}" />
		</div>
	</div>
</form>