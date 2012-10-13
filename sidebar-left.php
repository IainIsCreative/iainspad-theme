			<aside id="sidebar-left">
			<?php if(is_single()) { ?>
				<section class="tags">
					<h4>Disciplines</h4>
					<?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
				</section>
				<?php if(get_post_meta($post->ID, 'client_meta', true)) { ?>
				<section class="client">
					<h4>Client</h4>
					<?php if(get_post_meta($post->ID, 'client_url_meta', true)) { ?>
					<a href="<?php echo get_post_meta($post->ID, 'client_url_meta', true); ?>" title="<?php echo get_post_meta($post->ID, 'client_meta', true); ?>" target="blank"><?php echo get_post_meta($post->ID, 'client_meta', true); ?></a>
					<?php } else { ?>
					<p><?php echo get_post_meta($post->ID, 'client_meta', true); ?></p>
					<?php } ?>
				</section>
				<?php } ?>
				<?php if(get_post_meta($post->ID, 'client_testimonial_meta', true)) { ?>
				<section class="testimonial">
					<h4>Testimonial</h4>
					<blockquote><?php echo get_post_meta($post->ID, 'client_testimonial_meta', true); ?></blockquote>
					<cite><a href="<?php echo get_post_meta($post->ID, 'citation_url_meta', true); ?>" target="blank"><?php echo get_post_meta($post->ID, 'citation_meta', true); ?></a></cite>
				</section>
				<?php } ?>
			<?php } elseif(is_page('About')) { ?>
			<img src="<?php bloginfo('template_url'); ?>/img/avatar.png" alt="Hey, that's me!" />
			<!--<section class="skills">
				<h4>Skills</h4>
				<ul>
					<li>Photoshop/Illustrator</li>
					<li>HTML/CSS</li>
					<li>jQuery</li>
					<li>Wordpress</li>
					<li>Charisma</li>
				</ul>
			</section>-->
			<section class="colophon">
				<h4>Colophon</h4>
				<ul>
					<li>Designed in <a href="http://www.adobe.com/products/photoshop.html" target="blank">PhotoShop</a></li>
					<li>Coded in <a href="http://www.sublimetext.com/2" target="blank">Sublime Text 2</a></li>
					<li>Written in <a href="http://www.w3schools.com/html5/default.asp" target="blank">HTML</a> and <a href="http://css3.info" target="blank" class="teal">CSS3</a></li>
					<li>Powered by <a href="http://wordpress.org" target="blank">Wordpress</a></li>
					<li>Hosted by <a href="http://mediatemple.net" target="blank">MediaTemple</a></li>
				</ul>
			</section>
			<?php } elseif(is_page('Contact')) { ?>
				<section class="contact">
					<h4>Other ways of Contact</h4>
					<p>I love hearing from people! I like discussing Design, Development, and ideas. I can be found on any of the following sites, and would love to hear from you. You may also want to check out the links belo, I'm quite social.</p>
				</section>
				<section class="twitter">
					<h4>Twitter</h4>
					<ul class="tweets"></ul>
				</section>
				<nav class="social-networking">
					<ul>
						<li><a href="http://twitter.com/iainspad" target="blank">Twitter</a></li>
						<li><a href="http://dribbble.com/iainspad" target="blank">Dribbble</a></li>
						<li><a href="https://forrst.com/people/iainspad" target="blank">Forrst</a></li>
						<li><a href="https://www.facebook.com/pages/Iainspad/123090577838529" target="blank">Facebook</a></li>
					</ul>
				</nav>
			<?php } ?>
			</aside>