{if isset($htmlitems) && $htmlitems}

{if (int)$hookcols>0}
{assign var="hcol" value=12/$hookcols}
{else}
{assign var="hcol" value=4}
{/if}
   
        {foreach name=items from=$htmlitems item=hItem}
            {if $hItem.col_lg<=0}
                {$hItem.col_lg=floor(12/count($htmlitems))}
            {/if}

            {if $hItem.col_sm<=0}
                {$hItem.col_sm=12}
            {/if}
            <div class="ptsstaticontent_{$hook} staticontent-item-{$smarty.foreach.items.iteration} staticontent-item col-lg-{$hItem.col_lg} col-md-{$hItem.col_lg} col-sm-{$hItem.col_lg} col-xs-12 {if $hook=='footer'}hidden-sm{/if}">
                <div class="box block pts-custom {$hItem.class}" data-href="{if $hItem.url}{$hItem.url|escape:'html':'UTF-8'}{/if}">

                    {if $hItem.url}<a href="{$hItem.url|escape:'html':'UTF-8'}" class="item-link"{if $hItem.target == 1} target="_blank"{/if}>{/if}
                        {if $hItem.image}
                            <img src="{$module_dir}images/{$hItem.image}" class="item-img img-responsive" alt="" />
                        {/if}
                    {if $hItem.url}</a>{/if}  

                    {if $hItem.title && $hItem.title_use == 1}
                    <div class="title_block"><span>{$hItem.title}</span></div>
                    {/if}
                    <div class="block_content description" data-href="{$hItem.url|escape:'html':'UTF-8'}">
                        {if $hItem.html}
                            {$hItem.html}                        
                        {/if}
                    </div>
                </div>
            </div> 
        {/foreach}
    {/if}


