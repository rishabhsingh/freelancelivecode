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
<div class="col-sm-9">

<p class="clearfix">
  <a href="{$tools_editor}"   class="btn-danger btn pull-right" target="_blank" style="margin-left:10px;"><i class="icon-external-link-sign"></i> {l s='Live Theme Configurator'}</a> 
</p>

<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#modulesetting" data-toggle="tab">{l s='General Setting' mod='ptsthemepanel'}</a></li>
  <li><a href="#sitetools" id="sitetools-button" data-toggle="tab">{l s='Tools' mod='ptsthemepanel'}</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="modulesetting"> 
    {$configform}
  </div>
 
  <div class="tab-pane" id="sitetools">
   

    <form method="post" action="" id="installmodfrm" enctype="multipart/form-data">
    <div class="panel">
             
               

                <div class="panel-heading">
                  {l s='Data Sample Modules' mod='ptsthemepanel'}
                </div>
                  <div class="panel panel-content">
                         <div class="alert alert-danger">
                          <div>+ {l s='This Tool allow install datamples to make look and feel like as demo on existed store.' mod='ptsthemepanel'}</div>
                          <div>+ {l s='Click to Import Sample Configuration to install DataSample Of Configuration Of Modules Make For Actived Theme.' mod='ptsthemepanel'}</div>
                          <div>+ {l s='If Modules are ready with your old configurations, please click to backup button that will restores yours when clicking Restore button' mod='ptsthemepanel'}</div>
                          <div>+ <b>{l s='Install Sample Queries feature is only used for module(s) which have not even installed or tables and records of module(s) is empty' mod='ptsthemepanel'}</b>. Recommend you should make configuration of module(s) in manually way in the guide</div>
                        </div>
                          <br>
                        <div class="clearfix" id="btn-tools">
                          
                          <div class="pull-left">
                            <button type="submit" name="importConfiguration" class="btn btn-info btn-md btn-action">{l s='Import Sample Configuration'}</button>
                          

                            <button type="submit" name="importQueries" class="btn btn-md btn-warning btn-action">{l s='Import Sample Queries'}</button>
                            <button type="submit" name="restoreAll" class="btn btn-md btn-danger btn-action">{l s='Restore'}</button>

                            |   <button type="submit" name="assignHooksModulesInXml" class="btn btn-primary btn-md btn-action">{l s='Re-Assign Modules - Hooks'}</button> 
                          </div>

                          <div class="pull-right">
                             <button onclick="$('.pts-checkbox').attr('checked','checked')" type="submit" name="backupAll" class="btn btn-danger btn-md">
                              {l s='Backup'} <em>{l s='All Module Using To Restore Old'}</em>
                             </button>
                          </div>
                            
                        </div>
                        <hr>

                        <div class="table-responsive">
                          <table class="table">
                            <tr class="success">
                              <th></th>
                              <th>{l s='Module' mod='ptsthemepanel'}</th>
                              <th>{l s='Has Configuration' mod='ptsthemepanel'}</th>
                              <th>{l s='Has Queries' mod='ptsthemepanel'}</th>
                              <th>{l s='Back Up' mod='ptsthemepanel'}</th>
                              <th>{l s='Action' mod='ptsthemepanel'}</th>
                            </tr>
                            {foreach from=$samples item=sample name=myLoop}
                            {if isset($sample.label) && $sample.hassample}
                            <tr>
                              <td>
                                <input type="checkbox" class="pts-checkbox" name="modules[{$sample.name}]" value="{$sample.label}" />
                              </td>
                              <td>{$sample.label}</td>
                              <td>
                                <span class="label label-info">{l s='Yes' mod='ptsthemepanel'}</span>
                              </td>
                              <td> 
                                {if $sample.queries}
                                <span class="label label-warning">{l s='Yes' mod='ptsthemepanel'}</span>
                                {else}
                                 <span class="label label-danger">{l s='No' mod='ptsthemepanel'}</span>
                                {/if}
                              </td>
                              <td>
                                {if $sample.backup}
                                 <span class="label label-info">{l s='Yes' mod='ptsthemepanel'}</span>
                                {else}
                                 <span class="label label-danger">{l s='No' mod='ptsthemepanel'}</span>
                                {/if}

                              </td>
                              <td>
                                <a href="{$moduleEditURL}&module_name={$sample.name}&configure={$sample.name}" class="btn btn-sm   btn-default liveeditmod">{l s='Live Configure'}</a>
                              </td>
                            </tr>
                            {/if}
                            {/foreach}
                          </table>
                        </div>  

                        <div class="row">
                            <div class="btn-group bulk-actions open">
                                 <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
                                      {l s='Bulk actions' mod='ptsthemepanel'} <span class="caret"></span>
                                </button>

                                <ul class="dropdown-menu">
                                  <li>
                                    <a onclick="$('#installmodfrm .pts-checkbox').prop('checked',true);return false;" href="#">
                                      <i class="icon-check-sign"></i>&nbsp;{l s='Select all' mod='ptsthemepanel'}
                                    </a>
                                  </li>
                                  <li>
                                    <a onclick="$('#installmodfrm .pts-checkbox').prop('checked',false);return false;" href="#">
                                      <i class="icon-check-empty"></i>&nbsp;{l s='Unselect all' mod='ptsthemepanel'}
                                    </a>
                                  </li>
                                </ul>

                            </div>
                        </div>
                  </div> 
                  
      </div>  

   <div class="panel">
        <div class="panel-heading">
          {l s='Theme Tools' mod='ptsthemepanel'}
        </div>
        <div class="panel panel-content">
            <div class="alert alert-info">
                {l s='If you would like to hook or unhook modules to make look and feeld of theme as the demo. Please click to below button'} <br>
                <p> <button type="submit" name="assignHooksAllModulesInXml" class="btn btn-danger btn-md btn-action">{l s='Re-Assign All Modules - Hooks'}</button> </p>
            </div>
        </div>  
    </div>  


       </form>      
  </div>
