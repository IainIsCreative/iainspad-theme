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

/*

Hmmm...

function load_local_jquery() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', (get_template_directory_uri().'/js/jquery.min.js'), false, '1.8.0');
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts','load_local_jquery');

*/

function respond_js() {
	wp_register_script('respondjs', (get_template_directory_uri().'/js/respond.min.js'));
	wp_enqueue_script('respondjs');
}
add_action('wp_enqueue_scripts','respond_js');

function nav_menu_items($items) {
	if(is_front_page()) {
		$class = ' current_page_item';
	}
	$home = '<li class="home' .$class. '"><a href="' . home_url('/') . '" title="' . get_option('blogname') .'">' . __('Home') . '</a></li>';
	$items = $home . $items;
	return $items;
}
add_filter('wp_nav_menu_items','nav_menu_items');

//Oh boy. Time for that Meta box bullshit.

function post_meta_boxes() {
	add_meta_box(
		'post-metadata',
		'Post Metadata',
		'post_metadata_cb',
		'post',
		'side',
		'high'
	);
}
add_action('add_meta_boxes','post_meta_boxes');

function post_metadata_cb($post) {
	$portfolio_meta = get_post_custom($post->ID);
	$client = isset($portfolio_meta['client_meta']) ? esc_attr($portfolio_meta['client_meta'] [0]) : '';
	$client_url = isset($portfolio_meta['client_url_meta']) ? esc_attr($portfolio_meta['client_url_meta'] [0]) :'';
	$testimonial = isset($portfolio_meta['client_testimonial_meta']) ? esc_attr($portfolio_meta['client_testimonial_meta'] [0]) : '';
	$citation = isset($portfolio_meta['citation_meta']) ? esc_attr($portfolio_meta['citation_meta'] [0]) : '';
	$citation_url = isset($portfolio_meta['citation_url_meta']) ? esc_attr($portfolio_meta['citation_url_meta'] [0]) : '';

	//Nonce for saving
	wp_nonce_field('post_metadata_nonce', 'metadata_nonce');
?>
 <p>
	<label for="client_meta">Client</label>
	<input type="text" name="client_meta" id="client_meta" value="<?php echo $client; ?>" class="widefat" />
</p>
<p>
	<label for="client_url_meta">Client URL</label>
	<input type="text" name="client_url_meta" id="client_url_meta" value="<?php echo $client_url; ?>" class="widefat" />
</p>
<p>
	<label for="client_testimonial_meta">Testimonial</label>
	<textarea name="client_testimonial_meta" id="client_testimonial_meta" class="widefat" rows="10"><?php echo $testimonial; ?></textarea>
</p>
<p>
	<label for="citation_meta">Citation</label>
	<input type="text" name="citation_meta" id="citation_meta" value="<?php echo $citation; ?>" class="widefat" />
</p>
<p>
	<label for="citation_url_meta">Citation URL Meta</label>
	<input type="text" name="citation_url_meta" id="citation_url_meta" value="<?php echo $citation_url; ?>" class="widefat" />
</p>
<?php }

function post_metadata_save($post_id) {
	//Bail if we're doing an autosave
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	//If none isn't there, then bail
	if(!isset($_POST['metadata_nonce']) || !wp_verify_nonce($_POST['metadata_nonce'], 'post_metadata_nonce')) return;

	if(!current_user_can('edit_post')) return;

	//Start saving stuff!
	if(isset($_POST['client_meta']))
		update_post_meta($post_id, 'client_meta', wp_kses_post($_POST['client_meta']));

	if(isset($_POST['client_url_meta']))
		update_post_meta($post_id, 'client_url_meta', wp_kses_post($_POST['client_url_meta']));

	if(isset($_POST['client_testimonial_meta']))
		update_post_meta($post_id, 'client_testimonial_meta', wp_kses_post($_POST['client_testimonial_meta']));

	if(isset($_POST['citation_meta']))
		update_post_meta($post_id, 'citation_meta', wp_kses_post($_POST['citation_meta']));

	if(isset($_POST['citation_url_meta']))
		update_post_meta($post_id, 'citation_url_meta', wp_kses_post($_POST['citation_url_meta']));
}

