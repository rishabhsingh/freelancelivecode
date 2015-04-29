<div id="blog-dashboard">

	<div class="row">
		<div class="col-md-6">
			
			<div class="panel panel-default">
				<div class="panel-heading">{l s='Global Config' mod='leoblog'}</div>
				
				<div class="panel-content" id="bloggeneralsetting">
				 	{$globalform}
				</div>	

			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">{l s='Quick Tools' mod='leoblog'}</div>
				<div class="panel-content">
					
					<div id="quicktools" class="row">
						{foreach from=$quicktools item=tool}
						<div class="col-xs-3 col-lg-3 active">
						<a href="{$tool.href}" class="{$tool.class}">
							<i class="icon icon-3x {$tool.icon}"></i> 
							<p>{$tool.title}</p>
						</a>
						</div>
						{/foreach} 
						
					</div>
				</div>	
			</div>


			<div class="panel panel-default">
				<div class="panel-heading">{l s='Statistics' mod='leoblog'}</div>
				<div class="panel-content" id="dashtrends">
						
						<div class="row" id="dashtrends_toolbar">
							<dl   class="col-xs-4 col-lg-4 active">
								<dt>{l s='Blogs' mod='leoblog'}</dt>
								<dd class="data_value size_l"><span id="sales_score">{$count_blogs}</span></dd>
								 
							</dl>
							<dl   class="col-xs-4 col-lg-4">
								<dt>{l s='Categories' mod='leoblog'}</dt>
								<dd class="data_value size_l"><span id="orders_score">{$count_cats}</span></dd>
							 
							</dl>
							<dl  class="col-xs-4 col-lg-4">
								<dt>{l s='Comments' mod='leoblog'}</dt>
								<dd class="data_value size_l"><span id="cart_value_score">{$count_comments}</span></dd>
							 
							</dl>
							 
						</div>


				</div>

			</div>	

			<div class="panel panel-default">
				<div class="panel-heading">{l s='Modules' mod='leoblog'}</div>
				<div class="panel-content">
					
					<section>
							<nav>
								<ul class="nav nav-tabs">
									<li class="">
										<a data-toggle="tab" href="#dash_latest_comment">
											<i class="icon-fire"></i> {l s='Lastest Comments' mod='leoblog'}
										</a>
									</li>
									<li class="active">
										<a data-toggle="tab" href="#dash_most_viewed">
											<i class="icon-trophy"></i> {l s='Most Viewed' mod='leoblog'}
										</a>
									</li>
								
								 
								</ul>
							</nav>
							<div class="tab-content panel">
								<div id="dash_latest_comment" class="tab-pane">
									
									<div>
										<ul>
										{foreach from=$latest_comments item=comment}
										<li><a href="{$comment_link}&id_comment={$comment.id_comment}&updateleoblog_comment">{$comment.comment|strip_tags|truncate:65:'...'} </a/> {l s='Date' mod='leoblog'}({$comment.date_add}) - {l s='User :' mod='leoblog'} {$comment.user}</li>
										{/foreach}
										</ul>
									</div> 
								</div>
								<div id="dash_most_viewed" class="tab-pane active">
									 <div>
										<ul>
										{foreach from=$blogs item=blog}
										<li><a href="{$blog_link}&id_leoblog_blog={$blog.id_leoblog_blog}&updateleoblog_blog">{$blog.meta_title}</a/> - <i>{l s='Hits' mod='leoblog'}: {$blog.hits}</i> </li>
										{/foreach}
										</ul>
									</div> 
								</div>
								
							 
							</div>
						</section>





				</div>	
			</div>	
		</div>


	</div>
</div>