{*
* Pts Prestashop Theme Framework for Prestashop 1.6.x
*
* @package   ptsthemepanel
* @version   1.6
* @author    http://www.prestabrain.com
* @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
*               <info@prestabrain.com>.All rights reserved.
* @license   GNU General Public License version 2
*}
 <div id="pts-panelthemechanger" class="hidden-xs hidden-sm pts-paneltool themechanger">


		<div class=" pts-panelbutton">
			<i class="icon icon-gear"></i>
		</div>
		<div class="paneltool editortool pts-panelcontent"><div class="pts-customize panelcontent">
			<form action="#" method="post" id="panethemesettingfrm">
					<div class="form-group">
						<div class="pts-paneltitle"><b>{l s='RTL Mode' mod='ptsthemepanel'}</b>
							<select name="rtl_mode" id="pts-themelangrtl">
								<option value="0">{l s='No'}</option>
								<option value="1">{l s='Yes'}</option>
								
							</select>
						</div>
					</div>
			 		<div class="pts-paneltitle"><b>{l s='Theme Skins' mod='ptsthemepanel'}</b></div>
					<div class="form-group">
						{if isset($themes)}
							<div id="pts-themecollection" class="themecollection clearfix">
								{foreach $themes as $theme}
									<div class="theme-{$theme.skin|escape:'htmlall':'UTF-8'} btn-switchskin" data-theme="{$theme.skin|escape:'htmlall':'UTF-8'}">
										<div class="theme-preview" ></div>
										{if $theme.rehook && $isliveeditor}	
										<div class="clearfix">
											<label for="">{l s='Re-Hook, Config' mod='ptsthemepanel'}</label> 
											 {l s='Yes' mod='ptsthemepanel'}: <input type="radio" name="{$theme.skin}_rehook" value="1">
											 {l s='No' mod='ptsthemepanel'}: <input checked="checked" type="radio" name="{$theme.skin}_rehook" value="0"> 
										</div>
										{/if}
									</div>	
								{/foreach}
							</div>
						{/if}
						<input type="hidden" name="themeskin" value="{$themeskin}"/>
			 		</div>
			 		{if $isliveeditor}
					<div class="btn-tools">
						
						<button type="button" class="btn btn-primary" id="btn-resettheme" name="resetLiveConfigurator">{l s='Reset' mod='ptsthemepanel'}</button>
						<button type="submit" class="btn btn-warning" name="submitLiveThemeChanger">{l s='Save' mod='ptsthemepanel'}</button>
					</div>
					{else}
						<button type="submit" class="btn btn-primary" id="btn-resettheme" name="resetDemoTheme">{l s='Reset' mod='ptsthemepanel'}</button>
						<button type="submit" class="btn btn-warning" name="applyCustomSkinChanger">{l s='Apple Change Now' mod='ptsthemepanel'}</button>
					{/if}
	 
			</form>
		</div></div>
</div>