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
<div class="new-item">
	<div class="form-group clearfix">
    	<span class="button btn btn-default new-item"><i class="icon-plus-sign"></i>{l s='Add item' mod='ptsstaticcontent'}</span>
    </div>
    <div class="item-container">
        <form method="post" action="{$htmlitems.postAction}" enctype="multipart/form-data" class="item-form defaultForm  form-horizontal">
        	<div class="panel">
                <div class="language item-field form-group">
                    <label class="control-label col-lg-3">{l s='Language' mod='ptsstaticcontent'}</label>
                    <div class="col-lg-7">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
                            <span id="selected-language">
                            {foreach from=$htmlitems.lang.all item=lang}
                                {if $lang.id_lang == $htmlitems.lang.default.id_lang} {$lang.iso_code}{/if}
                            {/foreach}
                            </span>
                            <span class="caret">&nbsp;</span>
                        </button>
                        <ul class="languages dropdown-menu">
                            {foreach from=$htmlitems.lang.all item=lang}
                                <li id="lang-{$lang.id_lang|escape:'htmlall':'UTF-8'}" class="new-lang-flag"><a href="javascript:setLanguage({$lang.id_lang|escape:'htmlall':'UTF-8'}, '{$lang.iso_code|escape:'htmlall':'UTF-8'}');">{$lang.name|escape:'htmlall':'UTF-8'}</a></li>
                            {/foreach}
                        </ul>
                        <input type="hidden" id="lang-id" name="id_lang" value="{$htmlitems.lang.default.id_lang}" />
                    </div>
                </div>
                
                <div class="title item-field form-group">
                    <label class="control-label col-lg-3 ">{l s='Title' mod='ptsstaticcontent'}</label>
                    <div class="col-lg-7">
                    	<input class="form-control" type="text" name="item_title" size="48" value="" />
                    </div>
                </div>

                 


                <div class="title_use item-field form-group">
                    <label class="control-label col-lg-3">{l s='Use title in front' mod='ptsstaticcontent'}</label>
                    <input type="checkbox" name="item_title_use" value="1" />
                </div>
                <div class="image_w item-field form-group">
                    <label class="control-label col-lg-3">{l s='Addition Class' mod='ptsstaticcontent'}</label>
                    <div class="col-lg-7">
                    	<input name="class" type="text" size="4" value=""/>
                    </div>
                </div>
                    
                <div class="hook item-field form-group">
                    <label class="control-label col-lg-3">{l s='Hook' mod='ptsstaticcontent'}</label>
                    <div class="col-lg-7">
                        <select class="form-control" name="item_hook" default="home">
                           {foreach $htmlitems.modulehooks as $hook}
                           <option value="{$hook}">{$hook}</option>  
                            {/foreach} 
                        </select>
                    </div>
                </div>
                <div class="image item-field form-group">
                    <label class="control-label col-lg-3">{l s='Image' mod='ptsstaticcontent'}</label>
                    <div class="col-lg-7">
                    	<input type="file" name="item_img" />
                    </div>
                </div>
                <div class="image_w item-field form-group">
                    <label class="control-label col-lg-3">{l s='Image width' mod='ptsstaticcontent'}</label>
                    <div class="col-lg-7">
                    	<input name="item_img_w" type="text" maxlength="4" size="4" value=""/>
                    </div>
                </div>
                <div class="image_h item-field form-group">
                    <label class="control-label col-lg-3">{l s='Image height' mod='ptsstaticcontent'}</label>
                    <div class="col-lg-7">
                   		<input name="item_img_h" type="text" maxlength="4" size="4" value=""/>
                    </div>
                </div>

                <div class="col_lg item-field form-group">
                    <label class="control-label col-lg-3">{l s='Column Width In Large Screen' mod='ptsstaticcontent'}</label>
                    <div class="col-lg-7">
                        <input name="col_lg" type="text" maxlength="4" size="4" value=""/>
                    </div>
                </div>



                <div class="url item-field form-group">
                    <label class="control-label col-lg-3">{l s='URL' mod='ptsstaticcontent'}</label>
                    <div class="col-lg-7">
                    	<input type="text" name="item_url" size="48" value="http://" />
                    </div>
                </div>
                <div class="target item-field form-group">
                    <label class="control-label col-lg-3">{l s='Target blank' mod='ptsstaticcontent'}</label>
                    <div class="col-lg-7">
                    	<input type="checkbox" name="item_target" value="1" />
                    </div>
                </div>
                <div class="html item-field form-group">
                    <label class="control-label col-lg-3">{l s='HTML' mod='ptsstaticcontent'}</label>
                    <div class="col-lg-7">
                    	<textarea  class="rte autoload_rte" name="item_html" cols="65" rows="12"></textarea>
                    </div>
                </div>
                <div class="form-group">
                	<div class="col-lg-9 col-lg-offset-3">
                		<button type="submit" name="newItem" class="button-save btn btn-default" onClick="this.form.submit();">{l s='Save' mod='ptsstaticcontent'}</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var iso = '{$htmlitems.isoTinyMCE}' ;
    var pathCSS = '{$htmlitems._THEME_CSS_DIR_}' ;
    var ad = '{$htmlitems.ad}' ;
    tinySetup();
</script>
<script type="text/javascript">
	function setLanguage(language_id, language_code) {
		$('#lang-id').val(language_id);
		$('#selected-language').html(language_code);
	}
</script>