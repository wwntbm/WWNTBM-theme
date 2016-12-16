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

				<div id="motd_wrapper">
					<?php echo do_shortcode('[potd display="thumbnail"]'); ?>
					<?php echo do_shortcode('[potd display="link"]'); ?>
						<h2><span class="hide rounded">Missionary of the Day</span></h2>
					</a>
				</div>

				<a class="home-button rounded shadowed" id="who" href="<?php bloginfo('url'); ?>/connect/missionaries/" title="Who We Are">
					<h2><span class="hide rounded">Who We Are</span></h2>
				</a>

				<a class="home-button rounded shadowed" id="where" href="<?php bloginfo('url'); ?>/connect/fields-of-service/" title="Where We Serve">
					<h2><span class="hide rounded">Where We Serve</span></h2>
				</a>

				<a class="home-button rounded shadowed" id="beliefs" href="<?php bloginfo('url'); ?>/learn/our-doctrinal-statement/" title="What We Believe">
					<h2><span class="hide rounded">What We Believe</span></h2>
				</a>

				<a class="home-button rounded shadowed" id="contact" href="<?php bloginfo('url'); ?>/connect/contact-wwntbm/" title="Who We Are">
					<h2><span class="hide rounded">How to Contact Us</span></h2>
				</a>

				<a class="home-button rounded shadowed" id="missions-today" href="http://missions.today" title="Missions.today - a resource blog from WWNTBM">
					<h2><span class="hide rounded">Missions Resources</span></h2>
				</a>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar('home'); ?>
<?php get_footer(); ?>
