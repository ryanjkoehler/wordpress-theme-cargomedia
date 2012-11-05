<?php /* Template Name: Blog Template */ ?>

<?php
/**
 * @package WordPress
 * @subpackage cargomedia
 */

get_header(); ?>
<article>
	<div class="sheet">
			<h2>WANT THIS <strong>Blog</strong></h2>
			<h3>What's going on</h3>
	</div>
</article>
<?php
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	$wp_query->query('posts_per_page=5'.'&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post();
	?>
	<?php get_template_part( 'content', get_post_format() ); ?>
<?php endwhile; ?>

<?php $wp_query = null; $wp_query = $temp;?>

<?php get_footer(); ?>