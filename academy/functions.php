<?php
/**
 * wpAcademy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wpAcademy
 */

if ( ! function_exists( 'academy_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function academy_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wpAcademy, use a find and replace
		 * to change 'academy' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'academy', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'academy' ),
		) );
		register_nav_menus( array(
			'menu-2' => esc_html__( 'Social', 'academy' ),
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
		add_theme_support( 'custom-background', apply_filters( 'academy_custom_background_args', array(
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
add_action( 'after_setup_theme', 'academy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function academy_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'academy_content_width', 640 );
}
add_action( 'after_setup_theme', 'academy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function academy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'academy' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'academy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar(array(
		'name'		    => esc_html__("Footer Area", "academy"),
		'id'            => 'footer-sidebar',
		'description'   => esc_html__('Add widgets here.','academy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'academy_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function academy_scripts() {
	wp_enqueue_style('academy-fonts', 'https://fonts.googleapis.com/css?family=Cairo:400,700&display=swap&subset=arabic');

	wp_enqueue_style('font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

	wp_enqueue_style( 'academy-style', get_stylesheet_uri() );

	wp_enqueue_script( 'academy-navigation', get_template_directory_uri() . '/js/academy_nav.js', array('jquery'), true );

	wp_enqueue_script( 'academy-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'academy_scripts' );


/**
 * Add preconnect for Google Fonts.
 */
function academy_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'academy-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);}
	if ( wp_style_is( 'academy_icons', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://stackpath.bootstrapcdn.com',
			'crossorigin',
		);}	
	return $urls;
	}
	add_filter( 'wp_resource_hints', 'academy_resource_hints', 1, 2 );

/* disply theme information on admin dashboard */
function academy_info() {
	$current_user = wp_get_current_user();
	echo  '<ul style="background-color:#def5ff; font-size:1rem; border:0.4rem dashed #f2f2f2; text-align: center; font-weight:bold;">
	<li>'.__('User Name: ','academy').$current_user->user_login.'</li>
	<li>'.__('Blog Name: ','academy'). get_bloginfo( 'name' ).'</li>
	<li>'.__('Theme Folder: ','academy').get_bloginfo( 'stylesheet_directory' ).'</li>
	<li>'.__('Language: ','academy').get_bloginfo( 'language' ).'</li>
	<li>'.__('RTL Status: ','academy').(is_rtl()==1 ? 'true' : 'false').'</li>
	</ul>';
	}
	function academy_addto_dashboard() {
		wp_add_dashboard_widget('admin_dashboard_widget', __('Site Information','academy'), 'academy_info');
	}
	add_action('wp_dashboard_setup', 'academy_addto_dashboard', 1 ); 

	
/* changing login page logo */
function academy_login_logo() {	
	$admin_logo_url = get_option('admin_logo_url');
	?>
		<style type="text/css">
				#login h1 a, .login h1 a {
					background-image: url(
					<?php echo 	$admin_logo_url;?>
					)}
		</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'academy_login_logo' );

/* changing admin bar logo */
function academy_admin_bar_logo() { ?>
	<style type="text/css">
		#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
		background-image: url(<?php echo get_stylesheet_directory_uri() ; ?>/images/logo2.png);
		background-position: center;
		background-repeat: no-repeat;
		color:rgba(0, 0, 0, 0);
		}
	</style>
	<?php } 
	add_action('wp_before_admin_bar_render', 'academy_admin_bar_logo');

/* changing dashboard footer */
function academy_change_footer () {
	$copyright = get_option( 'copyright', 'default_value' );
	$author = get_option( 'author', 'default_value' );
	$authorurl = get_option( 'authorurl', 'default_value' );
	echo '<span class="description">'.__($copyright,"academy").
	'<a href="'.__($authorurl).' "> '.__($author,"academy").'</a></span>';					 
}
// Admin panel footer
add_filter( 'admin_footer_text', 'academy_change_footer' );
	
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

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load academy widget.
 */
require get_template_directory() . '/academy_widget.php';

/**
 * Load academy dashboard files.
 */
require get_template_directory() . '/dashboard.php';
require get_template_directory() . '/info.php';