<?php
/**
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

                <div class="entry-content">
                    <ul class="dropdown">
                    <?php
                        // get status
                        $status_args = array(
                            'taxonomy'      => 'wwntbm_status',
                            'show_count'    => '1',
                            'title_li'      => '',
                        );
                        wp_list_categories( $status_args );
                    ?>
                    </ul><!-- .dropdown -->
                </div><!-- .entry-content -->
            </article><!-- .page -->

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
