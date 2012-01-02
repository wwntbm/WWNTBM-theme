<?php

// Add missionaries custom post type
function create_post_type() {
	register_post_type( 'wwntbm_missionaries',
		array(
			'supports' => array(
				'title',
				'editor',
				'custom-fields',
				'revisions',
				'thumbnail',
				'author'
			),
			'labels' => array(
				'name' => __( 'Missionaries' ),
				'singular_name' => __( 'Missionary' ),
				'add_new_item' => __( 'Add New Missionary' ),
				'edit_item' => __( 'Edit Missionary' ),
				'new_item' => __( 'New Missionary' ),
				'view_item' => __( 'View Missionary' ),
				'search_items' => __( 'Search Missionaries' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'missionaries'),
			'capability_type' => 'missionary_info'
		)
	);
}

// Styling for the custom post type icon
function wwntbm_custom_post_icons() {
	?>
	<style type="text/css" media="screen">
		#menu-posts-wwntbm_missionaries .wp-menu-image {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/user.png) no-repeat 6px -16px !important;
		}
		#menu-posts-wwntbm_missionaries:hover .wp-menu-image, #menu-posts-wwntbm_missionaries.wp-has-current-submenu .wp-menu-image {
			background-position:6px 8px !important;
		}
	</style>
<?php }


add_action( 'init', 'create_post_type' );
add_action( 'admin_head', 'wwntbm_custom_post_icons' );

?>