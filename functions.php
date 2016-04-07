<?php
/**
 * Twenty Eleven functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyeleven_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'twentyeleven_setup' );

if ( ! function_exists( 'twentyeleven_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_setup() {

	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'twentyeleven' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyeleven', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Load up our theme options page and related code.
	require( dirname( __FILE__ ) . '/inc/theme-options.php' );

	// Grab Twenty Eleven's Ephemera widget.
	require( dirname( __FILE__ ) . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'html5', array( 'search-form' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus ( 
    array (
        'main-nav' => __( 'The Main Menu', 'perspectivehub' ),   // main nav in header
        'home-portal' => __ ( 'Home Portal' ) // Home page portal
    )
  );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// Add support for custom backgrounds
	add_custom_background();

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// The next four constants set how Twenty Eleven supports custom headers.

	// The default header text color
	define( 'HEADER_TEXTCOLOR', '000' );

	// By leaving empty, we allow for random image rotation.
	define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header.
	// Add a filter to twentyeleven_header_image_width and twentyeleven_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyeleven_header_image_width', 1000 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyeleven_header_image_height', 288 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Add Twenty Eleven's custom image sizes
	add_image_size( 'large-feature', HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true ); // Used for large feature (header) images
	add_image_size( 'small-feature', 500, 300 ); // Used for featured posts if a large-feature doesn't exist

	// Turn on random header image rotation by default.
	add_theme_support( 'custom-header', array( 'random-default' => true ) );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyeleven_admin_header_style(), below.
	add_custom_image_header( 'twentyeleven_header_style', 'twentyeleven_admin_header_style', 'twentyeleven_admin_header_image' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'wheel' => array(
			'url' => '%s/images/headers/wheel.jpg',
			'thumbnail_url' => '%s/images/headers/wheel-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Wheel', 'twentyeleven' )
		),
		'shore' => array(
			'url' => '%s/images/headers/shore.jpg',
			'thumbnail_url' => '%s/images/headers/shore-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Shore', 'twentyeleven' )
		),
		'trolley' => array(
			'url' => '%s/images/headers/trolley.jpg',
			'thumbnail_url' => '%s/images/headers/trolley-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Trolley', 'twentyeleven' )
		),
		'pine-cone' => array(
			'url' => '%s/images/headers/pine-cone.jpg',
			'thumbnail_url' => '%s/images/headers/pine-cone-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Pine Cone', 'twentyeleven' )
		),
		'chessboard' => array(
			'url' => '%s/images/headers/chessboard.jpg',
			'thumbnail_url' => '%s/images/headers/chessboard-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Chessboard', 'twentyeleven' )
		),
		'lanterns' => array(
			'url' => '%s/images/headers/lanterns.jpg',
			'thumbnail_url' => '%s/images/headers/lanterns-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Lanterns', 'twentyeleven' )
		),
		'willow' => array(
			'url' => '%s/images/headers/willow.jpg',
			'thumbnail_url' => '%s/images/headers/willow-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Willow', 'twentyeleven' )
		),
		'hanoi' => array(
			'url' => '%s/images/headers/hanoi.jpg',
			'thumbnail_url' => '%s/images/headers/hanoi-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Hanoi Plant', 'twentyeleven' )
		)
	) );
}
endif; // twentyeleven_setup

if ( ! function_exists( 'twentyeleven_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // twentyeleven_header_style

if ( ! function_exists( 'twentyeleven_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 1000px;
		height: auto;
		width: 100%;
	}
	</style>
<?php
}
endif; // twentyeleven_admin_header_style

if ( ! function_exists( 'twentyeleven_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // twentyeleven_admin_header_image

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function twentyeleven_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function twentyeleven_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function twentyeleven_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyeleven_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function twentyeleven_custom_excerpt_more( $output ) {
    if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyeleven_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function twentyeleven_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyeleven_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_widgets_init() {

	register_widget( 'Twenty_Eleven_Ephemera_Widget' );
	
	register_sidebar( array(
	    'name' => __( 'Header', 'twentyeleven' ),
	    'id' => 'header-widgets',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2 class="widgettitle">',
	    'after_title' => '</h2>'
	) );
	
	
	/*register_sidebar( array(
	    'name' => __( 'Homepage Mosaic', 'twentyeleven' ),
	    'id' => 'home-mosaic',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2 class="widgettitle">',
	    'after_title' => '</h2>'
	) );*/
	
	register_sidebar( array(
	    'name' => __( 'Homepage News Box', 'twentyeleven' ),
	    'id' => 'home-widgets',
	    'description' => __( 'Homepage RSS news area', 'twentyeleven' ),
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2 class="widgettitle">',
	    'after_title' => '</h2>'
	) );

	register_sidebar( array(
		'name' => __( 'Blog Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-1',
		'description' => __( 'Sidebar only for blog pages', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Calendar Page', 'twentyeleven' ),
		'id' => 'calendar-widget',
		'description' => __( 'Main calendar page space', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'World news', 'twentyeleven' ),
		'id' => 'rss-page',
		'description' => __( 'World news RSS page space', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="world_news widget rsspageblock %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
	    'name' => __( 'Industry news', 'twentyeleven' ),
	    'id' => 'rss-page-industry',
	    'description' => __( 'Industry news RSS page space', 'twentyeleven' ),
	    'before_widget' => '<aside id="%1$s" class="world_news widget rsspageblock %2$s">',
	    'after_widget' => "</aside>",
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	    ) );
	
	register_sidebar( array(
		'name' => __( 'General Interests RSS', 'twentyeleven' ),
		'id' => 'general-rss-page',
		'description' => __( 'General RSS news page', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget rsspageblock %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


	register_sidebar( array(
		'name' => __( 'Footer', 'twentyeleven' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Menu', 'twentyeleven' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'All pages', 'twentyeleven' ),
		'id' => 'all-pages',
		'description' => __( 'An optional widget area for all pages across the website', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	/*register_sidebar( array(
		'name' => __( 'Footer Area Three', 'twentyeleven' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	*/
}
add_action( 'widgets_init', 'twentyeleven_widgets_init' );

/**
 * Display navigation to next/previous pages when applicable
 */
function twentyeleven_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function twentyeleven_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function twentyeleven_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . ' cf"';
}

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'twentyeleven' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_body_classes( $classes ) {

	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}

add_filter( 'body_class', 'twentyeleven_body_classes' );


/* Optimise Internet (C) custom functions */


function translate_labels($str='')
{
    $str_srch = array(
	'cmp_address',
	'cmp_postcode',
	'cmp_phone',
	'cmp_email',
	'cmp_website',
	'emp_company',
	'emp_position',
	'emp_description',
	'emp_firstname',
	'emp_lastname',
	'emp_email',
	'emp_mobile',
    );
    $str_rplc = array(
	'Address',
	'Postcode',
	'Phone',
	'Main Email',
	'Website',
	'Company Name',
	'Position',
	'Description',	
	'Firstname',
	'Lastname',
	'Email',
	'Mobile',
	
    );
    $str=str_replace($str_srch,$str_rplc,$str);
    return($str);
}




function my_connection_types() {
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'id' => 'employees_to_companies',
		'from' => 'employees',
		'to' => 'companies'
	) );
	
	p2p_register_connection_type( array(
		'id' => 'employees_to_specialities',
		'from' => 'employees',
		'to' => 'specialities'
	) );
	
	p2p_register_connection_type( array(
		'id' => 'companies_to_specialities',
		'from' => 'companies',
		'to' => 'specialities'
	) );
}

add_action( 'init', 'my_connection_types', 100 );

/* JS queue */

function load_jsfiles() {
    wp_register_script( 'colors', get_template_directory_uri().'/js/color.js');
    //wp_enqueue_script( 'colors' );
    
    wp_register_script( 'innerfader', get_template_directory_uri().'/js/jquery.innerfade.js');
    wp_enqueue_script( 'innerfader' );
    
    wp_register_script( 'customfuncs', get_template_directory_uri().'/js/custom.js');
    wp_enqueue_script( 'customfuncs' );
}    

add_action('wp_enqueue_scripts', 'load_jsfiles');

/* Define thumbnails for homepage stories */
add_image_size( 'hpos-1', 573, 344, true );
add_image_size( 'hpos-2', 151, 179, true );
add_image_size( 'hpos-3', 254, 179, true );
add_image_size( 'hpos-4', 247, 165, true );
add_image_size( 'hpos-5', 158, 165, true );
add_image_size( 'hpos-6', 348, 275, true );
add_image_size( 'hpos-7', 222, 275, true );
add_image_size( 'companies-logos', 220, 100, true );
add_image_size( 'subpages-thumbs', 230, 120, true );

/* Custom "Walker" class (homepage menu) */
class Thumbnail_Walker extends Walker_Nav_Menu {
 /**
 * Start the element output.
 *
 * @param  string $output Passed by reference. Used to append additional content.
 * @param  object $item   Menu item data object.
 * @param  int $depth     Depth of menu item. May be used for padding.
 * @param  array $args    Additional strings.
 * @return void
 */
 function start_el(&$output, $item, $depth, $args)
 {
     global $menu_custom_counter;
     $menu_custom_counter++;
     
    $classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

    $class_names = join(
        ' '
    ,   apply_filters(
            'nav_menu_css_class'
        ,   array_filter( $classes ), $item
        )
    );

    ! empty ( $class_names )
    and $class_names = ' class="pos_'.$menu_custom_counter.' '. esc_attr( $class_names ) . '"';

    $output .= "<li id='menu-item-$item->ID' $class_names>";

    $attributes  = '';

    ! empty( $item->attr_title )
        and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
    ! empty( $item->target )
        and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
    ! empty( $item->xfn )
        and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
    ! empty( $item->url )
        and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

    $thumbnail = '';
    if( $id = has_post_thumbnail( (int)$item->object_id ) ) {
	$thumbnail = get_the_post_thumbnail( $item->object_id, 'hpos-'.(int)$menu_custom_counter );
    }

    $title = apply_filters( 'the_title', $item->title, $item->ID );

    $item_output = $args->before
        . "<a $attributes>"
        . $args->link_before
        . $title
        . '</a> '
        . $args->link_after
        . '<a class="homeBox" '.$attributes.'>'.$thumbnail.'</a>'
        . $args->after;

	
    $output .= apply_filters(
        'walker_nav_menu_start_el'
    ,   $item_output
    ,   $item
    ,   $depth
    ,   $args
    );
   }
}

// Alphabetical order list
function alphabetical_order_list($loop,$list_type)
{
    $elements=array();
    $xhtml='';
    switch($list_type)
    {
	case 'group-news':
	{
	    $incrementor=0;
	    $xhtml .= '<ul class="group-news-list">
	    ';
	    while ( $loop->have_posts() ) : $loop->the_post();
		$css_clases = 'pos_'.($incrementor+1).' mod_2_'.($incrementor%2).' mod_3_'.($incrementor%3).' mod_4_'.($incrementor%4);
		$xhtml .= '<li class="'.$css_clases.' cf">
		    <p class="date gradient"><span class="day">'.get_the_date('d').'</span><span class="month">'.get_the_date('M').'</span></p>
		    <div class="content">
			<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>
			<p class="short_desc">'.get_the_excerpt().'</p>
		    </div>
		</li>
		';
		$incrementor++;
	    endwhile;
	    $xhtml .= '</ul>';
	    break;
	}
	case 'specialities':
	{
	    $incrementor=0;
	    while ( $loop->have_posts() ) : $loop->the_post();
		$speciality=get_the_title();
		$elements[strtoupper(substr($speciality,0,1))][$speciality][$speciality]=array(
			'speciality' => $speciality,
			'description' => get_post_meta(get_the_id(),'spc_description', true),
			'permalink' => get_permalink(),
		);
		$incrementor++;
	    endwhile;
	    
	    $letters=range('A','Z');
	    $xhtml .= '<ul class="alphaIndex rounded">
	    ';
	    foreach($letters as $letter)
	    {
		$xhtml .= '<li class="letter">'.(array_key_exists($letter,$elements)?'<a href="#index_'.strtolower($letter).'">':'').$letter.(array_key_exists($letter,$elements)?'</a>':'').'</a></li>';
	    }
	    $xhtml .= '</ul>
	    ';
	    
	    ksort($elements);	// sort the elements
	    if(is_array($elements) && !empty($elements))
	    {
		$xhtml .= '<ul class="letter_index">';
		foreach($elements as $first_letter => $el)
		{
		    $xhtml .= '<li class="letter_title" id="index_'.strtolower($first_letter).'"><h3 class="gradient rounded">'.strtoupper($first_letter).'</h3>
		    ';
		    if(is_array($el) && !empty($el))
		    {
			$xhtml .= '<ul class="employees_list">';
			$elem_counter=1;
			ksort($el);
			foreach($el as $fullname => $details)
			{
			    ksort($details);
			    foreach($details as $det)
			    {
				/*
				 <span class="position">'.$det['address'].'</span>
				 < span class="email"><a href="mailto:'.$det['*email'].'?subject=The HUB Directory Contact">'.$det['email'].'</a></span>
				 <span class="phone">'.$det['phone'].'</span>
				 */
				$mod_classes = 'mod_2_'.($elem_counter%2).' mod_3_'.($elem_counter%3).' mod_4_'.($elem_counter%4).' mod_5_'.($elem_counter%5);
				$xhtml .= '<li class="rounded '.$mod_classes.' gradient_gray shadow">
				    <span class="fullname"><a href="'.$det['permalink'].'">'.$det['speciality'].'</a></span>
				</li>';
				$elem_counter++;
			    }
			}
			$xhtml .= '</ul>';
		    }
		    $xhtml .= '</li>';
		    
		}
		$xhtml .= '</ul>';
	    }
	    break;
	}
	case 'companies':
	{
	    $incrementor=0;
	    while ( $loop->have_posts() ) : $loop->the_post();
		//$company=get_post_meta(get_the_id(),'emp_company', true);
		$company=get_the_title();
		$elements[strtoupper(substr($company,0,1))][$company][$company]=array(
			'company' => get_post_meta(get_the_id(),'emp_company', true),
			'address' => get_post_meta(get_the_id(),'cmp_address', true),
			'address' => get_post_meta(get_the_id(),'cmp_address', true),
			'postcode' => get_post_meta(get_the_id(),'cmp_postcode', true),
			'phone' => get_post_meta(get_the_id(),'cmp_phone', true),
			'mobile' => get_post_meta(get_the_id(),'cmp_mobile', true),
			'email' => get_post_meta(get_the_id(),'cmp_email', true),
			'website' => get_post_meta(get_the_id(),'cmp_website', true),
			'permalink' => get_permalink(),
		);
		$incrementor++;
	    endwhile;
	    
	    $letters=range('A','Z');
	    $xhtml .= '<ul class="alphaIndex rounded">
	    ';
	    foreach($letters as $letter)
	    {
		$xhtml .= '<li class="letter">'.(array_key_exists($letter,$elements)?'<a href="#index_'.strtolower($letter).'">':'').$letter.(array_key_exists($letter,$elements)?'</a>':'').'</a></li>';
	    }
	    $xhtml .= '</ul>
	    ';
	    ksort($elements);	// sort the elements
	    if(is_array($elements) && !empty($elements))
	    {
		$xhtml .= '<ul class="letter_index">';
		foreach($elements as $first_letter => $el)
		{
		    $xhtml .= '<li class="letter_title" id="index_'.strtolower($first_letter).'"><h3 class="gradient rounded">'.strtoupper($first_letter).'</h3>
		    ';
		    if(is_array($el) && !empty($el))
		    {
			$xhtml .= '<ul class="employees_list">';
			$elem_counter=1;
			ksort($el);
			foreach($el as $fullname => $details)
			{
			    ksort($details);
			    foreach($details as $det)
			    {
				$mod_classes = 'mod_2_'.($elem_counter%2).' mod_3_'.($elem_counter%3).' mod_4_'.($elem_counter%4).' mod_5_'.($elem_counter%5);
				$xhtml .= '<li class="rounded '.$mod_classes.' gradient_gray shadow">
				    <span class="fullname"><a href="'.$det['permalink'].'">'.$det['company'].'</a></span>
				    <span class="position">'.$det['address'].'</span>
				    <span class="email"><a href="mailto:'.$det['email'].'?subject=The HUB Directory Contact">'.$det['email'].'</a></span>
				    <span class="phone">'.$det['phone'].'</span>
				</li>';
				$elem_counter++;
			    }
			}
			$xhtml .= '</ul>';
		    }
		    $xhtml .= '</li>';
		    
		}
		$xhtml .= '</ul>';
	    }
	    break;
	}
	case 'employees':
	{
	    // organize the elements
	    $incrementor=0;
	    while ( $loop->have_posts() ) : $loop->the_post();
		$lastname=get_post_meta(get_the_id(),'emp_lastname', true);
		$firstname=get_post_meta(get_the_id(),'emp_firstname', true);
		$elements[strtoupper(substr($lastname,0,1))][$lastname.', '.$firstname][$lastname.', '.$firstname.$incrementor]=array(
			'firstname' => get_post_meta(get_the_id(),'emp_firstname', true),
			'lastname' => get_post_meta(get_the_id(),'emp_lastname', true),
			'email' => get_post_meta(get_the_id(),'emp_email', true),
			'mobile' => get_post_meta(get_the_id(),'emp_mobile', true),
			'position' => get_post_meta(get_the_id(),'emp_position', true),
			'permalink' => get_permalink(),
			'company' => get_companies_list(get_the_id()),
		);
		$incrementor++;
	    endwhile;
	    // alphabetical index
	    $letters=range('A','Z');
	    $xhtml .= '<ul class="alphaIndex rounded">
	    ';
	    foreach($letters as $letter)
	    {
		$xhtml .= '<li class="letter">'.(array_key_exists($letter,$elements)?'<a href="#index_'.strtolower($letter).'">':'').$letter.(array_key_exists($letter,$elements)?'</a>':'').'</a></li>';
	    }
	    $xhtml .= '</ul>
	    ';
	    ksort($elements);	// sort the elements
	    if(is_array($elements) && !empty($elements))
	    {
		$xhtml .= '<ul class="letter_index">';
		foreach($elements as $first_letter => $el)
		{
		    $xhtml .= '<li class="letter_title" id="index_'.strtolower($first_letter).'"><h3 class="gradient rounded">'.strtoupper($first_letter).'</h3>
		    ';
		    if(is_array($el) && !empty($el))
		    {
			$xhtml .= '<ul class="employees_list">';
			$elem_counter=1;
			ksort($el);
			foreach($el as $fullname => $details)
			{
			    ksort($details);
			    foreach($details as $det)
			    {
				$mod_classes = 'mod_2_'.($elem_counter%2).' mod_3_'.($elem_counter%3).' mod_4_'.($elem_counter%4).' mod_5_'.($elem_counter%5);
				$xhtml .= '<li class="rounded '.$mod_classes.' gradient_gray shadow">
				    <span class="fullname"><a href="'.$det['permalink'].'">'.$det['lastname'].', '.$det['firstname'].'</a></span>
				    <span class="position">'.$det['position'].'</span>
				    <span class="email"><a href="mailto:'.$det['email'].'?subject=The HUB Directory Contact">'.$det['email'].'</a></span>
				    <span class="mobile">'.$det['mobile'].'</span>
				    '.((is_array($det['company'])&&!empty($det['company'])?'<span class="company">'.join(', ',$det['company']).'</span>':'')).'
				    
				</li>';
				$elem_counter++;
			    }
			}
			$xhtml .= '</ul>';
		    }
		    $xhtml .= '</li>';
		}
		$xhtml .= '</ul>';
	    }
	    break;
	}
	
	default:
	{
	    // organize the elements
	    while ( $loop->have_posts() ) : $loop->the_post();
		
	    endwhile;
	    
	    break;
	}
    }
    return($xhtml);

}

// List all companies function
function get_companies_list($id)
{
    $companies=array();
    if($connected = p2p_type( 'employees_to_companies' )->get_connected( $id )):
	if ( $connected->have_posts() ) :
	    while ( $connected->have_posts() ) : $connected->the_post();
		$companies[]='<a href="'.get_permalink().'">'.get_the_title().'</a>';
	    endwhile;
	endif;
	wp_reset_postdata();
    endif;
    asort($companies);
    return($companies);
}

// Something to do with
function display_auxbox_title($type, $reltype, $h='h2')
{  
    $title='';
    $xhtml='';
    switch($reltype)
    {
	case 'emp-comp':
	{
	    if($type=='employees')
	    {
		$title='Related Companies';
	    }
	    if($type=='companies')
	    {
		$title='People Working Here';
	    }
	    break;
	}
	case 'emp-spec':
	{
	    if($type=='employees')
	    {
		$title='Related Specialities';
	    }
	    if($type=='specialities')
	    {
		$title='People With This Speciality';
	    }
	    break;
	}
	case 'comp-spec':
	{
	    if($type=='companies')
	    {
		$title='Related Specialities';
	    }
	    if($type=='specialities')
	    {
		$title='Companies Offering This Service';
	    }
	    break;
	}
	
    }
    
    $xhtml = '<'.$h.'>'.$title.'</'.$h.'>';
    return($xhtml);
    
}

// Who knows?
function pre($arr,$type='arr')
{
    echo '<pre>';
    switch($type)
    {
	case 'obj':
	{
	    var_dump($arr);
	    break;
	}
	default:
	{
	    print_r($arr);
	    break;
	}
    }
    echo '</pre>';
}

// Hub Logo
function hub_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/thehub-logo.jpg);
            height:93px;
            webkit-background-size: inherit;
            background-size: inherit;
            width:320px;
        }
        .login h1 a
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'hub_logo' );

function google_fonts() {

}

add_action('wp_print_styles', 'google_fonts');

/**
 * Proper way to enqueue scripts and styles
 */
function hub_scripts() {

    global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    wp_register_style('google-fonts', 'http://fonts.googleapis.com/css?family=Racing+Sans+One');
    wp_register_style( 'hub-stylesheet', get_stylesheet_directory_uri() . '/style.min.css', array(), '', 'all' );
    wp_register_style( 'hub-ie-only', get_stylesheet_directory_uri() . '/ie.css', array(), '' );

    wp_enqueue_style( 'google-fonts');
	wp_enqueue_style( 'hub-stylesheet', get_stylesheet_uri() );
    wp_enqueue_style( 'hub-ie-only' );

    //wp_enqueue_script( 'jquery' );

	   $wp_styles->add_data( 'hub-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

}

add_action( 'wp_enqueue_scripts', 'hub_scripts' );
