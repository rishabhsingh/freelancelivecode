{if $sliderParams.slider_class == "boxed"}
<div class="layerslider-wrapper{if $sliderParams.group_class} {$sliderParams.group_class}{/if}{if $sliderParams.md_width} col-md-{$sliderParams.md_width}{/if}{if $sliderParams.sm_width} col-sm-{$sliderParams.sm_width}{/if}{if $sliderParams.sm_width} col-xs-{$sliderParams.xs_width}{/if}">
    {assign var="sliderParams.group_class" value=""}
{/if}
    <div class="bannercontainer banner-{$sliderParams.slider_class}{if $sliderParams.group_class} {$sliderParams.group_class}{/if}" style="padding: {$sliderParams.padding};margin: {$sliderParams.margin};{$sliderParams.background}">
        <div id="sliderlayer{$sliderIDRand}" class="rev_slider {$sliderParams.slider_class}banner" style="width:100%;height:{$sliderParams.height}px;max-height:{$sliderParams.height}px; " >
            <ul>
                {if $sliders}
                {foreach from=$sliders item=slider}

                <li {$slider.data_link} {$slider.data_delay} data-masterspeed="{$slider.params.duration}"  data-transition="{$slider.params.transition}" data-slotamount="{$slider.params.slot}" data-thumb="{$slider.thumbnail}"{if $slider.background_color} style="background-color:{$slider.background_color}"{/if}>
                    {if $slider.videoURL}
                    <div class="caption fade fullscreenvideo" data-autoplay="true" data-x="0" data-y="0" data-speed="500" data-start="10" data-easing="easeOutBack">
                        <iframe src="{$slider.videoURL}?title=0&amp;byline=0&amp;portrait=0;api=1" width="100%" height="100%"></iframe>
                    </div>
                    {else if $slider.main_image}
                    <img src="{$slider.main_image}" alt=""/>
                    {/if}
                    {if isset($slider.layersparams)}
                    {foreach from=$slider.layersparams item=layer}
                    <div class="caption{if $layer.layer_class} {$layer.layer_class}{/if}{if $layer.layer_animation} {$layer.layer_animation}{/if}{if $layer.layer_easing} {$layer.layer_easing}{/if}
                        {if $layer.layer_endanimation != "auto" && !$layer.layer_endtime}{$layer.layer_endanimation}{/if}"
                         data-x="{$layer.layer_left}"
                         data-y="{$layer.layer_top}"
                         data-speed="300"
                         data-start="{$layer.time_start}"
                         data-easing="easeOutExpo" {if $layer.layer_endtime}data-end="{$layer.layer_endtime}" data-endspeed="{$layer.layer_endspeed}" {if $layer.layer_endeasing != "nothing"}data-endeasing="{$layer.layer_endeasing}"{/if}{/if} {if $layer.layer_link}data-link="{$layer.layer_link}"{/if}
                         {if $layer.css}style="{$layer.css}"{/if}>
                        
                         {if $layer.layer_type == "image"}
                         <img src="{$sliderImgUrl}{$layer.layer_content}" alt=""/>
                         {elseif $layer.layer_type == "video"}
                            {if $layer.layer_video_type == "vimeo"}
                            <iframe src="http://player.vimeo.com/video/{$layer.layer_video_id}?wmode=transparent&amp;title=0&amp;byline=0&amp;portrait=0;api=1" width="{$layer.layer_video_width}" height="{$layer.layer_video_height}"></iframe>
                            {else}
                            <iframe width="{$layer.layer_video_width}" height="{$layer.layer_video_height}" src="http://www.youtube.com/embed/{$layer.layer_video_id}?wmode=transparent" frameborder="0" allowfullscreen></iframe>
                            {/if}
                         {else}
                            {$layer.layer_caption|replace:"_ASM_":"&"|html_entity_decode:$smarty.const.ENT_QUOTES:"UTF-8"}
                         {/if}

                    </div>
                    {/foreach}
                    {/if}
                </li>           
                {/foreach}
                {/if}
            </ul>
            {if $sliderParams.show_time_line} 
            <div class="tp-bannertimer tp-{$sliderParams.time_line_position}"></div>
            {/if}
        </div>
    </div>
{if $sliderParams.slider_class == "boxed"}
</div>
{/if}

