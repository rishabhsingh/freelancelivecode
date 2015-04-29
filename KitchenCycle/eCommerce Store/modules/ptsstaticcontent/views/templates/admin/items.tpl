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
<ul class="lang-tabs nav nav-tabs">
    {foreach from=$htmlitems.lang.all item=lang}
		<li id="lang-{$lang.id_lang}" class="lang-flag{if $lang.id_lang == $htmlitems.lang.default.id_lang} active{/if}"><img src="../img/l/{$lang.id_lang}.jpg" class="pointer" alt="{$lang.name}" title="{$lang.name}" /> {$lang.name}</li>
    {/foreach}
</ul>
<div class="lang-items clearfix">

{foreach name=langs from=$htmlitems.items key=lang item=langItems}
	<div class="accordion-wrapper"  >
    <div id="items-{$lang}" class="lang-content accordion" style="display:{if $lang == $htmlitems.lang.default.id_lang}block{else}none{/if};">

    {foreach name=hooks from=$langItems key=hook item=hookItems}
        <div class="accordion-group panel panel-default">
        
        <div class="accordion-heading panel-heading">
            <a class="hook-title accordion-toggle" data-toggle="collapse" data-parent="#items-{$lang}" href="#collapse{$hook}-{$lang}" >
                {l s='Hook' mod='ptsstaticcontent'} "{$hook}"
                <span class="label label-danger">{count($hookItems)}</span>
            </a>
        </div>
        <div class="accordion-body collapse" id="collapse{$hook}-{$lang}">
        {if $hookItems}
            <ul id="items" class="row">
                {foreach name=items from=$hookItems item=hItem}
                    <li id="item-{$hItem.id_item}" class="item  col-md-3 {if $hItem.active!=1} inactive {/if}" style="clear:none"><div class="panel">
                        <span class="item-order">{if $hItem.item_order le 9}0{/if}{$hItem.item_order}</span>
                        <!--<i class="icon-sort"></i>-->
                        <span class="item-title">{$hItem.title}</span>
                        <span class="button btn btn-default button-edit pull-right hide"><i class="icon-edit"></i>{l s='Edit' mod='ptsstaticcontent'}</span>
                        <span class="button btn btn-default button-close pull-right"><i class="icon-remove"></i>{l s='Close' mod='ptsstaticcontent'}</span>
                        <div class="pull-right">
                             {if $hItem.image}
                            <a class="button btn btn-info pts-modal" href="{$module_dir}images/{$hItem.image}" title="{l s=$hItem.image mod='ptsstaticcontent'}"><span class="icon icon-picture-o"></span></a>
                            {/if}
                            
                            <a href="{$htmlitems.postAction}&id=3&setActiveAction=1" title="{l s='Set Active Status' mod='ptsstaticcontent'}" data-active="{$hItem.active}" data-id="{$hItem.id_item}" class="btn btn-activeaction btn-warning">
                                <span class="icon icon-circle"></span>
                            </a> 
                            <a href="{$htmlitems.postAction}&formedit=1&id_item={$hItem.id_item}" class="fancybox button btn btn-danger button-edit " title="{l s='Edit' mod='ptsstaticcontent'}">
                                <i class="icon-edit"></i>
                            </a>
                        </div>
                   </div> </li>
                {/foreach}
            </ul>
        {else}
            <div class="item">
                {l s='No items available' mod='ptsstaticcontent'}
            </div>
        {/if}
         </div>
    </div>
    {/foreach}
	</div>
{/foreach}
</div>
<hr>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $('.fancybox').fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'	:	600, 
		'speedOut'	:	200, 
		'overlayShow'	:	false,
                'type' : 'iframe'
	});
    });
</script>