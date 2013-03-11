<?php
/**
 * Cargo Media functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, cargomedia_setup(), sets up the theme by registering support
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
 *     remove_filter( 'excerpt_length', 'cargomedia_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Cargo_Media
 * @since Cargo Media 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Tell WordPress to run cargomedia_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'cargomedia_setup' );

if ( ! function_exists( 'cargomedia_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override cargomedia_setup() in a child theme, add your own cargomedia_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
 * 	and backgrounds, and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header img provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Cargo Media 1.0
 */
function cargomedia_setup() {

	/* Make Cargo Media available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Cargo Media, use a find and replace
	 * to change 'cargomedia' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cargomedia', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Remove br filter
//	remove_filter('the_content', 'wpautop');

	function qanda($content) {

		$pattern = "/<p[^>]*><\\/p[^>]*>/";
		$content =  preg_replace($pattern, '', $content);
		return $content;
	}

	add_filter('the_content', 'qanda');

	wpautop( 'the_content', 0 );

	// This theme uses Featured img (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// Add support for custom headers.
	$custom_header_support = array(
		// The height and width of our custom header.
		'width' => apply_filters( 'cargomedia_header_image_width', 960 ),
		'height' => apply_filters( 'cargomedia_header_image_height', 300 ),
		// Support flexible heights.
		'flex-height' => true,
		// Random image rotation by default.
		'random-default' => true,
	);

	add_theme_support( 'custom-header', $custom_header_support );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'cargomedia' ) );

	set_post_thumbnail_size( 150, 150, true );

	// Add Cargo Media's custom image sizes.
	// Used for large feature (header) images.
	add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );
	// Used for featured posts if a large-feature doesn't exist.
	add_image_size( 'small-feature', 500, 300 );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'office1' => array(
			'url' => '%s/img/header/office1.jpg',
			'thumbnail_url' => '%s/img/header/thumbnail/office1.jpg',
			'description' => __( 'Office', 'cargomedia' )
		)
	) );
}
endif; // cargomedia_setup

/**
 * Sets the post excerpt length to 100 words.
 */
function cargomedia_excerpt_length( $length ) {
	return 60;
}
add_filter( 'excerpt_length', 'cargomedia_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 * Don't show
 */
function cargomedia_continue_reading_link() {
	return;
	return ' <p><a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'cargomedia' ) . '</a></p>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and cargomedia_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function cargomedia_auto_excerpt_more( $more ) {
	return ' &hellip;' . cargomedia_continue_reading_link();
}
add_filter( 'excerpt_more', 'cargomedia_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function cargomedia_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= cargomedia_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'cargomedia_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function cargomedia_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'cargomedia_page_menu_args' );

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Cargo Media 1.0
 * @return string|bool URL or false when no link is present.
 */
function cargomedia_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

if ( ! function_exists( 'cargomedia_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own cargomedia_posted_on to override in a child theme
 *
 * @since Cargo Media 1.0
 */
function cargomedia_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <a href="%5$s" title="%6$s" rel="author">%7$s</a>', 'cargomedia' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'cargomedia' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

function SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}

add_filter('pre_get_posts','SearchFilter');


