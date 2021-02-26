<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpAcademy
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
	<?php 
	if ( is_active_sidebar('footer-sidebar') ) {
	?>	<div class="footer-sidebar"> <?php dynamic_sidebar('footer-sidebar'); ?>
	</div><!-- #footer-sidebar --><?php } ?>

	<div class="site-info">
	<h4><?php echo get_theme_mod( 'footer_text' , 'Hsoub Academy © |  All Rights Reserved'); ?></h4>  
	</div><!-- .site-info -->
	<?php
	if ( has_nav_menu( 'menu-2' ) ) {
	wp_nav_menu( array(
		'theme_location' => 'menu-2',
		'menu_id'        => 'social-menu',
		'container'		 => 'nav',
		'container_class' => 'social',
		'link_before' => '<span class="usr_txt">',
		'link_after' => '</span>',
	) );
	}
    ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
