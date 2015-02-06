	</main>

	<footer role="contentinfo" class="site-footer container">


		<small class="site-footer__copyright">&copy; <?php echo date("Y"); ?> <a href="<?php bloginfo('siteurl') ?>" class="teal" title="Iain MacDonald">Iain MacDonald</a> | All Rights Reserved | Fonts hosted on <a href="http://typekit.com" class="burgundy" target="_blank">Typekit</a> | Hosting by <a href="http://mediatemple.net">Media Temple</a></small>



	</footer>
	<?php wp_footer(); ?>

	<script src="<?php bloginfo('template_url'); ?>/js/prettify.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/lang-css.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/scripts.js"></script>
	<script>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-19916511-1']);
		_gaq.push(['_setDomainName', '.iainspad.com']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>

<!--<?php echo get_num_queries(); ?> Queries in <?php timer_stop(1); ?> Seconds.-->
</body>
</html>
