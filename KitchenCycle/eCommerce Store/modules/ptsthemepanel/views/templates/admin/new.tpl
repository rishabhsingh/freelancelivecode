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
<div class="new-item">
	<div class="form-group">
		<button type="button" class="btn btn-default btn-lg button-new-item"><i class="icon-plus-sign"></i> {l s='Add item' mod='themeconfigurator'}</button>
	</div>
	<div class="item-container">
		<form method="post" action="{$htmlitems.postAction|escape:'htmlall':'UTF-8'}" enctype="multipart/form-data" class="item-form defaultForm  form-horizontal">
			<div class="well">
				<div class="language item-field form-group">
					<label class="control-label col-lg-3">{l s='Language' mod='themeconfigurator'}</label>
					<div class="col-lg-7">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
							<span id="selected-language">
							{foreach from=$htmlitems.lang.all item=lang}
								{if $lang.id_lang == $htmlitems.lang.default.id_lang} {$lang.iso_code|escape:'htmlall':'UTF-8'}{/if}
							{/foreach}
							</span>
							<span class="caret">&nbsp;</span>
						</button>
						<ul class="languages dropdown-menu">
							{foreach from=$htmlitems.lang.all item=lang}
								<li id="lang-{$lang.id_lang|escape:'htmlall':'UTF-8'}" class="new-lang-flag"><a href="javascript:setLanguage({$lang.id_lang|escape:'htmlall':'UTF-8'}, '{$lang.iso_code|escape:'htmlall':'UTF-8'}');">{$lang.name|escape:'htmlall':'UTF-8'}</a></li>
							{/foreach}
						</ul>
						<input type="hidden" id="lang-id" name="id_lang" value="{$htmlitems.lang.default.id_lang|escape:'htmlall':'UTF-8'}" />
					</div>
				</div>
				<div class="title item-field form-group">
					<label class="control-label col-lg-3 ">{l s='Title' mod='themeconfigurator'}</label>
					<div class="col-lg-7">
						<input class="form-control" type="text" name="item_title"/>
					</div>
				</div>
				<div class="title_use item-field form-group">
					<div class="col-lg-9 col-lg-offset-3">
						<div class="checkbox">
							<label class="control-label">
								{l s='Use title in front' mod='themeconfigurator'}
								<input type="checkbox" name="item_title_use" value="1" />
							</label>
						</div>
					</div>
				</div>
				<div class="hook item-field form-group">
					<label class="control-label col-lg-3">{l s='Hook' mod='themeconfigurator'}</label>
					<div class="col-lg-7">
						<select class="form-control fixed-width-lg" name="item_hook" default="home">
							<option value="home">home</option>  
							<option value="top">top</option>
							<option value="left">left</option>
							<option value="right">right</option>
							<option value="footer">footer</option>  
						</select>
					</div>
				</div>
				<div class="image item-field form-group">
					<label class="control-label col-lg-3">{l s='Image' mod='themeconfigurator'}</label>
					<div class="col-lg-7">
						<input type="file" name="item_img" />
					</div>
				</div>
				<div class="image_w item-field form-group">

					<label class="control-label col-lg-3">{l s='Image width' mod='themeconfigurator'}</label>
					<div class="col-lg-7">
						<div class="input-group fixed-width-lg">
							<span class="input-group-addon">{l s='px'}</span>
							<input name="item_img_w" type="text" maxlength="4"/>
						</div>
					</div>
				</div>
				<div class="image_h item-field form-group">
					<label class="control-label col-lg-3">{l s='Image height' mod='themeconfigurator'}</label>
					<div class="col-lg-7">
						<div class="input-group fixed-width-lg">
							<span class="input-group-addon">{l s='px'}</span>
							<input name="item_img_h" type="text" maxlength="4"/>
						</div>
					</div>
				</div>
				<div class="url item-field form-group">
					<label class="control-label col-lg-3">{l s='URL' mod='themeconfigurator'}</label>
					<div class="col-lg-7">
						<input type="text" name="item_url" placeholder="http://" />
					</div>
				</div>
				<div class="target item-field form-group">
					<div class="col-lg-9 col-lg-offset-3">
						<div class="checkbox">
							<label class="control-label">
								{l s='Target blank' mod='themeconfigurator'}
								<input type="checkbox" name="item_target" value="1" />
							</label>
						</div>
					</div>
				</div>
				<div class="html item-field form-group">
					<label class="control-label col-lg-3">{l s='HTML' mod='themeconfigurator'}</label>
					<div class="col-lg-7">
						<textarea name="item_html" cols="65" rows="12"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-7 col-lg-offset-3">
						<button type="button" class="btn btn-default button-new-item-cancel"><i class="icon-remove"></i> {l s='Cancel' mod='themeconfigurator'}</button>
						<button type="submit" name="newItem" class="button-new-item-save btn btn-default pull-right" onClick="this.form.submit();"><i class="icon-save"></i> {l s='Save' mod='themeconfigurator'}</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	function setLanguage(language_id, language_code) {
		$('#lang-id').val(language_id);
		$('#selected-language').html(language_code);
	}
</script>
