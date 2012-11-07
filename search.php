<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Cargo_Media
 * @since Cargo Media 1.0
 */

get_header(); ?>


	<?php if ( have_posts() ) : ?>

	<div class="blogHeader sheet">
		<h2><?php printf( __( 'Search Results for: %s', 'cargomedia' ), '<strong>' . get_search_query() . '</strong>' ); ?></h2>
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
				<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'cargomedia' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</article>

	<?php endif; ?>

<?php get_footer(); ?>