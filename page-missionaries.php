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

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
					
							<?php if ( 'post' == get_post_type() ) : ?>
							<div class="entry-meta">
								<?php twentyeleven_posted_on(); ?>
							</div><!-- .entry-meta -->
							<?php endif; ?>
						</header><!-- .entry-header -->
					
						<div class="entry-content">
						<?php
							$args = array( 'post_type' => 'wwntbm_missionaries', 'orderby' => 'meta_value', 'meta_key' => 'Last Name', 'order' => 'ASC' );
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
								echo '<h2><a href="';
								the_permalink();
								echo '">';
								the_title();
								echo '</a>';
								$wwntbm_field = get_post_meta(get_the_ID(), 'Field', true);
								if ($wwntbm_field != NULL) {echo '<span class="field-of-service"> &mdash; '.$wwntbm_field.'</span>';}
								echo '</h2>';
							endwhile;
						?>
						</div><!-- .entry-content -->
					
					</article><!-- #post-<?php the_ID(); ?> -->

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>