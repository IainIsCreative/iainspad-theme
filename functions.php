<?php

add_theme_support('post-thumbnails');
add_theme_support('menus');

add_image_size('post-thumb', 1020, 180, true);

remove_filter('the_content','wpautop');
remove_filter('the_content','wpautobr');

function add_twitterUser($contactmethods) {
	$contactmethods['twitter'] = 'Twitter Username';
	return $contactmethods;
}
add_filter('user_contactmethods', 'add_twitterUser', 10, 1);


//Load jQuery from Google's CDN.
function google_jquery() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, '1.9.0');
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts','google_jquery');

function respond_js() {
	wp_register_script('respondjs', (get_template_directory_uri().'/js/respond.min.js'));
	wp_enqueue_script('respondjs');
}
add_action('wp_enqueue_scripts','respond_js');

//Remove arbitrary actions
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');


//Custom Comment Markup
function blog_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch($comment->comment_type) :
		case '' :
?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<?php if($comment->comment_approved == '0') : ?>
					<em class="comment-approval">Your Comment is awaiting moderation.</em>
				<?php endif; ?>
				<figure class="comment-author-avatar">
					<?php echo get_avatar($comment->comment_author_email, '160'); ?>
				</figure>
				<?php printf(__('<h6>%s'), get_comment_author_link()); ?> <i>said on <?php comment_date(); ?></i></h6>
				<?php comment_text($post->ID); ?>
				<span class="reply">
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max-width' => $args['max_depth']))); ?>
				</span>
			</div>
<?php
	endswitch;
}

//Login file linking
function custom_login_files() {
	$files = '<link rel="stylesheet" href="' . get_template_directory_uri() . '/styles/login.min.css" />
			  <script src="' . get_template_directory_uri() . '/js/jquery.min.js"></script>
			  <script src="' . get_template_directory_uri() . '/js/login.js"></script>
			  <script src="//use.typekit.net/sab7qbq.js"></script>
			<script>try{Typekit.load();}catch(e){}</script>';

	echo $files;
}
add_action('login_head', 'custom_login_files');

//Login title and url
function custom_login_header_url() {
	return home_url();
}
add_filter('login_headerurl','custom_login_header_url');

function custom_login_header_title() {
	return get_option('blogname');
}
add_filter('login_headertitle','custom_login_header_title');

?>
