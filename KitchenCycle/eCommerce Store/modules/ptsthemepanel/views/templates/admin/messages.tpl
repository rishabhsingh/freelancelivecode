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
<div id="{$id|escape:'htmlall':'UTF-8'}-response" {if !isset($text)}style="display:none;"{/if} class="message alert alert-{if isset($class) && $class=='error'}danger{else}success{/if}">
	<div>{if isset($text)}{$text|escape:'htmlall':'UTF-8'}{/if}</div>
</div>