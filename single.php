<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Cargo_Media
 * @since Cargo Media 1.0
 */

get_header(); ?>

		<div class="sheet">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>
				<?php comments_template( '', true ); ?>

			<?php endwhile; ?>
		</div>

<?php get_footer(); ?>