{if $sliders && $sliderParams.navigator_type == 'custom'}
<ul class="pagination_slider">
    {foreach from=$sliders item=slider name=slider_name}
        <li><a href="javascript:void(0)" data-rel="{$smarty.foreach.slider_name.index +1}" class="pagination_slider">{$slider.title}</a></li>
    {/foreach}
</ul>
{/if}

<script type="text/javascript">
     {literal}
         var tpj=jQuery;
         var revapi;
         if (tpj.fn.cssOriginal!=undefined)
         tpj.fn.css = tpj.fn.cssOriginal;

        revapi = tpj("#sliderlayer{/literal}{$sliderIDRand}{literal}").revolution(
        {
             delay:{/literal}{$sliderParams.delay}{literal},
         startheight:{/literal}{$sliderParams.height}{literal},
         startwidth:{/literal}{$sliderParams.width}{literal},


         hideThumbs:{/literal}{$sliderParams.hide_navigator_after}{literal},

         thumbWidth:{/literal}{$sliderParams.thumbnail_width}{literal},                     
         thumbHeight:{/literal}{$sliderParams.thumbnail_height}{literal},
         thumbAmount:{/literal}{$sliderParams.thumbnail_amount}{literal},
         {/literal}{if $sliderParams.navigator_type != "both"}{literal}
         navigationType:"{/literal}{$sliderParams.navigator_type}{literal}",
         {/literal}{else}{literal}
         navsecond:"both",
         {/literal}{/if}{literal}
         navigationArrows:"{/literal}{$sliderParams.navigator_arrows}{literal}",                
         {/literal}{if $sliderParams.navigation_style != "none"}{literal}
         navigationStyle:"{/literal}{$sliderParams.navigation_style}{literal}",          
         {/literal}{/if}{literal}

         navOffsetHorizontal:{/literal}{if $sliderParams.offset_horizontal}{$sliderParams.offset_horizontal}{else}0{/if}{literal},
		 {/literal}{if $sliderParams.offset_vertical}{literal}
         navOffsetVertical:{/literal}{$sliderParams.offset_vertical}{literal},  
		{/literal}{/if}{literal}	
         touchenabled:"{/literal}{if $sliderParams.touch_mobile}on{else}off{/if}{literal}",         
         onHoverStop:"{/literal}{if $sliderParams.stop_on_hover}on{else}off{/if}{literal}",                     
         shuffle:"{/literal}{if $sliderParams.shuffle_mode}on{else}off{/if}{literal}",  
         stopAtSlide: {/literal}{if $sliderParams.auto_play}-1{else}1{/if}{literal},                        
         stopAfterLoops:{/literal}{if $sliderParams.auto_play}-1{else}0{/if}{literal},                     

         hideCaptionAtLimit:0,              
         hideAllCaptionAtLilmit:0,              
         hideSliderAtLimit:0,           
         fullWidth:"{/literal}{$sliderFullwidth}{literal}",
         shadow:{/literal}{$sliderParams.shadow_type}{literal}
         });
         $( document ).ready(function() {
            $('.caption',$('#sliderlayer{/literal}{$sliderIDRand}{literal}')).click(function(){
                if($(this).data('link') != undefined && $(this).data('link') != '') location.href = $(this).data('link');
            });
         });
     {/literal}

 {if $sliders && $sliderParams.navigator_type == 'custom'}
    $('.pagination_slider li a').click(function(){
        $('.pagination_slider li').removeClass('active');
        $(this).parent().addClass('active');

        var index = $(this).attr('data-rel');
        revapi.revshowslide(index)
    });
    revapi.bind("revolution.slide.onchange",function (e,data) {
        $('.pagination_slider li').removeClass('active');
        $('.pagination_slider li a[data-rel="'+data.slideIndex+'"]').parent().addClass('active');
    });
{/if}
</script>