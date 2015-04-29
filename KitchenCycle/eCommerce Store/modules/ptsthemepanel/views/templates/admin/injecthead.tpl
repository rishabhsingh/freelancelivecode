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
<div class="hide"><div id="ptswarninginstall">
	<div class="bootstrap" style="width:550px; margin:20px;">  
	<div class="alert alert-danger" >

		<h4>{l s='You have been switched to new theme for your store.' mod='ptsthemepanel'}</h4>
		<p>{l s='May be you need install default data samples and data configurations for modules to take look same as our demo' mod='ptsthemepanel' mod='ptsthemepanel'}</p>
	</div>
	 <p>
	 	<a href="{$url}#sitetools" class="btn btn-lg btn-danger">{l s='Install Sample Now' mod='ptsthemepanel'}<br><em style="font-size:10px">{l s='Automatic Install Sample in Theme Control Panel' mod='ptsthemepanel'}</em></a> 
	 	<a href="{$url}" class="btn btn-lg btn-info">{l s='UserGuide' mod='ptsthemepanel'}<br><em style="font-size:10px">{l s='Manually Installing Sample Via Reading Guides' mod='ptsthemepanel'} </em></a> 
	 </p>
	 <p>
	 	<em>!!!{l s='Close this popup it will be not showed in next time' mod='ptsthemepanel'}</em>
	 </p>
</div></div></div>
<script type="text/javascript">
		
		jQuery.fancybox( {
			onStart:function () { 
					delay(9000);
			},
			padding: "0px",
			autoScale: true,
			transitionIn: "fade",

			transitionOut: "fade",
			showCloseButton: false,
			type: "inline",
			href: "#ptswarninginstall",
			afterClose:function(){	
				$.ajax({
					url: "{$url}&closePopup=1"
				}).done(function() {
				 
				});	 	
			} 
		});
		jQuery("#ptswarninginstall").trigger("click"); 


</script>