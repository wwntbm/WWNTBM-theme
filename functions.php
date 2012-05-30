<?php

// Add custom post types
function create_post_type() {
	// Add missionaries custom post type
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
			'rewrite' => array( 'slug' => 'connect/missionaries', 'with_front' => 'false' ),
			'capability_type' => 'missionary_info'
		)
	);
	// end Add missionaries custom post type
	// Add missionary updates custom post type
	register_post_type( 'wwntbm_updates',
		array(
			'supports' => array(
				'title',
				'editor',
				'revisions',
				'thumbnail',
				'comments',
				'author'
			),
			'labels' => array(
				'name' => __( 'Missionary Updates' ),
				'singular_name' => __( 'Missionary Update' ),
				'add_new_item' => __( 'Add New Missionary Update' ),
				'edit_item' => __( 'Edit Missionary Update' ),
				'new_item' => __( 'New Missionary Update' ),
				'view_item' => __( 'View Missionary Update' ),
				'search_items' => __( 'Search Missionary Updates' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'connect/missionary-updates', 'with_front' => 'false' ),
			'capability_type' => 'missionary_update',
			'taxonomies' => array('wwntbm_ministries')
		)
	);
	// end Add missionary updates custom post type
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
			#menu-posts-wwntbm_updates .wp-menu-image {
				background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/newspapers.png) no-repeat 6px -16px !important;
			}
			#menu-posts-wwntbm_updates:hover .wp-menu-image, #menu-posts-wwntbm_updates.wp-has-current-submenu .wp-menu-image {
				background-position:6px 8px !important;
			}
		</style>
	<?php }
// end Add custom post types


// Add custom taxonomy for ministries
function ministries_init() {
	// create a new taxonomy
	register_taxonomy(
		'wwntbm_ministries',
		'wwntbm_missionaries',
		array(
			'label' => 'Ministry Type',
			'hierarchical' => false,
			'sort' => true,
			'rewrite' => array( 'slug' => 'ministry' ),
			'show_tag_cloud' => false
		)
	);
}
// end Add custom taxonomy for ministries


// Add custom post capabilities
	$administrator_role = get_role('administrator');
	$administrator_role->add_cap( 'edit_missionary_info' );
	$administrator_role->add_cap( 'edit_missionary_infos' );
	$administrator_role->add_cap( 'edit_others_missionary_info' );
	$administrator_role->add_cap( 'edit_others_missionary_infos' );
	$administrator_role->add_cap( 'publish_missionary_infos' );
	$administrator_role->add_cap( 'read_missionary_infos' );
	$administrator_role->add_cap( 'delete_missionary_infos' );
	
	$administrator_role->add_cap( 'edit_missionary_update' );
	$administrator_role->add_cap( 'edit_missionary_updates' );
	$administrator_role->add_cap( 'edit_others_missionary_update' );
	$administrator_role->add_cap( 'edit_others_missionary_updates' );
	$administrator_role->add_cap( 'read_missionary_updates' );
	$administrator_role->add_cap( 'publish_missionary_updates' );
	$administrator_role->add_cap( 'delete_missionary_update' );
// end Add custom post capabilities


// Add office staff custom role 
	// get_role returns an object; we want the capabilities piece, which is an array.
	$office_staff_caps = $administrator_role->capabilities;
	 
	// set custom capabilities
	unset($office_staff_caps['install_plugins']);
	unset($office_staff_caps['activate_plugins']);
	unset($office_staff_caps['delete_plugins']);
	unset($office_staff_caps['edit_plugins']);
	unset($office_staff_caps['install_themes']);
	unset($office_staff_caps['delete_themes']);
	unset($office_staff_caps['edit_themes']);
	unset($office_staff_caps['switch_themes']);
	unset($office_staff_caps['promote_users']);
	 
	// Add the new role.
	add_role('office_staff', 'Office Staff', $office_staff_caps);
	
	// add custom capabilities
	$office_staff_role = get_role('office_staff');
	$office_staff_role->add_cap( 'edit_missionary_update' );
	$office_staff_role->add_cap( 'edit_missionary_updates' );
	$office_staff_role->add_cap( 'edit_others_missionary_update' );
	$office_staff_role->add_cap( 'edit_others_missionary_updates' );
	$office_staff_role->add_cap( 'read_missionary_updates' );
	$office_staff_role->add_cap( 'publish_missionary_updates' );
	$office_staff_role->add_cap( 'delete_missionary_update' );
	$office_staff_role->add_cap( 'read_private_pages' );
	$office_staff_role->add_cap( 'manage_options' );
// end Add office staff custom role


