<?php
/*
Template Name: Contact
*/

//Contact Form
if(isset($_POST['submitted'])) {

	if(trim($_POST['mailname']) === '') {
		$nameError = ' You haven\'t entered a name.';
		$hasError = true;
	} else {
		$name = trim($_POST['mailname']);
	}

	if(trim($_POST['email']) === '') {
		$emailError = ' You haven\'t entered an E-mail address';
		$hasError = true;
	} elseif (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = 'You haven\'t entered a valid E-mail address';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['message']) === '') {
		$messageError = ' You haven\'t entered a message';
		$hasError = true;
	} elseif (strlen($_POST['message']) < 20) {
		$messageError = ' Your message must have more than 20 Characters';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['message']));
		} else {
			$message = trim($_POST['message']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = 'iainspad@gmail.com';
		$subject = 'New E-mail from ' .$name. '!';
		$body = "Name: $name \n\n Email: $email \n\n Message: $message";
		$headers = 'From http:iainspad.com' . "\r\n" . 'Reply-To ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}

?>
<?php get_header(); ?>
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div id="content">
			<?php get_sidebar('left'); ?>
			<section class="page-entry">
				<?php if(isset($emailSent) && $emailSent == true) { ?>
				<?php the_content(); ?>
				<div class="success">
					<h5>Thanks <?=$name; ?>! Your E&ndash;Mail has been sent.</h5>
				</div>
				<form id="contact-form" action="<?php the_permalink(); ?>" method="post">
					<input type="text" id="name" class="required" name="mailname" placeholder="Your Name" required="required" />
					<input type="email" id="email" class="required" name="email" placeholder="Your E–mail address" required="required" />
					<textarea id="message" class="required" name="message" placeholder="Your Message must be greater than 20 characters" required="required" data-minlength="20"></textarea>
					<input type="submit" value="Send Message" />
					<input type="hidden" id="submitted" name="submitted" value="true" />
				</form>
				<?php } else { ?>
				<?php the_content(); ?>
				<div class="error" style="<?php if(!isset($hasError)) { ?>display: none;<?php } ?>" >
					<h5>Sorry dude! There was an error processing the form.</h5>
					<ul>
						<?php if(isset($hasError)) { ?>
						<?php if($nameError) { ?>
						<li><?=$nameError; ?></li>
						<?php } ?>
						<?php if($emailError) { ?>
						<li><?=$emailError; ?></li>
						<?php } ?>
						<?php if($messageError) { ?>
						<li><?=$messageError; ?></li>
						<?php } ?>
						<?php } ?>
					</ul>
				</div>
				<form id="contact-form" action="<?php the_permalink(); ?>" method="post">
					<input type="text" id="name" class="required" name="mailname" placeholder="Your Name" required="required" value="<?php if(isset($_POST['mailname'])) echo $_POST['mailname']; ?>" />
					<input type="email" id="email" class="required" name="email" placeholder="Your E–mail address" required="required" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" />
					<textarea id="message" class="required" name="message" placeholder="Your Message must be greater than 20 characters" required="required" data-minlength="20"><?php if(isset($_POST['message'])) {
						if(function_exists('stripslashes')) {
							echo stripslashes($_POST['message']);
						} else {
							echo $_POST['message'];
						}
					} ?></textarea>
					<input type="submit" value="Send Message" />
					<input type="hidden" id="submitted" name="submitted" value="true" />
				</form>
				<?php } ?>
			</section>
		</div>
	</article>
	<?php endwhile; endif; ?>
<?php get_footer(); ?>