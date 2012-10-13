	</div>
	<footer role="contentinfo">
		<small>&copy; <?php echo date("Y"); ?> <a href="<?php bloginfo('siteurl') ?>" class="teal" title="Iain MacDonald">Iain MacDonald</a> | All Rights Reserved | Fonts hosted on <a href="http://typekit.com" class="burgundy" target="blank">Typekit</a> | Hosting by <a href="http://mediatemple.net" class="cyan" target="blank">Media Temple</a></small>
	</footer>
</div>
<?php if(is_single() && in_category('portfolio')) { ?>
<nav id="portfolio-navigation">
	<ul>
		<li><?php previous_post_link('%link', 'Previous Portfolio Item', true); ?></li>
		<li><?php next_post_link('%link', 'Next Portfolio Item', true); ?></li>
	</ul>
</nav>
<?php } ?>
<!--[if lt IE 8]>
<div id="upgrade-please">
	<section>
		<p>You're using an outdated Browser. Please upgrade to any of the following.</p>
		<ul>
			<li><a href="http://chrome.google.com" title="Google Chrome" target="blank">Google Chrome</a></li>
			<li><a href="http://www.apple.com/safari/" title="Apple Safari" target="blank">Apple Safari</a></li>
			<li><a href="http://www.mozilla.org/en-US/firefox/new/" title="Mozilla Firefox" target="blank">Mozilla Firefox</a></li>
			<li><a href="http://www.opera.com" title="Opera Browser" target="blank">Opera</a></li>
			<li><a href="http://windows.microsoft.com/en-GB/internet-explorer/products/ie/home/" title="Internet Explorer" target="blank">Internet Explorer</a></li>
		</ul>
	</section>
</div>
<![endif]-->
<?php wp_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/js/prettify.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/lang-css.js"></script>
<?php $customjs = get_post_meta($post->ID, 'custom_js', true); if($customjs != '') { ?>
<script src="<?php echo $customjs; ?>"></script>
<?php } ?>
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