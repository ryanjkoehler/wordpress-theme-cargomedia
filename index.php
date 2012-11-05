<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>
	<div class="blogHeader sheet">
			<h2>Official <strong>Blog</strong></h2>
			<h3>Insights from our products, technology and company culture</h3>
			<?php get_search_form(); ?>
	</div>
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

			<div class="sheet pagination">
				<?php posts_nav_link( $sep, $prelabel, $nextlabel ); ?>
			</div>
			<?php else : ?>

			<article class="sheet">
				<h3>404</h3>
			</article>

			<?php endif; ?>


<?php get_footer(); ?>

