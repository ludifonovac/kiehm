<?php
/**
 * Template part for displaying news in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kiehm
 */

?>
<div class="homepage-news">
	<h2>Aktuelles</h2>
	<?php
	$query1 = new WP_Query( array( 
		'post_type' => 'post',
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => 5
	) );
	while ($query1->have_posts()) {
		$query1->the_post();
?>
		<article id="news-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
		the_title( '<h4 class="entry-title">', '</h4>' );
		the_content();
?>
		</article>
<?php
	} 
?>
</div>