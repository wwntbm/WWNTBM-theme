<?php
/**
 * Template Name: Home
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

		<?php
		if ( function_exists( 'meteor_slideshow' ) ) {
			meteor_slideshow();
		}
		?>
		<div id="primary">
			<div id="content" role="main">

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

				<?php the_content(); ?>

				<div class="home-button">
					<?php echo do_shortcode( '[potd display="link"]' ); ?>
					<?php echo do_shortcode( '[potd display="thumbnail"]' ); ?>
						<h2 class="subtitle">Missionary of the Day</h2>
					</a>
				</div>

				<a class="home-button" href="<?php echo esc_url( get_home_url() ); ?>/connect/missionaries/" title="Who We Are">
					<img class="rounded shadowed" src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-buttons/missionaries.jpg" alt="Who We Are" />
					<h2 class="subtitle">Who We Are</h2>
				</a>

				<a class="home-button" href="<?php echo esc_url( get_home_url() ); ?>/connect/fields-of-service/" title="Where We Serve">
					<img class="rounded shadowed" src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-buttons/where-we-are.jpg" alt="Where We Serve" />
					<h2 class="subtitle">Where We Serve</h2>
				</a>

				<a class="home-button" href="<?php echo esc_url( get_home_url() ); ?>/learn/our-doctrinal-statement/" title="What We Believe">
					<img class="rounded shadowed" src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-buttons/Bible.jpg" alt="What We Believe" />
					<h2 class="subtitle">What We Believe</h2>
				</a>

				<a class="home-button" href="<?php echo esc_url( get_home_url() ); ?>/connect/contact-wwntbm/" title="How to Contact Us">
					<img class="rounded shadowed" src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-buttons/contact-us.jpg" alt="How to Contact Us" />
					<h2 class="subtitle">How to Contact Us</h2>
				</a>

				<a class="home-button" href="http://missions.today" title="Missions.today - a resource blog from WWNTBM">
					<img class="rounded shadowed" src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-buttons/missions-today-logo.jpg" alt="Missions.today - a resource blog from WWNTBM" />
					<h2 class="subtitle">Missions Resources</h2>
				</a>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar( 'home' ); ?>
<?php get_footer(); ?>
