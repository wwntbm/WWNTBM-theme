<?php

define( 'WWNTBM_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Enqueue Google fonts and add cache-busting query string to stylesheet
 */
function wwntbm_assets() {
	wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Lato:400,400i,900,900i' );
	wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), WWNTBM_THEME_VERSION );

	wp_enqueue_script( 'frontend', get_stylesheet_directory_uri() . '/js/frontend.min.js', array( 'jquery' ), WWNTBM_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'wwntbm_assets' );

/**
 * Add office staff role.
 */
$administrator_role = get_role( 'administrator' );
	// get_role returns an object; we want the capabilities piece, which is an array.
	$office_staff_caps = $administrator_role->capabilities;

	// Set custom capabilities.
	unset( $office_staff_caps['install_plugins'] );
	unset( $office_staff_caps['activate_plugins'] );
	unset( $office_staff_caps['delete_plugins'] );
	unset( $office_staff_caps['edit_plugins'] );
	unset( $office_staff_caps['install_themes'] );
	unset( $office_staff_caps['delete_themes'] );
	unset( $office_staff_caps['edit_themes'] );
	unset( $office_staff_caps['switch_themes'] );
	unset( $office_staff_caps['promote_users'] );

	// Add the new role.
	add_role( 'office_staff', 'Office Staff', $office_staff_caps );

	// Add custom capabilities.
	$office_staff_role = get_role( 'office_staff' );
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
	$author_role = get_role( 'author' );

	// get_role returns an object; we want the capabilities piece, which is an array.
	$missionary_caps = $author_role->capabilities;

	// Remove the stuff we don't want in the new role.
	unset( $missionary_caps['edit_missionary_info'] );
	unset( $missionary_caps['edit_missionary_infos'] );
	unset( $missionary_caps['read_missionary_infos'] );
	unset( $missionary_caps['edit_others_missionary_infos'] );
	unset( $missionary_caps['publish_missionary_infos'] );
	unset( $missionary_caps['delete_missionary_infos'] );
	unset( $missionary_caps['manage_options'] );

	// Add the new role.
	add_role( 'missionary', 'Missionary', $missionary_caps );

	// add custom capabilities
	$missionary_role = get_role( 'missionary' );
	$missionary_role->add_cap( 'edit_missionary_update' );
	$missionary_role->add_cap( 'edit_missionary_updates' );
	$missionary_role->add_cap( 'publish_missionary_updates' );
	$missionary_role->add_cap( 'read_private_pages' );


// end Add missionaries custom role
// missionary prayer letter names
function missionary_prayer_letters( $file, $missionary_name_key ) {
	$file_extension = pathinfo( $file, PATHINFO_EXTENSION );
	$month_numbers = array( '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' );
	$month_names = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );

	// rename prayer letter
	$prayer_letter_title = str_ireplace( $missionary_name_key . '---', '', ( basename( $file, '.' . $file_extension ) ) );
		// filter out month
		$prayer_letter_month_array = explode( '-', $prayer_letter_title );
		$prayer_letter_month = $prayer_letter_month_array[1];
		$prayer_letter_year = $prayer_letter_month_array[0];

	// build title
	$prayer_letter_title = str_replace( $month_numbers, $month_names, $prayer_letter_month ) . ' ' . $prayer_letter_year;

	// check for special titles
	if ( $prayer_letter_month_array[2] != null ) {
$prayer_letter_title .= ' (' . $prayer_letter_month_array[2] . ')';}

	// echo the <li> item
	echo '<li><a target="_blank" href="' . site_url( '/' ) . $file . '" title="' . $prayer_letter_title . '">' . $prayer_letter_title . '</a></li>' . "\n";
}
// end missionary prayer letter names
// add sidebar for home page
function WWNTBM_widgets_init() {
	register_sidebar(
		 array(
			 'name' => __( 'Homepage Sidebar', 'twentyeleven' ),
			 'id' => 'sidebar-6',
			 'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			 'after_widget' => '</aside>',
			 'before_title' => '<h3 class="widget-title">',
			 'after_title' => '</h3>',
		 )
		);
}


// add custom thumbnail size for missionary archive page
if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
add_image_size( 'category-thumb', 150, 100, true );
add_image_size( 'category-thumb-m', 225, 150, true );
add_image_size( 'category-thumb-l', 300, 200, true );
add_image_size( 'missionary_of_the_day', 250, 150, true );
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
	function wpc_url_login() {
	return 'http://wwntbm.com/'; // your URL here
	}
	add_filter( 'login_headerurl', 'wpc_url_login' );

	// customize login page logo
	function login_css() {
	wp_enqueue_style( 'login_css', get_stylesheet_directory_uri() . '/login.css' );
	}
	add_action( 'login_head', 'login_css' );

	// custom admin footer
	function remove_footer_admin() {
	echo '&copy; ' . date( 'Y' ) . ' by <a href="http://andrewrminion.com/" target="_blank">AndrewRMinion Design</a>.';
	}
	add_filter( 'admin_footer_text', 'remove_footer_admin' );

	// technical info widget
	function armd_dashboard_widget_function() {
	// Entering the text between the quotes
	echo '<ul>
        <li>Release Date: May 2012</li>
        <li>Developer: <a href="http://andrewrminion.com/" target="_blank">AndrewRMinion Design</a></li>
        <li>Hosting provider: ANHosting (WWNTBM account)</li>
        </ul>';
	}
	function armd_add_dashboard_widgets() {
	wp_add_dashboard_widget( 'wp_dashboard_widget', 'Technical information', 'armd_dashboard_widget_function' );
	}
	add_action( 'wp_dashboard_setup', 'armd_add_dashboard_widgets' );
// end AndrewRMinion branding
// add actions
add_action( 'widgets_init', 'WWNTBM_widgets_init' );
add_action( 'after_setup_theme', 'my_child_theme_setup' );

if ( ! current_user_can( 'manage_options' ) ) {
	add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

	// hide some admin menu options
	function my_remove_menu_pages() {
		remove_menu_page( 'upload.php' ); // Media
		remove_menu_page( 'edit-comments.php' ); // Comments
		remove_menu_page( 'edit.php?post_type=slide' ); // Slides
	}
	add_action( 'admin_menu', 'my_remove_menu_pages' );
	// hide Contact Form
	define( 'WPCF7_ADMIN_READ_CAPABILITY', 'manage_options' );
	define( 'WPCF7_ADMIN_READ_WRITE_CAPABILITY', 'manage_options' );

	// hide other author's posts
	function posts_for_current_author( $query ) {
		global $pagenow;

		if ( 'edit.php' != $pagenow || ! $query->is_admin ) {
			return $query;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			global $user_ID;
			$query->set( 'author', $user_ID );
		}
		return $query;
	}
	add_filter( 'pre_get_posts', 'posts_for_current_author' );
}
