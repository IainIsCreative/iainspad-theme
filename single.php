<?php get_header(); ?>
	<?php $post = $wp_query->post; if(in_category('Portfolio')) { ?>
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<article class="portfolio-item">
		<h1 class="item-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
		<div id="content">
			<?php get_sidebar('left'); ?>
			<section class="item-entry">
			<?php the_content(); ?>
			</section>
		</div>
	</article>
	<?php endwhile; endif; ?>
	<?php } else { ?>
	<div id="blog-content">
		<div id="post-container">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h1 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
					<section class="post-entry">
						<aside class="metadata">
							<ul>
								<li class="date"><a href="<?php echo get_year_link(); ?>"><?php the_time("M jS, 'y"); ?></a></li>
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
						<?php the_content(); ?>
						<footer>
							<div id="post-author">
								<figure>
									<a href="<?php the_author_meta('user_url'); ?>"><?php echo get_avatar(get_the_author_meta('user_email'), '160', ''); ?></a>
								</figure>
								<h5>Written by <?php the_author_link(); ?></h5>
								<p><?php the_author_meta('description'); ?></p>
								<?php if(get_the_author_meta('twitter') != '') { ?>
								<a href="https://twitter.com/<?php the_author_meta('twitter'); ?>" class="twitter-follow-button" data-show-count="true">Follow <?php get_the_author_meta('twitter'); ?></a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
								<?php } ?>
							</div>
						</footer>
					</section>
					<?php comments_template(); ?>
				</article>
			<?php endwhile; endif; ?>
		</div>
	<?php get_sidebar(); ?>
	</div>
	<?php } ?>
<?php get_footer(); ?>