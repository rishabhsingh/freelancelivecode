	{if isset($error)}
		<div id="blogpage" class="blog-detail blog-container">
			<div class="inner">
				<div class="alert alert-warning">{l s='Sorry, We are updating data, please come back late!!!!' mod='leoblog'}</div>
			</div>
		</div>
	{else}	
	<div id="blogpage" class="blog-detail blog-container">
		<div class="inner">
			{if $is_active}
			<h1 class="blog-title">{$blog->meta_title}</h1>
			<div class="blog-meta">
				{if $config->get('item_show_author','1')}
				<span class="blog-author">
					<span class="icon-user"> {l s='Posted By' mod='leoblog'}: </span>
					<a href="{$blog->author_link|escape:'html':'UTF-8'}" title="{$blog->author}">{$blog->author}</a>
				</span>
				{/if}

				{if $config->get('item_show_category','1')}
				<span class="blog-cat"> 
					<span class="icon-list"> {l s='In' mod='leoblog'}: </span> 
					<a href="{$blog->category_link|escape:'html':'UTF-8'}" title="{$blog->category_title|escape:'html':'UTF-8'}">{$blog->category_title}</a>
				</span>
				{/if}

				{if $config->get('item_show_created','1')}
				<span class="blog-created">
					<span class="icon-calendar"> {l s='On' mod='leoblog'}: </span> 
					{strtotime($blog->date_add)|date_format:"%A, %B %e, %Y"}
				</span>
				{/if}
				
				{if isset($blog_count_comment)&&$config->get('item_show_counter','1')}
				<span class="blog-ctncomment">
					<span class="icon-comment"> {l s='Comment' mod='leoblog'}:</span> 
					{$blog_count_comment}
				</span>
				{/if}
				{if isset($blog->hits)&&$config->get('item_show_hit','1')}
				<span class="blog-hit">
					<span class="icon-heart"> {l s='Hit' mod='leoblog'}:</span>
					{$blog->hits}
				</span>
				{/if}
			</div>

			{if $blog->preview_url && $config->get('item_show_image','1')}
				<div class="blog-image">
					<img src="{$blog->preview_url}" title="{$blog->meta_title}"/>
				</div>
			{/if}



			{if $config->get('item_show_description',1)}
			<div class="blog-description">
			{$blog->description}
			</div>
			{/if}

			<div class="blog-content">
			{$blog->content}	
			</div>
			{if trim($blog->video_code)}
			<div class="blog-video-code">
				<div class="inner ">
					{$blog->video_code}
				</div>
			</div>
			{/if}

			<div class="social-share">
				 {include file="{$module_tpl}_social.tpl"}
			</div>
			{if $tags}
			<div class="blog-tags">
				<span>{l s='Tags:' mod='leoblog'}</span>
			 
				{foreach from=$tags item=tag name=tag}
					 <a href="{$tag.link|escape:'html':'UTF-8'}" title="{$tag.tag|escape:'html':'UTF-8'}"><span>{$tag.tag}</span></a> 	
				{/foreach}
				 
			</div>
			{/if}

			{if !empty($samecats)||!empty($tagrelated)}
			<div class="extra-blogs row">
			{if !empty($samecats)}
				<div class="col-lg-6">
					<h4>{l s='In Same Category'}</h4>
					<ul>
					{foreach from=$samecats item=cblog name=cblog}
						<li><a href="{$cblog.link|escape:'html':'UTF-8'}">{$cblog.meta_title}</a></li>
					{/foreach}
					</ul>
				</div>
				<div class="col-lg-6">
					<h4>{l s='Related by Tags'}</h4>
					<ul>
					{foreach from=$tagrelated item=cblog name=cblog}
						<li><a href="{$cblog.link|escape:'html':'UTF-8'}">{$cblog.meta_title}</a></li>
					{/foreach}
					</ul>
				</div>
			{/if}
			</div>
			{/if}

			{if $productrelated}

			{/if}
			<div class="blog-comment-block">
			{if $config->get('item_comment_engine','local')=='facebook'}
				{include file="{$module_tpl}_facebook_comment.tpl"}
			{elseif $config->get('item_comment_engine','local')=='diquis'}
				{include file="{$module_tpl}_diquis_comment.tpl"}
			
			{else}
				{include file="{$module_tpl}_local_comment.tpl"}
			{/if}
			</div>	
			{else}
			<div class="alert alert-warning">{l s='Sorry, This blog is not avariable. May be this was unpublished or deleted.' module='leoblog'}</div>
			{/if}

		</div>
	</div>
 	{/if}