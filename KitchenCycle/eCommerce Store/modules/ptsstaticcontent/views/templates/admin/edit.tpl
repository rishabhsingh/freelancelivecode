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
<form method="post" action="{$postAction}&formedit=1&id_item={$hItem.id_item}" enctype="multipart/form-data" class="item-form defaultForm  form-horizontal">
    <input type="hidden" name="id_lang" value="{$lang.id_lang}" />
    <input type="hidden" name="item_id" value="{$hItem.id_item}" />
    <input type="hidden" name="item_order" value="{$hItem.item_order}" />
    <div class="image-display item-field form-group" style="text-align:center">
       <img src="{$module_dir}images/{$hItem.image}" alt="" title="" style="max-width:100%;{if !$hItem.image} display:none;{/if}" class="preview" />
   </div>
   <div class="delete item-field form-group">
       <label class="control-label col-lg-3">{l s='Delete Image' mod='ptsstaticcontent'}</label>
       <div class="col-lg-7">
           <input type="checkbox" name="delete_image" value="1" />
           <input type="hidden" name="old_image_name" value="{$hItem.image}">
       </div>
   </div>
    <div class="active item-field form-group">
       <label class="control-label col-lg-3">{l s='Active' mod='ptsstaticcontent'}</label>
       <div class="col-lg-7">
           <input type="checkbox" name="item_active" value="1"{if $hItem.active == 1} checked="checked"{/if} />
       </div>
   </div>
   <div class="title item-field form-group">
       <label class="control-label col-lg-3">{l s='Title' mod='ptsstaticcontent'}</label>
       <div class="col-lg-7">
           <input type="text" name="item_title" size="48" value="{$hItem.title}" />
       </div>
   </div>




   <div class="title_use item-field form-group">
       <label class="control-label col-lg-3">{l s='Use title in front' mod='ptsstaticcontent'}</label>
       <div class="col-lg-7">
           <input type="checkbox" name="item_title_use" value="1"{if $hItem.title_use == 1} checked="checked"{/if} />
       </div>
   </div>
    <div class="image_w item-field form-group">
        <label class="control-label col-lg-3">{l s='Addition Class' mod='ptsstaticcontent'}</label>
        <div class="col-lg-7">
            <input name="class" type="text" size="4" value="{$hItem.class}"/>
        </div>
    </div>

   <div class="hook item-field form-group">
       <label class="control-label col-lg-3">{l s='Hook' mod='ptsstaticcontent'}</label>
       <div class="col-lg-7">
           <select name="item_hook" default="home">
                {foreach $modulehooks as $modhook}
               <option value="{$modhook}" {if $hItem.hook == $modhook} selected="selected"{/if}>{$modhook}</option>  
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
           <input name="item_img_w" type="text" maxlength="4" size="4" value="{$hItem.image_w}"/>
       </div>
   </div>
   <div class="image_h item-field form-group">
       <label class="control-label col-lg-3">{l s='Image height' mod='ptsstaticcontent'}</label>
       <div class="col-lg-7">
           <input name="item_img_h" type="text" maxlength="4" size="4" value="{$hItem.image_h}"/>
       </div>
   </div>

    <div class="col_lg item-field form-group">
        <label class="control-label col-lg-3">{l s='Column Width In Large Screen' mod='ptsstaticcontent'}</label>
        <div class="col-lg-7">
            <input name="col_lg" type="text" maxlength="4" size="4" value="{$hItem.col_lg}"/>
        </div>
    </div>

   <div class="url item-field form-group">
       <label class="control-label col-lg-3">{l s='URL' mod='ptsstaticcontent'}</label>
       <div class="col-lg-7">
           <input type="text" name="item_url" size="48" value="{$hItem.url}" />
       </div>
   </div>
   <div class="target item-field form-group">
       <label class="control-label col-lg-3">{l s='Target blank' mod='ptsstaticcontent'}</label>
       <div class="col-lg-7">
           <input type="checkbox" name="item_target" value="1"{if $hItem.target == 1} checked="checked"{/if} />
       </div>
   </div>
   <div class="html item-field form-group">
       <label class="control-label col-lg-3">{l s='HTML' mod='ptsstaticcontent'}</label>
       <div class="col-lg-7">
           <textarea name="item_html" class="rte autoload_rte" cols="65" rows="12">{$hItem.html}</textarea>
       </div>
   </div>
   <div class="form-group">
        <div class="col-lg-9 col-lg-offset-3">
           <button type="submit" name="removeItem" class="button btn btn-default button-remove" onClick="this.form.submit();"><i class="icon-remove-sign"></i>{l s='Remove' mod='ptsstaticcontent'}</button>
           <button type="submit" name="updateItem" class="button btn btn-danger button-save" onClick="this.form.submit();"><i class="icon-save"></i>{l s='Save' mod='ptsstaticcontent'}</button>
        </div>
   </div>
</form>
<script type="text/javascript">
    var iso = '{$isoTinyMCE}' ;
    var pathCSS = '{$_THEME_CSS_DIR_}' ;
    var ad = '{$ad}' ;
    tinySetup();
</script>