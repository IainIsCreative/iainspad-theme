<?php get_header(); ?>
		<?php if(is_category()) { ?>
		<h3 class="archive-title">Posts under <span class="teal"><?php single_cat_title(); ?></span></h3>
		<?php } elseif(is_tag()) { ?>
		<h3 class="archive-title">Items tagged <span class="teal"><?php single_tag_title(); ?></span></h3>
		<?php } elseif(is_month()) { ?>
		<h3 class="archive-title">Items from <span class="burgundy"><?php the_time('F'); ?>, <span class="cyan"><?php the_time("Y"); ?></span></span></h3>
		<?php } elseif(is_year()) { ?>
		<h3 class="archive-title">Items from <span class="cyan"><?php the_time('Y'); ?></span></h3>
		<?php } ?>
		<?php if(in_category('Portfolio')) { ?>
		<ol id="portfolio" <?php post_class(); ?>>
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<li>
			<?php if(has_post_thumbnail()) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail">
					<div class="thumbnail-image">
						<?php the_post_thumbnail('portfolio-thumb'); ?>
					</div>
					<aside>
						<strong><?php the_title(); ?></strong>
						<ul>
						<?php
							$posttags = get_the_tags();
							if($posttags) {
								foreach($posttags as $tag) {
								echo "<li>$tag->name</li>";
								}
							}
						?>
						</ul>
					</aside>
				</a>
			<?php } ?>
			</li>
		<?php endwhile; endif; ?>
		</ol>
		<?php } else { ?>
		<div id="blog-content">
			<div id="post-container">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h1 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
					<section class="excerpt">
						<aside class="metadata">
							<ul>
								<li class="date"><a href="<?php echo get_year_link(''); ?>"><?php the_time("M jS, 'y"); ?></a></li>
								<li class="comments"><a href="<?php the_permalink(); ?>/#comments"><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></a></li>
								<?php if(get_the_author_meta('twitter') != '') { ?>
								<li class="tweet-button"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="<?php the_author_meta('twitter'); ?>" data-related="iainspad">Tweet</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
								<?php } else { ?>
								<li class="tweet-button"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="iainspad">Tweet</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
								<?php } ?>
							</ul>
						</aside>
						<?php if(has_post_thumbnail()) { ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail"><?php the_post_thumbnail('post-thumb'); ?></a>
						<?php } ?>
						<p><?php the_excerpt(); ?></p>
						<hr />
						<hr />
					</section>
				</article>
			<?php endwhile; ?>
				<nav id="blog-navigation">
					<ul>
						<li><?php next_posts_link('Older Posts'); ?></li>
						<li><?php previous_posts_link('Newer Posts'); ?></li>
					</ul>
				</nav>
			<?php else : ?>
			<h3>Sorry! Nothing found for <?php if(is_category()) { single_cat_title(); } elseif(is_tag()) { single_tag_title(); } elseif(is_month()) { the_time('F Y'); } elseif(is_year()) { the_time('Y'); } ?>.</h3>
			<?php endif; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
		<?php } ?>
<?php get_footer(); ?>