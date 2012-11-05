<?php
/**
 * The default template for displaying content
 *
 * @package    WordPress
 * @subpackage Twenty_Eleven
 * @since      Twenty Eleven 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h1><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php if ('post' == get_post_type()) : ?>

			<?php twentyeleven_posted_on(); ?>
			<?php endif; ?>
			<span class="sep"> | </span>
			<?php $show_sep = false; ?>
			<?php if ('post' == get_post_type()) : // Hide category and tag text for pages on Search ?>
			<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(__(', ', 'twentyeleven'));
			if ($categories_list):
				?>
				<span class="cat-links">
						<?php printf(__('<span class="%1$s">Posted in</span> %2$s', 'twentyeleven'), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list);
					$show_sep = true; ?>
					</span>
				<?php endif; // End if categories ?>
			<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', __(', ', 'twentyeleven'));
			if ($tags_list):
				if ($show_sep) : ?>
					<span class="sep"> | </span>
					<?php endif; // End if $show_sep ?>
				<span class="tag-links">
						<?php printf(__('<span class="%1$s">Tagged</span> %2$s', 'twentyeleven'), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list);
					$show_sep = true; ?>
					</span>
				<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>

			<?php if (comments_open()) : ?>
			<?php if ($show_sep) : ?>
				<span class="sep"> | </span>
				<?php endif; // End if $show_sep ?>

				<span class="comments-link"><?php comments_popup_link('<span class="leave-reply">' . __('Leave a reply', 'twentyeleven') .
					'</span>', __('<b>1</b> Reply', 'twentyeleven'), __('<b>%</b> Replies', 'twentyeleven')); ?></span>
			<?php endif; // End if comments_open() ?>
			<?php edit_post_link(__('Edit', 'twentyeleven'), '<span class="sep"> | </span><span class="edit-link">', '</span>'); ?>
		</div><!-- .entry-meta -->


		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
</article>