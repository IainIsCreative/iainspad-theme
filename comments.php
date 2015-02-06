<?php

	//DO NOT DELETE THESE LINES!!
	if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die('Please do not load this page directly. Thanks!');

	if (post_password_required()) { ?>

	<h4>This post is password protected. Enter the password to view Comments.</h4>

<?php
		return;
	}
?>

		<section id="comments">

			<h3><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></h3>

			<?php if(have_comments()) : ?>
				<ol class="commentslist">
					<?php wp_list_comments(array('callback' => 'blog_comments')); ?>
				</ol>

			<?php if($wp_query->max_num_pages > 1) : ?>

				<nav class="comments-navigation">
					<ul>
						<li class="prev"><?php previous_comments_link('Older Comments'); ?></li>
						<li class="next"><?php next_comments_link('Newer Comments'); ?></li>
					</ul>
				</nav>

			<?php endif; endif; ?>
			<?php if(comments_open()) : ?>

				<div id="respond">
					<h3>Leave a Comment</h3>
					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comments-form" class="form comments-form">
						<input type="text" class="form__input form__input--comments" name="author" id="author" value="<?php echo $comment_author; ?>" required="required" placeholder="Your Name" />
						<input type="email" class="form__input form__input--comments" name="email" id="email" value="<?php echo $comment_author_email; ?>" required="required" placeholder="Your E-mail" />
						<input type="url" class="form__input form__input--comments" name="url" id="url" value="<?php echo $comment_author_url; ?>" placeholder="Your Website" />
						<textarea class="form__textarea form__textarea--comments" name="comment" id="comment" required="required" placeholder="Tell me how awesome the article was!"></textarea>
						<input type="submit" value="Submit Comment" />
						<?php comment_id_fields(); ?>
						<?php do_action('comment_form', $post->ID); ?>
					</form>
					<p class="cancel"><?php cancel_comment_reply_link('Cancel Reply'); ?></p>
				</div>
			<?php else : ?>
			<h3>Comments for "<?php the_title(); ?>" are now closed.</h3>
			<?php endif; ?>
		</section>
