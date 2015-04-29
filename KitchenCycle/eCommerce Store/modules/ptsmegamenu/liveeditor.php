<?php
/******************************************************
 * @package Pav Megamenu module for Opencart 1.5.x
 * @version 1.0
 * @author http://www.pavothemes.com
 * @copyright	Copyright (C) Feb 2013 PavoThemes.com <@emai:pavothemes@gmail.com>.All rights reserved.
 * @license		GNU General Public License version 2
*******************************************************/

 
	$module_row=0; 
?>
<?php if( 1 )  { ?>
 
<style type="text/css">
	#page-content{
		min-height: 1200px;
		width: 100%;
		padding-bottom: 100px
	}
</style>
 
<div id="page-content">
<div id="menu-form"  style="display: none; left: 340px; top: 15px; max-width:600px" class="popover top out form-setting">
		<div class="arrow"></div>
		<div style="display: block;" class="popover-title"><?php echo $this->l('Sub Menu Setting ');?><span class="badge pull-right"><span class="icon icon-times-circle"></span></span></div>
		<div class="popover-content"> 
			<form  method="post" action="<?php echo $liveedit_action;?>"  enctype="multipart/form-data" >
			<div class="col-lg-12">	
			<table class="table table-hover">
		 
				<tr>
					<td><?php echo $this->l('Create Submenu');?></td>
					<td>
						<select name="menu_submenu" class="menu_submenu">
							<option value="0"><?php echo $this->l('No');?></option>
							<option value="1"><?php echo $this->l('Yes');?></option>
						</select>
					</td>
				</tr>
				
				<tr>
					<td><?php echo $this->l('Submenu Width');?></td>
					<td>
						 <input type="text" name="menu_subwidth" class="menu_subwidth"> 
					</td>
				</tr>
				<tr>
					<td><?php echo $this->l( 'Alignment' ); ?></td>
					<td>
						<div class="btn-group button-alignments">
						  <button type="button" class="btn btn-default" data-option="aligned-left"><span class="icon icon-align-left"></span></button>
						  <button type="button" class="btn btn-default" data-option="aligned-center"><span class="icon icon-align-center"></span></button>
						  <button type="button" class="btn btn-default" data-option="aligned-right"><span class="icon icon-align-right"></span></button>
						  <button type="button" class="btn btn-default" data-option="aligned-fullwidth"><span class="icon icon-align-justify"></span></button>
						</div>

					</td>
				</tr>
									
					<tr>
					<td colspan="2">
						<button type="button" class="add-row btn btn-success btn-sm"><?php echo $this->l('Add Row');?></button>
						<button type="button" class="remove-row btn btn-default  btn-sm"><?php echo $this->l('Remove Row');?></button>
						| <button type="button" class="add-col btn btn-success  btn-sm"><?php echo $this->l('Add Column');?></button>
					</td>
				</tr>
			</table>
			<input type="hidden" name="menu_id">
			</div>
		 
			</form>
		</div>
	</div>


	<div id="column-form" style="display: none; left: 340px; top: 45px;" class="popover top   form-setting">
		<div class="arrow"></div>
		<div style="display: block;" class="popover-title">Column Setting <span class="badge pull-right"><span class="icon icon-times-circle"></span></span></div>
		<div class="popover-content"> 
			<form    method="post" action="<?php echo $liveedit_action;?>"  enctype="multipart/form-data" >
			<table class="table table-hover">
				<tr>
					<td><?php echo $this->l('Addition Class');?></td>
					<td>
						<input type="text" name="colclass"> 
					</td>
				</tr>
				<tr>
					<td>Column Width</td>
					<td>
						<select class="colwidth" name="colwidth">
							<?php for( $i = 1; $i<=12; $i++ )  { ?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">	<button type="button" class="remove-col btn btn-default  btn-sm"><?php echo $this->l('Remove Column');?></button> </td>
				</tr>	
			</table>
			</form>
		</div>
	</div>


	<div  id="submenu-form" style="display: none; left: 340px; top: 45px;" class="popover top  form-setting">
		<div class="arrow"></div>
		<div style="display: block;" class="popover-title"><?php echo $this->l('Setting Sub Submenu');?><span class="badge pull-right"><span class="icon icon-times-circle"></span></span></div>
		<div class="popover-content"> 
			<form   method="post" action="<?php echo $liveedit_action;?>"  enctype="multipart/form-data" >
									   					
				<input type="hidden" name="submenu_id">
				<table class="table table-hover">
					<tr>
						<td><?php echo $this->l('Group Submenu');?></td>
						<td>
							<select name="submenu_group">
								<option value="0"><?php echo $this->l('No');?></option>
								<option value="1"><?php echo $this->l('Yes');?></option>
							</select>
						</td>
					</tr>	  
				</table>
			</form>
		</div>
	</div>


	<div  id="widget-form" style="display: none; left: 340px;  min-width:400px" class="popover bottom   form-setting">
		<div class="arrow"></div>
		<div style="display: block;" class="popover-title"><?php echo $this->l('Widget Setting');?><span class="badge pull-right"><span class="icon icon-times-circle"></span></span></div>
		<div class="popover-content"> 
			<?php if( !empty($widgets) ) { ?>
			<div class="input-group">
			 <select name="inject_widget"> 
			 	<option value=""><?php echo $this->l(''); ?></option>
			    <?php foreach( $widgets as $w ) { ?>
			   	<?php 
				 	$more = '';
			    	if( $info = $model->getWidgetInfo( $w['type'] ) ) {
			    		$more  = '( '.$info['label'].' )';
			 
			    	}

				 ?>
				 	<option value="<?php echo $w['key_widget']; ?>"><?php echo $more . '  ' . $w['name']; ?></option>
			 <?php } ?>
			</select>
			<span class="input-group-btn">   <button type="button" id="btn-inject-widget" class="btn btn-primary btn-sm"><?php echo $this->l('Insert');?></button></span>
			</div>
			<?php } ?>
		</div>
	 	
	</div>
		

<div id="content-s">

	<div class="container">
		<div class="page-header">
		<h1 ><?php echo $this->l('Live Megamenu Editor') ;?></h1>
 		</div>


 	<div class="bs-example">
      <div class="alert alert-danger fade in">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <strong><?php echo $this->l('By using this tool, allow to create sub menu having multiple rows and  multiple columns. You can inject widgets inside columns or group sub menus in same level of parent.Note: Some configurations as group, columns width setting will be overrided'); ?></strong>  
      </div>
    </div>


 	</div>
   	<div id="pav-megamenu-liveedit">

	<div id="toolbar" class="container">
		<div id="menu-toolbars">
				   						
			<div>
				<div class="pull-right">
					<a   href="<?php echo $this->base_config_url;?>&widgets=1" class="pts-modal-action btn  btn-modeal btn-success btn-action"><?php echo $this->l('Create A Widget'); ?></a>
					- 
					<a   href="<?php echo $live_site_url;?>" class="btn btn-modal btn-primary btn-sm btn-action" ><?php echo $this->l('Preview On Live Site');?></a> | 
					<a id="unset-data-menu" href="#" class="btn btn-danger btn-action"><?php echo $this->l('Reset Configuration');?></a>
					<button id="save-data-menu" class="btn btn-warning"><?php echo $this->l('Save');?></button>
				</div>
				<a id="save-data-back" class="btn btn-default" href="<?php echo $action_backlink;?>"><?php echo $this->l('Back');?></a>
			</div>

		</div>
	</div>
	   		

		<div class="container"><div class="megamenu-wrap">
			<div class="progress" id="pavo-progress">
			  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 00%;">
			    <span class="sr-only">60% Complete</span>
			  </div>
		</div>
   		<div id="megamenu-content">
   		</div></div>
	 	</div>

   	</div>
</div>
 </div>

 

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><?php echo $this->l('Preview On Live Site');?></h4>
        </div>
        <div class="modal-body">
         	
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->l('Close'); ?></button>
        </div>
      </div> 
    </div> 
  </div> 


<script type="text/javascript">
	var ptsid_shop = <?php echo Context::getContext()->shop->id; ?>;
	$(".btn-modal").click( function(){
		$('#myModal .modal-dialog ').css('width',980);
		$('#myModal .modal-dialog ').css('height',480);
		var a = $( '<span class="glyphicon glyphicon-refresh"></span><iframe src="'+$(this).attr('href')+'" style="width:100%;height:100%; display:none"/>'  );
		$('#myModal .modal-body').html( a );
			
		$('#myModal').modal( );
		$('#myModal').attr('rel', $(this).attr('rel') );
		$( a  ).load( function(){  
			
			$('#myModal .modal-body .glyphicon-refresh').hide();
	 		$('#myModal .modal-body iframe').show();
		} );
		return false;
	} );



	var _action 	   = '<?php echo str_replace("&amp;","&",$ajxgenmenu);?>';
	var _action_menu   = '<?php echo str_replace("&amp;","&",$ajxmenuinfo);?>';
	var _action_widget = '<?php echo str_replace("&amp;","&",$action_widget);?>';
	var _action_editwidget = '<?php echo $this->base_config_url;?>&widgets=1';
	$("#megamenu-content").PavMegamenuEditor( {'modal':'#myModal','action':_action, 'action_menu':_action_menu,'action_widget':_action_widget,'action_editwidget':_action_editwidget} );

</script>
<?php } ?>
 
