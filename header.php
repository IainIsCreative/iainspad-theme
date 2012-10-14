<!DOCTYPE html>
<!--[if lt IE 7]><html class="ie lt-ie7 lt-ie8 lt-ie9 no-js" lang="en" dir="ltr"><![endif]-->
<!--[if IE 7]><html class="ie lt-ie8 lt-ie9 no-js" lang="en" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="ie lt-ie9 no-js" lang="en" dir="ltr"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en" dir="ltr"><!--<![endif]-->
<head>
<meta charset="utf-8" />
<meta name="author" content="<?php bloginfo('name'); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<?php $customcss = get_post_meta($post->ID, 'custom_css', true); if($customcss != '') { ?>
<link rel="stylesheet" href="<?php echo $customcss; ?>" />
<?php } else { ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/main.css" />
<?php } ?>
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-ipad.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-iphone-retina.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-ipad-retina.png" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="iainspad RSS feed" href="<?php bloginfo('rss2_url'); ?>" />
<script src="//use.typekit.net/sab7qbq.js"></script>
<script>try{Typekit.load();}catch(e){}</script>
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--BEGIN WP Generated Header-->
<?php wp_head(); ?>
<?php if(is_singular()) wp_enqueue_script('comment-reply'); ?>
<!--END WP Generated Header-->
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
	<header role="banner">
		<h1><a class="logo" href="/"><?php bloginfo('name'); ?></a></h1>
		<nav role="navigation" id="navigation">
			<ul<?php $active = 'class="active"'; ?>>
				<li><a href="/" <?php if(is_home() || is_single() && in_category('Portfolio') || is_archive() && in_category('Portfolio')) { echo $active; } ?>>Home</a></li>
				<li><a href="/about" <?php if(is_page('About')) { echo $active; } ?>>About</a></li>
				<li><a href="/blog" <?php if(is_page('Blog') || is_single() && !in_category('Portfolio') || is_search() || is_archive() && !in_category('Portfolio')) { echo $active; } ?>>Blog</a></li>
				<li><a href="/contact" <?php if(is_page('Contact')) { echo $active; } ?>>Contact</a></li>
			</ul>
		</nav>
	</header>
	<div id="main">