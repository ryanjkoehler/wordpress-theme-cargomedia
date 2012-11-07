<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Cargo_Media
 * @since Cargo Media 1.0
 */

get_header(); ?>
			<?php if ( have_posts() ) : ?>

				<div class="blogHeader sheet">
					<h2><?php
						printf( __( 'Category: %s', 'cargomedia' ), '<strong>' . single_cat_title( '', false ) . '</strong>' );
					?></h2>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</div>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<div class="sheet pagination">
					<?php posts_nav_link( $sep, $prelabel, $nextlabel ); ?>
				</div>

			<?php else : ?>

				<article class="noResults">
					<div class="sheet">
						<h2><?php _e( 'Nothing Found', 'cargomedia' ); ?></h2>
					</div>
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'cargomedia' ); ?></p>
					<?php get_search_form(); ?>
				</article>

			<?php endif; ?>

<?php get_footer(); ?>
