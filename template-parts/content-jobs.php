<?php
/**
 * Template part for displaying news in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kiehm
 */

?>
<div id="jobs">
	<h2>Jobs</h2>
	<p>WIR SIND AUF DER SUCHE NACH...</p>
	<?php
	$query1 = new WP_Query( array( 
		'post_type' => 'jobs',
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'DESC',
	) );
	while ($query1->have_posts()) {
		$query1->the_post();
?>
		<article id="job-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
		the_title( '<h4 class="entry-title">', '</h4>' );
		the_content();
?>
		</article>
		<hr/>
<?php
	}
?>
	<p>Wie kommen wir zusammen?<br/>
	Bewerbung abschicken, Rückmeldung abwarten. Einladung zum Gespräch, Probearbeiten, Einweisung und dann kann es los gehen.</p>
	
	<p>Senden Sie Ihre Bewerbung mit den möglichen Arbeitszeiten an: <a href="mailto:bewerbung@kiehm.de">bewerbung@kiehm.de</a></p>
</div>