add_action('save_post', 'post_metadata_save');

//Custom CSS and Javascript files!

function custom_file_boxes() {
	add_meta_box(
		'custom_files',
		'Custom Files',
		'custom_file_cb',
		'post',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'custom_file_boxes');

function custom_file_cb($post) {
	$customfiles_meta = get_post_custom($post->ID);
	$custom_css = isset($customfiles_meta['custom_css']) ? esc_attr($customfiles_meta['custom_css'] [0]) : '';
	$custom_js = isset($customfiles_meta['custom_js']) ? esc_attr($customfiles_meta['custom_js'] [0]) : '';

	wp_nonce_field('post_customfiles_nonce', 'customfiles_nonce');
?>
	<p>
		<label for="custom_css">Custom CSS</label>
		<input type="text" name="custom_css" id="custom_css" value="<?php echo $cssfile; ?>" class="widefat" />
	</p>

	<p>
		<label for="custom_js">Custom JavaScript</label>
		<input type="text" name="custom_js" id="custom_js" value="<?php echo $jsfile; ?>" class="widefat" />
	</p>
<?php }

function post_customfiles_nonce($post_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	if(!isset($_POST['customfiles_nonce']) || !wp_verify_nonce($_POST['customfiles_nonce'], 'post_customfiles_nonce')) return;
	
	if(!current_user_can('edit_post')) return;

	if(isset($_POST['custom_css']))
		update_post_meta($post_id, 'custom_css', wp_kses_post($_POST['custom_css']));

	if(isset($_POST['custom_js']))
		update_post_meta($post_id, 'custom_js', wp_kses_post($_POST['custom_js']));
}
add_action('save_post', 'post_customfiles_nonce');

//Remove arbitrary actions

remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');


//Custom Comment Design
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

//Add extra body classes
function extra_body_classes($classes) {

	//Just to seperate the blog from the rest of the site
	if(!is_single() && !is_category('portfolio')) {
		$classes[] = 'site';
	}

	//---Semantic classes!
	global $is_IE, $is_opera, $is_safari, $is_chrome, $is_gecko;

	$browser = strtolower($_SERVER['HTTP_USER_AGENT']);

	//---Find the devices first
	if(stripos($browser, 'ipod, iphone, ipad')) {
		array_push($classes, 'mobile', 'ios');
	} elseif(stripos($browser, 'android')) {
		array_push($classes, 'mobile', 'android');
	} elseif(stripos($browser, 'mac')) {
		$classes[] = 'mac';
	} elseif(stripos($browser, 'linux')) {
		$classes[] = 'linux';
	} elseif(stripos($browser, 'windows')) {
		$classes[] = 'pc';
	} elseif(stripos($browser, 'blackberry')) {
		array_push($classes, 'mobile', 'blackberry');
	}

	//---Browser and their versions
	if($is_chrome) {
		$classes[] = 'chrome';
	} elseif($is_safari) {
		$classes[] = 'safari';
	} elseif($is_gecko && stripos($browser, 'firefox')) {
		$classes[] = 'firefox';
	} elseif($is_opera) {
		$classes[] = 'opera';
	} elseif($is_IE) {
		$classes[] = 'ie';
		if(stripos($browser, 'msie7.0')) {
			$classes[] = 'ie7';
		} elseif(stripos($browser, 'msie8.0')) {
			$classes[] = 'ie8';
		} elseif(stripos($browser, 'msie9.0')) {
			$classes[] = 'ie9';
		} elseif(stripos($browser, 'msie10.0')) {
			$classes[] = 'ie10';
		}
	}

	//---Browser engine
	if(stripos($browser, 'webkit')) {
		$engine = 'webkit';
	} elseif(stripos($browser, 'gecko') && !stripos($browser, 'webkit')) {
		$engine = 'gecko';
	} elseif(stripos($browser, 'presto')) {
		$engine = 'presto';
	} elseif(stripos($browser, 'trident')) {
		$engine = 'trident';
	}

	$classes[] = $engine;


	//LET'S DO THIS FOO'.
	return $classes;
}
add_filter('body_class','extra_body_classes');


//Login file linking
function custom_login_files() {
	$files = '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/login.css" />
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