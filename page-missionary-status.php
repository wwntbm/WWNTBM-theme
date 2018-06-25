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
				<article id="post-<?php the_ID(); ?>" class="post-<?php the_ID(); ?> page type-page status-publish hentry">
				<header class="entry-header">
					<h1 class="entry-title">Missionary Status</h1>
				</header><!-- .entry-header -->

				<?php
					// get unique status
					$status_list = get_terms( 'wwntbm_status' );
					$status_count = ( count( $status_list ) );
				?>

					<div class="entry-content">
					<ul class="dropdown">

					<?php
					foreach ( $status_list as $status ) {
						echo '<li class="dropdown_trigger">' . $status->name . ' (' . $status->count . ')
						<ul class="sub_links" style="display:none;">';
						// get all missionaries for this status type
						$status_missionaries_query = new WP_Query(
							 array(
								 'post_type' => 'wwntbm_missionaries',
								 'posts_per_page' => -1,
								 'tax_query' => array(
									 array(
										 'taxonomy'  => 'wwntbm_status',
										 'field'     => 'slug',
										 'terms'     => $status->slug,
									 ),
								 ),
								 'meta_query' => array(
									 array(
										 'key' => 'missionary_key',
										 'type' => 'CHAR',
									 ),
								 ),
								 'orderby' => 'meta_value',
								 'order' => 'ASC',
							 )
							);

						while ( $status_missionaries_query->have_posts() ) :
							$status_missionaries_query->the_post();

							// get field
							$this_post_ID = get_the_ID();
							$field = get_post_meta( $this_post_ID, 'missionary_field', 'true' );
							$field_region = get_post_meta( $this_post_ID, 'missionary_field_region', 'true' );

							echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a>';

							// echo field region
							if ( $field != null ) {
								echo '<span class="field-region"> &mdash; ' . $field;
								if ( $field_region != null ) {
									echo ' (' . $field_region . ')';
								}
								echo '</span>';
							}
							echo '</li>';

						endwhile; // end The Loop

						echo '</ul><!-- .sublinks -->
					</li>';
					}
					?>
					</ul><!-- .dropdown -->
					</div><!-- .entry-content -->
				</article><!-- .page -->

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
