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
<div id="pts-paneltool" class="hidden-xs hidden-sm pts-paneltool">


	<div class=" pts-panelbutton">
		<i class="icon icon-magic"></i>
	</div>

<div class="paneltool editortool pts-panelcontent">
<form  enctype="multipart/form-data" action="{$actionURL|escape:'html':'UTF-8'}" id="formliveedittheme" method="post">



<div id="ptscustomize" class="pts-customize panelcontent editortool clearfix">
	 
	<p>
		<b>{l s='Custom Theme Profiles Management' mod='ptsthemepanel'}</b>
	</p>
	<div class="buttons-action row">

		<div class="col-sm-6">
			<select id="saved-files" name="saved_file">
				<option value="">{l s='Create New Profile'}</option>
				{foreach $profiles as $profile}
				<option value="{$profile}" {if $profile==$selectedprofile} selected="selected" {/if}>{$profile}</option>
				{/foreach}
			</select> 
		</div>
		{if $isliveeditor}
		<div class=" col-sm-6">
			<input type="text" name="newfile" size="18">
		</div>
		{/if}
	</div>

		{if $isliveeditor}
		<div class="buttons-group clearfix"> 

			<input type="hidden" id="action-mode" name="action-mode"/>	
 			<div class="pull-left">
	 			<button type="submit" onclick="return confirm('{l s='Are you sure to delete?'}')" name="submitPtsLiveConfiguratorDelete" title="{l s='Delete This Profile'}" class="btn btn-primary btn-danger btn-sm" value="1">
					<span class="icon icon-trash"></span>
				</button>
				
			</div>
			<div class="pull-right">
				<button type="submit" name="submitPtsLiveConfigurator" class="btn btn-warning btn-sm" value="1">
					{l s='Save Profile' mod='ptsthemepanel'}
				</button>
				<button type="submit" name="submitPtsLiveConfiguratorActiveProfile" class="btn btn-primary btn-sm" value="1">
					{l s='Active' mod='ptsthemepanel'}
				</button>		 
			</div>
		
		</div>	
		{/if}

	<div class="wrapper  clearfix"><div id="customize-form">
	<div class="groups">
	 
		<div class="clearfix" id="customize-body">
				<ul class="nav nav-tabs pts-tabs">
				  {foreach $xmlselectors as $for => $output}
		       	  <li><a href="#tab-{$for}">{$for}</a></li> 
	       	      {/foreach}  
		        </ul>
		        <div class="tab-content" > 
		        	 {foreach $xmlselectors as $for => $items}
		            <div class="tab-pane" id="tab-{$for}">
		            	{if !empty($items)}
		            	<div class="pts-panelcollapse"  id="custom-accordion{$for}">
		            	{foreach $items as $group}
		            	    <div class="panel panel-default panel-group ">
                               <div class="panel-heading">
	                              <div class="panel-title"><a data-toggle="collapse" data-parent="#custom-accordion{$for}" href="#collapse{$group.match}">
	                               		{$group.header}	 
	                              </a></div>
	                            </div>

	                            <div id="collapse{$group.match}" class="panel-collapse collapse">
	                                <div class="panel-body">
	                              	{foreach $group.selector as $item}
									
									  {if isset($item.type)&&$item.type=="image"}	
									  <div class="form-group background-images"> 
											<label>{$item.label}</label>
											<a class="clear-bg" href="#"><span class="icon icon-eraser"></span></a>
											<input value="" type="hidden" name="customize[{$group.match}][]" data-match="{$group.match}" class="input-setting" data-selector="{$item.selector}" data-attrs="background-image">

											<div class="clearfix"></div>
											 <p><em style="font-size:10px">Those Images in folder YOURTHEME/img/patterns/</em></p>
											<div class="bi-wrapper clearfix">
											{foreach $patterns as $pattern}
											<div style="background:url('{$backgroundImageURL}{$pattern}') no-repeat center center;" class="pull-left" data-image="{$backgroundImageURL}{$pattern}" data-val="../../img/patterns/{$pattern}">

											</div>
											{/foreach}
	                                    </div>
	                                  </div>
	                                  {elseif $item.type=="fontfamily"}
	                                   <div class="form-group">
	                                   	<label>{$item.label}</label>
	                                  	<select name="customize[{$group.match}][]" data-match="{$group.match}" class="input-setting" data-selector="{$item.selector}" data-attrs="{$item.attrs}">
											<option value="inherit">Inherit</option>
											{foreach from=$fonts key=k item=font}
											<option value="{$font.value}">{$font.label}</option>
											{/foreach}
										</select>	<a href="#" class="clear-bg"><span class="icon icon-eraser"></span></a>
	                                  </div>
	                             

	                                  {elseif $item.type=="fontsize"}
	                                   <div class="form-group">
	                                   	<label>{$item.label}</label>
	                                  	<select name="customize[{$group.match}][]" data-match="{$group.match}" class="input-setting" data-selector="{$item.selector}" data-attrs="{$item.attrs}">
											<option value="">Inherit</option>
											{for $i=9 to 16}
											<option value="{$i}">{$i}</option>
											{/for}
										</select>	<a href="#" class="clear-bg"><span class="icon icon-eraser"></span></a>
	                                  </div>
	                                  {else}
	                                  <div class="form-group">
										<label>{$item.label}</label>
										<input value="" size="10" name="customize[{$group.match}][]" data-match="{$group.match}" type="text" class="input-setting" data-selector="{$item.selector}" data-attrs="{$item.attrs}"><a href="#" class="clear-bg"><span class="icon icon-eraser"></span></a>
									</div>
	                                  {/if}


									{/foreach}
	                              </div>
	                            </div>
		                    </div>          	
		            	{/foreach}
		           		 </div>
		            	{/if}
		            </div>
	           		{/foreach}
		        </div>    	
		    </div>    


	</div>

</div></div></div>
</form>

</div>

</div>
 

 <script type="text/javascript">
$(document).ready( function(){
	 $('#pts-paneltool').PtsPanelTools({ url:'{$customizeFolderURL}', 'profile': '{$selectedprofile}' } );
});
</script>