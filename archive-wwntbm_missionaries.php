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
				<article class="page type-page status-publish hentry">
				<h1 class="entry-title">Missionaries</h1>
					<div class="entry-content">
					<?php while ( have_posts() ) : the_post();
	
						echo '<h2><a href="';
						the_permalink();
						echo '">';
						the_title();
						echo '</a>';
						$wwntbm_field = get_post_meta(get_the_ID(), 'Field', true);
						if ($wwntbm_field != NULL) {echo '<span class="field-of-service"> &mdash; '.$wwntbm_field.'</span>';}
						echo '</h2>';
	
					endwhile; // end of the loop. ?>
					</div>
				</article><!-- .page -->

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>