add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name" => __( 'Employees', '' ),
		"singular_name" => __( 'Employee', '' ),
		);

	$args = array(
		"label" => __( 'Employees', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "employees", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-universal-access",
		"supports" => array( "title", "custom-fields" ),
	);
	register_post_type( "employees", $args );

	$labels = array(
		"name" => __( 'Companies', '' ),
		"singular_name" => __( 'Company', '' ),
		);

	$args = array(
		"label" => __( 'Companies', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => true,
		"query_var" => true,

		"supports" => array( "title", "custom-fields", "thumbnail" ),
	);
	register_post_type( "companies", $args );

	$labels = array(
		"name" => __( 'Specialities', '' ),
		"singular_name" => __( 'Speciality', '' ),
		);

	$args = array(
		"label" => __( 'Specialities', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "specialities", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "custom-fields", "thumbnail" ),
	);
	register_post_type( "specialities", $args );

	$labels = array(
		"name" => __( 'Group News', '' ),
		"singular_name" => __( 'News', '' ),
		);

	$args = array(
		"label" => __( 'Group News', '' ),
		"labels" => $labels,
		"description" => "Perspective Group News",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => true,
		"query_var" => true,

		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "thumbnail", "author", "page-attributes" ),
	);
	register_post_type( "group-news", $args );

	$labels = array(
		"name" => __( 'Pulses', '' ),
		"singular_name" => __( 'Pulse', '' ),
		);

	$args = array(
		"label" => __( 'Pulses', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "pulse", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-heart",
	);
	register_post_type( "pulse", $args );

// End of cptui_register_my_cpts()
}
