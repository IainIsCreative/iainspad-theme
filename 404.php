<?php get_header(); ?>
	<div id="main">
		<article class="page-404">
			<hgroup>
				<h3>404!</h3>
				<h4>Page not found!</h4>
			</hgroup>
			<p>Oh dear! Looks like you're a little lost. How about you try going <a href="/">home</a>, or try searching for what you're looking for?</p>
			<form method="get" action="/">
				<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Search..." />
			</form>
		</article>
	</div>
<?php get_footer(); ?>