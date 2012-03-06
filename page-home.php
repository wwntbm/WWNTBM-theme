<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

		<?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?>
		<div id="primary">
			<div id="content" role="main">

				<?php twentyeleven_content_nav( 'nav-above' ); ?>
				
				<a class="home-button" id="who" href="<?php bloginfo('url'); ?>/connect/missionaries/" title="Who We Are">
					<h2><span class="hide">Who We Are</span></h2>
				</a>
				
				<a class="home-button" id="where" href="<?php bloginfo('url'); ?>/connect/countries/" title="Where We Serve">
					<h2><span class="hide">Where We Serve</span></h2>
				</a>
				
				<a class="home-button" id="beliefs" href="<?php bloginfo('url'); ?>/learn/our-doctrinal-statement/" title="What We Believe">
					<h2><span class="hide">What We Believe</span></h2>
				</a>
				
				<a class="home-button" id="contact" href="<?php bloginfo('url'); ?>/connect/contact-wwntbm/" title="Who We Are">
					<h2><span class="hide">How to Contact Us</span></h2>
				</a>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar('home'); ?>
<?php get_footer(); ?>