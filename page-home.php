<?php
/**
 * Template Name: Front
 * The template for displaying the home page.
 *
 * @package WordPress
 * @subpackage Cargo_Media
 * @since Cargo Media 1.0
 */

get_header(); ?>


<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'content', 'page' ); ?>

<?php endwhile; // end of the loop. ?>



<article class="news">
	<div class="sheet">
		<h4>Company Blog</h4>
		<ul>
			<?php wp_get_archives('title_li=&type=postbypost&limit=10'); ?>
			<?php $posts_array = get_posts( $args ); ?>
		</ul>
	</div>
</article>

<?php get_footer(); ?>