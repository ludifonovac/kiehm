<?php
/* Template Name: Anhängervermietung Template */
/**
 * The template for displaying Anhängervermietung page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kiehm
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main products-page">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'frontpage' );
			get_template_part( 'template-parts/content-product-list', 'rent' );
			get_template_part( 'template-parts/content-product', 'rent' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
