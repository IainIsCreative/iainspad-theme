			<aside id="sidebar-left">

			<?php if(is_page('About')) { ?>
			<img src="<?php bloginfo('template_url'); ?>/img/avatar.png" alt="Hey, that's me!" />

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
					<noscript>
						<h4>Other ways of Contact</h4>
						<p>I love hearing from people! I like discussing Design, Development, and ideas. I can be found on any of the following sites, and would love to hear from you. You may also want to check out the links belo, I'm quite social.</p>
					</noscript>
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