// Add missionaries custom role
	$author_role = get_role('author');
 
	// get_role returns an object; we want the capabilities piece, which is an array.
	$missionary_caps = $author_role->capabilities;
	 
	// Remove the stuff we don't want in the new role.
	unset($missionary_caps['edit_missionary_info']);
	unset($missionary_caps['edit_missionary_infos']);
	unset($missionary_caps['read_missionary_infos']);
	unset($missionary_caps['edit_others_missionary_infos']);
	unset($missionary_caps['publish_missionary_infos']);
	unset($missionary_caps['delete_missionary_infos']);
	 
	// Add the new role.
	add_role('missionary', 'Missionary', $missionary_caps);

	// add custom capabilities
	$missionary_role = get_role('missionary');
	$missionary_role->add_cap( 'edit_missionary_update' );
	$missionary_role->add_cap( 'edit_missionary_updates' );
	$missionary_role->add_cap( 'publish_missionary_updates' );
	$missionary_role->add_cap( 'read_private_pages' );
// end Add missionaries custom role


// missionary prayer letter names
function missionary_prayer_letters($file,$missionary_name_key) {
	$file_extension = pathinfo($file, PATHINFO_EXTENSION);
	$month_numbers = array('01','02','03','04','05','06','07','08','09','10','11','12');
	$month_names = array('January','February','March','April','May','June','July','August','September','October','November','December');
	
	// rename prayer letter
	$prayer_letter_title = str_ireplace($missionary_name_key.'---','',(basename($file,'.'.$file_extension)));
		// filter out month
		$prayer_letter_month_array = explode('-',$prayer_letter_title);
		$prayer_letter_month = $prayer_letter_month_array[1];
		$prayer_letter_year = $prayer_letter_month_array[0];
				
	// build title
	$prayer_letter_title = str_replace($month_numbers, $month_names, $prayer_letter_month).' '.$prayer_letter_year;
	
	// check for special titles
	if ($prayer_letter_month_array[2] != NULL) {$prayer_letter_title .= ' ('.$prayer_letter_month_array[2].')';}
	
	// echo the <li> item
	echo '<li><a target="_blank" href="'.site_url('/').$file.'" title="'.$prayer_letter_title.'">'.$prayer_letter_title.'</a></li>'."\n";
}
// end missionary prayer letter names


// add sidebar for home page
function WWNTBM_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Homepage Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-6',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}


// add custom thumbnail size for missionary archive page
if ( function_exists( 'add_theme_support' ) ) { 
add_theme_support( 'post-thumbnails' );
add_image_size( 'category-thumb', 150, 100, true );
}


// add sidebar to all pages
function my_child_theme_setup() {
	// Removes the filter that adds the "singular" class to the body element which centers the content and does not allow for a sidebar
	remove_filter( 'body_class', 'twentyeleven_body_classes' );
}
// end add sidebar to all pages

// hide widgets
function remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboardb_xavisys', 'dashboard', 'normal' );
	remove_meta_box( 'w3tc_latest', 'dashboard', 'normal' );
	remove_meta_box( 'w3tc_pagespeed', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
} 
// end hide widgets

// AndrewRMinion branding
	// change login page link
	function wpc_url_login(){
		return "http://wwntbm.com/"; // your URL here
	}
	add_filter('login_headerurl', 'wpc_url_login');
	
	// customize login page logo
	function login_css() {
		wp_enqueue_style( 'login_css', get_stylesheet_directory_uri() . '/login.css' );
	}
	add_action('login_head', 'login_css');
	
	// custom admin footer
	function remove_footer_admin () {
		echo '&copy; '.date('Y').' by <a href="http://andrewrminion.com/" target="_blank">AndrewRMinion Design</a>.';
	}
	add_filter('admin_footer_text', 'remove_footer_admin');
	
	// technical info widget
	function armd_dashboard_widget_function() {
		// Entering the text between the quotes
		echo "<ul>
		<li>Release Date: May 2012</li>
		<li>Author: <a href=\"http://andrewrminion.com/\" target=\"_blank\">AndrewRMinion Design</a></li>
		<li>Hosting provider: ANHosting (WWNTBM account)</li>
		</ul>";
	}
	function armd_add_dashboard_widgets() {
		wp_add_dashboard_widget('wp_dashboard_widget', 'Technical information', 'armd_dashboard_widget_function');
	}
	add_action('wp_dashboard_setup', 'armd_add_dashboard_widgets' );
// end AndrewRMinion branding

// add actions
add_action( 'init', 'create_post_type' );
add_action( 'init', 'ministries_init' );
add_action( 'admin_head', 'wwntbm_custom_post_icons' );
add_action( 'widgets_init', 'WWNTBM_widgets_init' );
add_action( 'after_setup_theme', 'my_child_theme_setup' );

if (!current_user_can('manage_options')) {
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
}

?>