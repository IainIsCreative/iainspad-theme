<?php get_header(); ?>
		<h1>I like <span class="teal">good design</span>, <span class="maroon">ideas</span>, <span class="burgundy">clean code</span>, and <span class="cyan">functionality</span></h1>
		<ol id="portfolio">
		<?php query_posts('cat=3&showposts=6'); ?>
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<li <?php post_class(); ?>>
			<?php if(has_post_thumbnail()) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail">
					<div class="thumbnail-image">
						<?php the_post_thumbnail(); ?>
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
		<?php wp_reset_query(); ?>
		</ol>
<?php get_footer(); ?>
