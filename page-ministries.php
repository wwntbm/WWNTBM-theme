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
                    <h1 class="entry-title">Ministries</h1>
                </header><!-- .entry-header -->

                <?php
                    // get unique ministries
                    $ministries_list = get_terms( 'wwntbm_ministries' );
                    $ministry_count = (count($ministries_list));
                ?>

                    <div class="entry-content">
                    <ul class="dropdown">

                    <?php
                    foreach ($ministries_list as $ministry) {
                        echo '<li><a class="dropdown_trigger"><span class="trigger_pointer_arrow"></span>'.$ministry->name.'</a> ('.$ministry->count.')
                        <ul class="sub_links" style="display:none;">';
                        // get all missionaries for this ministry type
                        $ministry_args = array(
                            'post_type' => 'wwntbm_missionaries',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array(
                                    'taxonomy'  => 'wwntbm_ministries',
                                    'field'     => 'slug',
                                    'terms'     => $ministry->slug,
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
                        );

                        $ministry_missionaries_query = new WP_Query( $ministry_args );

                        while ( $ministry_missionaries_query->have_posts() ) : $ministry_missionaries_query->the_post(); // begin The Loop

                            //   get field
                            $this_post_ID = get_the_ID();
                            $field = get_post_meta($this_post_ID, 'Field', 'true');
                            $field_region = get_post_meta($this_post_ID, 'Field Region', 'true');

                            echo '<li><a href="' . get_permalink() . '">'. get_the_title() . '</a>';

                            //   echo field region
                            if ($field != NULL) {
                                echo '<span class="field-region"> &mdash; '.$field;
                                if ($field_region != NULL) {echo ' ('.$field_region.')';}
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