</div>
<script type="text/javascript">
 var hideSomeElement = function(){
  $('body',$('.fancybox-iframe').contents()).find("#header").hide();
      $('body',$('.fancybox-iframe').contents()).find("#footer").hide();
      $('body',$('.fancybox-iframe').contents()).find(".page-head, #nav-sidebar ").hide();
      $('body',$('.fancybox-iframe').contents()).find("#content.bootstrap").css( 'padding',0).css('margin',0);


 };

$(".pts-fancybox").fancybox({
  'type':'iframe',
  'width':960,
  'height':500});


$(".liveeditmod, .pts-fancybox").fancybox({
  'type':'iframe',
  'width':960,
  'height':500,
  afterLoad:function(   ){
    if( $('body',$('.fancybox-iframe').contents()).find("#main").length  ){  
        hideSomeElement();
         $('.fancybox-iframe').load( hideSomeElement );

    }else { 
      $('body',$('.fancybox-iframe').contents()).find("#psException").html('<div class="alert error">{l s="No Configuration Avairiable"}</div>');
    }
  }
});
</script>
<script>
  $(function () {
 //   $('#myTab a:first').tab('show')
  })

  $("#btn-tools  button.btn-action").click( function() {  
      if( $('.pts-checkbox:checked').length > 0 ){
      }else {
        alert( '{l s="Please select module(s) to do this action."}');
        return false;
      }
      return true;
  } );
</script>
</div>


<div class="col-sm-3">
  <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
      <ul class="nav bs-docs-sidenav nav-pills nav-stacked  img-rounded">
         {foreach name=btnnavs from=$btnnavs item=btnnav}
          <li><a  href="#fieldset_{($smarty.foreach.btnnavs.iteration-1)}"><i class="{$btnnav.icon}"></i> {$btnnav.title}</a></li>
         {/foreach} 
       </ul> <div class="arrow_box"></div>
  </div>
 
</div>  