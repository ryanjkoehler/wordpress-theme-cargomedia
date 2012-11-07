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

	<h1><?php the_title(); ?></h1>

	<div class="entry-meta">
		<?php if ('post' == get_post_type()) : ?>

		<?php cargomedia_posted_on(); ?>
		<?php endif; ?>
		<?php if ('post' == get_post_type()) : // Hide category and tag text for pages on Search ?>
		<?php
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list(__(', ', 'cargomedia'));
		if ($categories_list): ?>
			<?php printf(__(' | Posted in %2$s', 'cargomedia'), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list); ?>
			<?php endif; // End if categories ?>
		<?php
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list('', __(', ', 'cargomedia'));
		if ($tags_list): ?>
			<?php printf(__(' | Tagged %2$s', 'cargomedia'), '', $tags_list); ?>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if (comments_open()) : ?>
		<span> | <?php comments_popup_link() ?></span>
		<?php endif; // End if comments_open() ?>

		<?php edit_post_link(__('Edit', 'cargomedia'), ' | '); ?>
	</div>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</article>