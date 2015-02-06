<?php get_header(); ?>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<article <?php post_class(); ?>>

		<div id="content">
			<?php get_sidebar('left'); ?>

			<section class="page-entry">
			<?php the_content(); ?>
			</section>

		</div>

	</article>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>
