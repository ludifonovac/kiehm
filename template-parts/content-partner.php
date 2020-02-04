<?php
/**
 * Template part for displaying news in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kiehm
 */

?>
<div id="partner">
	<h2>Partner</h2>
	<p>Sie brauchen beruflich oder privat einen Anhängerführerschein ?</p>
	<p>Dann finden Sie hier unsere Partner-Fahrschulen in Witten, die mit unseren Qualitätsanhängern die Führerscheinklasse BE / B96 schulen.</p>
	<?php
	$query1 = new WP_Query( array( 
		'post_type' => 'partners',
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'ASC',
	) );
	while ($query1->have_posts()) {
		$query1->the_post();
?>
		<article id="partner-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
		the_title( '<h4 class="entry-title">', '</h4>' );
		//the_content();
?>
			<p><?php the_field('partner_address'); ?></p>
			<p>Telefon: <?php the_field('partner_phone'); ?></p>
			<p>Telefax: <?php the_field('partner_fax'); ?></p>
			<p>E-mail: <a href="mailto: <?php the_field('partner_email'); ?>"><?php the_field('partner_email'); ?></a></p>
			<p>Internet: <a href="http://<?php echo url_clean(get_field('partner_url')); ?>" target="_blank"><?php echo url_clean(get_field('partner_url')); ?></a></p>
		</article>
<?php
	}
?>
</div>