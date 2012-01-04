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

// Add missionaries custom role
$author_role = get_role('author');
 
	// get_role returns an object; we want the capabilities piece, which is an array.
	$missionary_caps = $author_role->capabilities;
	 
	// Remove the stuff we don't want in the new role.
	unset($missionary_caps['edit_missionary_info']);
	unset($missionary_caps['edit_missionary_infos']);
	unset($missionary_caps['edit_others_missionary_infos']);
	unset($missionary_caps['publish_missionary_infos']);
	unset($missionary_caps['read_missionary_infos']);
	unset($missionary_caps['delete_missionary_infos']);
	 
	// Add the new role.
	add_role('missionary', 'Missionary', $missionary_caps);

// Add custom post capabilities
$administrator_role = get_role('administrator');
	$administrator_role->add_cap( 'edit_others_missionary_infos' );
	$administrator_role->add_cap( 'edit_missionary_info' );
	$administrator_role->add_cap( 'edit_missionary_infos' );
	$administrator_role->add_cap( 'edit_others_missionary_infos' );
	$administrator_role->add_cap( 'publish_missionary_infos' );
	$administrator_role->add_cap( 'read_missionary_infos' );
	$administrator_role->add_cap( 'delete_missionary_infos' );


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

// create custom post type
add_action( 'init', 'create_post_type' );
add_action( 'admin_head', 'wwntbm_custom_post_icons' );

?>