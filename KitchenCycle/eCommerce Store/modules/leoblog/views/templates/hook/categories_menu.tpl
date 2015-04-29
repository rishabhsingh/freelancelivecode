    <!-- Block categories module -->
    {if $tree}
    <div id="categories_blog_menu" class="block blog-menu">
      <h4 class="title_block">{if isset($currentCategory)}{$currentCategory->title|escape}{else}{l s='Blog Categories' mod='leoblog'}{/if}</h4>
        <div class="block_content">
            {$tree}
        </div>
    </div>
    {/if}
    <!-- /Block categories module -->
