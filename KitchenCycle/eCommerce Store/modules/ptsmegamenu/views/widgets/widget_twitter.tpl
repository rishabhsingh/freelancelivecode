{*
* Pts Prestashop Theme Framework for Prestashop 1.6.x
*
* @package   ptsmegamenu
* @version   2.5
* @author    http://www.prestabrain.com
* @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
*               <info@prestabrain.com>.All rights reserved.
* @license   GNU General Public License version 2
*}
{if isset($username)}
<div class="widget-twitter block">
	{if isset($widget_heading)&&!empty($widget_heading)}
	<div class="widget-heading title_block">
		{$widget_heading}
	</div>
	{/if}
	<div class="widget-inner block_content">
		<a class="twitter-timeline" data-dnt="true" data-theme="{$theme}" data-link-color="#FFFFFF" width="{$width}" height="{$height}" data-chrome="{$chrome}" data-border-color="{$border_color}" lang="EN" data-tweet-limit="{$count}" data-show-replies="{$show_replies}" href="https://twitter.com/{$username}"  data-widget-id="{$twidget_id}">Tweets by @{$username}</a>
		{$js}
	</div>
</div>
{/if} 