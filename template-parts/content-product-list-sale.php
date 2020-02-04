<?php
/**
 * Template part for displaying news in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kiehm
 */

?>
<h2>Gebrauchte Anhänger</h2>
<div class="product-list">
<?php
/*$product_categories = get_terms( 'products_category', array(
	//'hide_empty'=> false,
	'orderby'=>'slug',
	'order'=>'ASC',
	'hierarchical' => true
	)
);*/
$query1 = new WP_Query( array( 
	'post_type' => 'products_sale',
	'post_status' => 'publish',
	'orderby' => array (
		//'products_category' => 'ASC',
		'menu_order' => 'ASC'
	),
	//'order' => 'ASC',
	'posts_per_page' => -1,
	) );
$product_count = $query1->post_count;
$i=0;
$c=-1;
/*foreach ($product_categories as $product_category) {
	if ($product_category->parent!=0) {
		echo '<h4>'.$product_category->name.'</h4>';
	}
	else {
		echo '<h2>'.$product_category->name.'</h2>';
	}*/
?>
	<ul>
<?php
	while ($query1->have_posts()) {
		$query1->the_post();
		//if (has_term($product_category->slug, 'products_category')) {
		$c++;
?>
		<li class="product-listed<?php echo ($i==0?' selected':''); ?><?php echo ($c==$product_count?' last':''); ?>" data-value="product-<?php the_ID(); ?>">
			<div class="product-list-img">
<?php
		the_post_thumbnail('thumbnail');
?>
			</div>
			<div class="product-list-desc">
<?php
		the_title( '<h5 class="entry-title">', '</h5>' );
		//the_content();
		$subtitle = get_field('subtitle');
		if (strlen($subtitle) > 27) {
        	$subtitle = rtrim(substr($subtitle,0,27)) .'(...)';
        }
?>
			<h5 class="subtitle"><?php echo $subtitle; ?></h5>
			<p>Lademaße in mm (LxBxH):<br/>ca. <?php the_field('dimensions-x'); ?>x<?php the_field('dimensions-y'); ?>x<?php the_field('dimensions-z'); ?></p>
		</div>
		</li>
		<article id="resp-product-<?php the_ID(); ?>" <?php post_class('product resp-product'); ?>>
			<div class="close-product-div">
				<a class="close-product">X</a>
			</div>
<?php
		//the_post_thumbnail();
		$images = get_field('gallery');

		if( $images ): 
			$count=count($images);
?>
			<div id="leftimageCarousel-product-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
<?php
			for ($i=0; $i<$count; $i++) {
?>
    <li data-target="#leftimageCarousel-product-<?php the_ID(); ?>" data-slide-to="<?php echo $i; ?>" <?php echo ($i!=0)?'':'class="active"'; ?>></li>
<?php				
			}
?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
<?php
			$j=0;
		    foreach( $images as $image ){ 
?>
	<div class="item <?php echo ($j!=0)?'':'active' ?>">
		<img src="<?php echo $image['url']; ?>" />
	</div>
<?php 
				$j++;
			}
?>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#leftimageCarousel-product-<?php the_ID(); ?>" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#leftimageCarousel-product-<?php the_ID(); ?>" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<?php 
		endif;
//		the_content();
		the_title( '<h5 class="entry-title">', '</h5>' );
?>
		<h5 class="subtitle"><?php the_field('subtitle'); ?></h5>
		<div class="product-description">
			<h6>Ausstatung</h6>
			<table>
				<tr>
					<td>Lademaße <br/>in mm (LxBxH) ca.:</td>
					<td class="table-cell-right"><?php the_field('dimensions-x'); ?>x<?php the_field('dimensions-y'); ?>x<?php the_field('dimensions-z'); ?></td>
				</tr>
				<tr>
					<td>Zul. Gesamtgewicht:</td>
					<td class="table-cell-right"><?php the_field('total_weight'); ?>kg</td>
				</tr>
				<tr>
					<td>Nutzlast ca.:</td>
					<td class="table-cell-right"><?php the_field('payload'); ?>kg</td>
				</tr>
				<tr>
					<td>gebremst:</td>
					<td class="table-cell-right"><?php echo get_field('decelerated')?'ja':'nein' ?></td>
				</tr>
				<tr>
					<td>100km/h:</td>
					<td class="table-cell-right"><?php echo get_field('100kmh')?'ja':'nein' ?></td>
				</tr>
			</table>
			<div class="product-sale-details">
				<p>TÜV: <?php the_field('tuv'); ?> Jahre</p>
				<p>EZ: <?php the_field('year'); ?></p>
				<p>Zustand: <?php the_field('condition'); ?></p>
				<p>Zubehör: <?php the_field('equipment'); ?></p>
			</div>
<?php
			if (get_field('more_information')) {
?>
			<p>Weitere Informationen:</p>
			<p><?php the_field('more_information'); ?></p>
<?php
			}
?>
			<p class="drivers-permit">Erforderliche Fahrerlaubnis <?php the_field('required_drivers_permit'); ?></p>
			<h5>Kaufpreis</h5>
			<table class="pricing">
				<tr>
					<td>inkl. MwSt.</td>
					<td class="table-cell-right"><?php echo get_field('price')?number_format(get_field('price'), 2, ',', '.'):''; ?>€</td>
				</tr>
			</table>
			<a href="mailto:info@kiehm.de">Email Kontakt</a>
		</div>
	</article>
<?php
//	}
	$i++;
	} 
