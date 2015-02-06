<?php get_header(); ?>

		<article class="page-404">

			<h3>404!</h3>
			<h4>Page not found!</h4>

			<p>Oh dear! Looks like you're a little lost. How about you try going <a href="/">home</a>, or try searching for what you're looking for?</p>

			<form method="get" action="/">
				<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Search..." />
			</form>

		</article>

<?php get_footer(); ?>
