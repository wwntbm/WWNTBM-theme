<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'missionary-updates' ); ?>

				<?php endwhile; // end of the loop. ?>

				<div class="fb-comments" data-href="<?php echo home_url().$_SERVER['REQUEST_URI']; ?>" data-num-posts="3" data-width="470"></div>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>