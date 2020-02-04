<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kiehm
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-inside-div">
			<div class="location">
				<h2>Lage</h2>
				<?php echo get_theme_mod('kiehm_location'); ?>
			</div>
			<div class="site-info">
				<?php the_custom_logo(); ?>
				<p class="address"><?php echo nl2br(get_theme_mod('kiehm_address')); ?></p>
				<p class="phone">Tel.:  <a href="tel:<?php echo phone_clean(get_theme_mod('kiehm_phone')); ?>"><?php echo get_theme_mod('kiehm_phone'); ?></a><br/>Fax.:  <a href="tel:<?php echo phone_clean(get_theme_mod('kiehm_fax')); ?>"><?php echo get_theme_mod('kiehm_fax') ?></a></p>
				<p class="email"><a href="mailto:<?php echo get_theme_mod('kiehm_email'); ?>"><?php echo get_theme_mod('kiehm_email'); ?></a></p>
				<p class="website"><a href="www.kiehm.de">www.kiehm.de</a></p>
			</div>
			<div class="footer-links">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'footer-menu',
					'container_class'=> 'menu-footer-menu-container',
				) );
			?>	
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
