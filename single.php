<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

			<article class="single">
				<div class="sheet">
					<?php while ( have_posts() ) : the_post(); ?>

						<nav id="nav-single">
							<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
							<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
						</nav>

						<?php get_template_part( 'content', 'single' ); ?>
						<?php comments_template( '', true ); ?>

					<?php endwhile; ?>
				</div>
			</article>

<?php get_footer(); ?>