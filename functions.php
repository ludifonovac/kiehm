<?php
/**
 * Kiehm functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kiehm
 */

if ( ! function_exists( 'kiehm_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kiehm_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Kiehm, use a find and replace
		 * to change 'kiehm' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'kiehm', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'kiehm' ),
		) );
		register_nav_menus( array(
			'menu-2' => esc_html__( 'Footer menu', 'kiehm' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'kiehm_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'kiehm_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kiehm_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'kiehm_content_width', 640 );
}
add_action( 'after_setup_theme', 'kiehm_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kiehm_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'kiehm' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'kiehm' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'kiehm_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kiehm_scripts() {
	wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css');
	
	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/bootstrap.min.css');
	
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

	wp_enqueue_style( 'kiehm-style', get_stylesheet_uri() );

	wp_enqueue_script( 'kiehm-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'kiehm-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'custom_js', get_template_directory_uri() . '/js/scripts.js');
	
	wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');

	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kiehm_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function kiehm_add_section($wp_customize) {
   $wp_customize->add_section('kiehm_custom_elements', array(
   	'title' => __('Custom elements','kiehm'),
   	'priority' => 30,
   ));
   $wp_customize->add_setting( 'kiehm_location' , array(
		'transport' => 'refresh',
		'default'   => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1243.208110563162!2d7.394742556525569!3d51.45051412268265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b91e41b5624827%3A0xb6b4efd165fa4d3f!2sKiehm+Anh%C3%A4ngervermietung!5e0!3m2!1sen!2srs!4v1524956906998" width="400" height="270" frameborder="0" style="border:0" allowfullscreen></iframe>',
    ) );
   $wp_customize->add_setting( 'kiehm_address' , array(
		'default'   => 'Friedrich-Ebert-Str. 92<br/>58454 Witten',
        'transport' => 'refresh',
    ) );
	$wp_customize->add_setting( 'kiehm_phone' , array(
        'default'   => '+49 (0) 23 02 / 69 00 00',
        'transport' => 'refresh',
    ) );
	$wp_customize->add_setting( 'kiehm_fax' , array(
        'default'   => '+49 (0) 23 02 / 67 46',
        'transport' => 'refresh',
    ) );
	$wp_customize->add_setting( 'kiehm_email' , array(
        'default'   => 'info@kiehm.de',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( 'location_control', array(
        'label'    => __( 'Location iframe', 'kiehm' ),
        'description' => __( 'Insert Google Maps embedded code.' ),
        'type'     => 'textarea',
        'section'  => 'kiehm_custom_elements',
        'settings' => 'kiehm_location',
    ) );
    $wp_customize->add_control( 'address_control', array(
        'label'    => __( 'Address', 'kiehm' ),
        'type'     => 'textarea',
        'section'  => 'kiehm_custom_elements',
        'settings' => 'kiehm_address',
    ) );
    $wp_customize->add_control( 'phone_control', array(
        'label'    => __( 'Telephone', 'kiehm' ),
        'section'  => 'kiehm_custom_elements',
        'settings' => 'kiehm_phone',
    ) );
    $wp_customize->add_control( 'fax_control', array(
        'label'    => __( 'Fax', 'kiehm' ),
        'section'  => 'kiehm_custom_elements',
        'settings' => 'kiehm_fax',
    ) );
    $wp_customize->add_control( 'email_control', array(
        'label'    => __( 'E-mail', 'kiehm' ),
        'section'  => 'kiehm_custom_elements',
        'settings' => 'kiehm_email',
    ) );
}
add_action( 'customize_register', 'kiehm_add_section' );

function phone_clean($phone) {
	$newphone = str_replace(' ', '', $phone);
	$newphone = str_replace('(0)', '', $newphone);
	$newphone = str_replace('/', '', $newphone);
	return $newphone;
}
add_action('init', 'phone_clean');

function kiehm_jobs() {
  register_post_type( 'jobs',
    array(
		'labels' => array(
			'name' => __( 'Jobs' ),
			'singular_name' => __( 'Job' )
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'jobs'),
		'revisions' => true,
		'supports' => array('title', 'editor', 'thumbnail')
    )
  );
}
add_action( 'init', 'kiehm_jobs' );

function kiehm_partners() {
  register_post_type( 'partners',
    array(
		'labels' => array(
			'name' => __( 'Partners' ),
			'singular_name' => __( 'Partner' )
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'partner'),
		'revisions' => true,
		'supports' => array('title', 'thumbnail')
    )
  );
}
add_action( 'init', 'kiehm_partners' );

function kiehm_products_rent() {
  register_post_type( 'products_rent',
	array(
		'labels' => array(
			'name' => __( 'Products for rent' ),
			'singular_name' => __( 'Product for rent' )
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'product-rent'),
		'revisions' => true,
		'hierarchical' => false,
		'supports' => array('title', 'thumbnail', 'revisions', 'page-attributes')
	)
  );
}
add_action( 'init', 'kiehm_products_rent' );

function kiehm_products_sale() {
  register_post_type( 'products_sale',
    array(
      'labels' => array(
        'name' => __( 'Products for sale' ),
        'singular_name' => __( 'Product for sale' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'product-sale'),
      'revisions' => true,
      'hierarchical' => false,
	  'supports' => array('title', 'thumbnail', 'revisions', 'page-attributes')
	)
  );
}
add_action( 'init', 'kiehm_products_sale' );

/* Add categories to products */
function products_category() {
	register_taxonomy(
		'products_category',
		array('products_rent', 'products_sale'),
		array(
			'label' => __( 'Products Categories' ),
			'rewrite' => array( 'slug' => 'products_category' ),
			'hierarchical' => 'true'
		)
	);
}
add_action( 'init', 'products_category' );

function url_clean($url) {
	$newurl = str_replace('http://', '', $url);
	$newurl = str_replace('https://', '', $newurl);
	return $newurl;
}
add_action('init', 'url_clean');