?>
	</ul>
<?php
//}
?>
</div>
<?php
$query1->rewind_posts();
$j=0;
while ($query1->have_posts()) {
	$query1->the_post();
?>
	<article id="product-<?php the_ID(); ?>" <?php post_class('product'.($j==0?' selected':'')); ?>>
		<!--<img src="<?php the_post_thumbnail(); ?>" />-->
<?php
		//the_post_thumbnail();
		$images = get_field('gallery');

		if( $images ): 
			$count=count($images);
?>
			<div id="imageCarousel-product-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
<?php
			for ($i=0; $i<$count; $i++) {
?>
    <li data-target="#imageCarousel-product-<?php the_ID(); ?>" data-slide-to="<?php echo $i; ?>" <?php echo ($i!=0)?'':'class="active"'; ?>></li>
<?php				
			}
?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
<?php
			$j=0;
		    foreach( $images as $image ){ 
?>
	<div class="item <?php echo ($j!=0)?'':'active' ?>">
		<img src="<?php echo $image['url']; ?>" />
	</div>
<?php 
				$j++;
			}
?>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#imageCarousel-product-<?php the_ID(); ?>" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#imageCarousel-product-<?php the_ID(); ?>" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<?php 
		endif;
		the_title( '<h5 class="entry-title">', '</h5>' );
?>
		<h5 class="subtitle"><?php the_field('subtitle'); ?></h5>
		<div class="product-description">
			<h6>Ausstatung</h6>
			<table>
				<tr>
					<td>Lademaße <br/>in mm (LxBxH) ca.:</td>
					<td class="table-cell-right"><?php the_field('dimensions-x'); ?>x<?php the_field('dimensions-y'); ?>x<?php the_field('dimensions-z'); ?></td>
				</tr>
				<tr>
					<td>Zul. Gesamtgewicht:</td>
					<td class="table-cell-right"><?php the_field('total_weight'); ?>kg</td>
				</tr>
				<tr>
					<td>Nutzlast ca.:</td>
					<td class="table-cell-right"><?php the_field('payload'); ?>kg</td>
				</tr>
				<tr>
					<td>gebremst:</td>
					<td class="table-cell-right"><?php echo get_field('decelerated')?'ja':'nein' ?></td>
				</tr>
				<tr>
					<td>100km/h:</td>
					<td class="table-cell-right"><?php echo get_field('100kmh')?'ja':'nein' ?></td>
				</tr>
			</table>
			<div class="product-sale-details">
				<p>TÜV: <?php the_field('tuv'); ?> Jahre</p>
				<p>EZ: <?php the_field('year'); ?></p>
				<p>Zustand: <?php the_field('condition'); ?></p>
				<p>Zubehör: <?php the_field('equipment'); ?></p>
			</div>
			<?php
			if (get_field('more_information')) {
?>
			<p>Weitere Informationen:</p>
			<p><?php the_field('more_information'); ?></p>
<?php
			}
?>
			<p class="drivers-permit">Erforderliche Fahrerlaubnis <?php the_field('required_drivers_permit'); ?></p>
			<h5>Kaufpreis</h5>
			<table class="pricing">
				<tr>
					<td>inkl. MwSt.</td>
					<td class="table-cell-right"><?php echo get_field('price')?number_format(get_field('price'), 2, ',', '.'):''; ?>€</td>
				</tr>
			</table>
			<a href="../kontakt">Email Kontakt</a>
		</div>		
	</article>
<?php
	$j++;
	} 
?>