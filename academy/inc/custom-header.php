<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package wpAcademy
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses academy_header_style()
 */
function academy_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'academy_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'academy_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'academy_custom_header_setup' );

if ( ! function_exists( 'academy_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see academy_custom_header_setup().
	 */
	function academy_header_style() {
		$header_text_color = get_header_textcolor();
		$header_links_color = get_theme_mod('header_links_color' ,'#ffffff');
		$content_links_color = get_theme_mod('content_links_color' ,'#616571');
		$header_bg_color= get_theme_mod('header_bg_color','#616571');
		$footer_bg_color= get_theme_mod('footer_bg_color','#616571');
		?>

		<style type="text/css">
			.site-header a {
				color:<?php echo esc_attr($header_links_color);?> ;
            }
			.content-area a, .widget-area a,.post span a,.widget li a{
				color:<?php echo esc_attr($content_links_color);?> ;
            }
            .site-header, .main-navigation ul ,.main-navigation li ,.main-navigation a,
            .menu-bar ul,.menu-bar ul li ,.menu-bar li , .menu-bar a   {
       			background-color:<?php echo esc_attr($header_bg_color);?> ;
    		}
    		.site-footer {
				background-color:<?php echo esc_attr($footer_bg_color);?> ;
			}
		</style>
		
		<?php
		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
		// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
