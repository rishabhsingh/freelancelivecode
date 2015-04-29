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
<div id="htmlcontent" class="clearfix">
    <h2>{$htmlcontent.info.name} (v.{$htmlcontent.info.version})</h2>
    {if isset($error) && $error}
        {include file="{$htmlcontent.admin_tpl_path}messages.tpl" id="main" text=$error class='error'}
    {/if}
    {if isset($confirmation) && $confirmation}
        {include file="{$htmlcontent.admin_tpl_path}messages.tpl" id="main" text=$confirmation class='conf'}
    {/if}
    <!-- New -->
     {include file="{$htmlcontent.admin_tpl_path}items.tpl" dcol=$htmlitems.autocol}
    {include file="{$htmlcontent.admin_tpl_path}new.tpl" dcol=$htmlitems.autocol}
    <!-- Slides -->
   
</div>
