<?php
/* Bones Custom Post Type Example
This page walks you through creating
a custom post type and taxonomies. You
can edit this one or copy the following code
to create another one.

I put this in a separate file so as to
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {

	$labels = array(
		"name" => __( 'Specialists', '' ),
		"singular_name" => __( 'Specialist', '' ),
		);

	$args = array(
		"label" => __( 'Specialists', '' ),
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
		"rewrite" => array( "slug" => "specialists", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "thumbnail" ),
        "menu_icon" => 'dashicons-video-alt',
	);
	register_post_type( "specialists", $args );

}

?>
