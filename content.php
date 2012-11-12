<?php
/**
 * The default template for displaying content
 *
 * @package    WordPress
 * @subpackage Cargo_Media
 * @since      Cargo Media 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="sheet">
		<div class="post-thumb">
			<?php if ( has_post_thumbnail() ) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'cargomedia' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				<?php the_post_thumbnail(); ?>
				</a>
			<?php } ?>
		</div>
		<div class="post-entry">
			<h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'cargomedia' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<div class="entry-meta">
				<?php cargomedia_posted_on(); ?>
				<?php
				$categories_list = get_the_category_list(__(', ', 'cargomedia'));
				if ($categories_list): ?>
					<span class="category">
						<?php printf(__(' | Posted in %2$s', 'cargomedia'), '', $categories_list); ?>
					</span>
				<?php endif; ?>

				<?php
				$tags_list = get_the_tag_list('', __(', ', 'cargomedia'));
				if ($tags_list): ?>
					<span class="tag">
						<?php printf(__(' | Tagged %2$s', 'cargomedia'), '', $tags_list); ?>
					</span>
				<?php endif; ?>

				<?php if (comments_open()) : ?>
				 <span class="comment"> | <?php comments_popup_link() ?></span>
				<?php endif; ?>

				<?php edit_post_link(__('Edit', 'cargomedia'), ' | '); ?>
			</div>

			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
				<div class="post-link">
					<a href="<?php the_permalink() ?>">Read more</a>
				</div>
			</div>
		</div>
	</div>
</article>