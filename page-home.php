<?php get_header(); ?>

<div class="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" class="article">
			<h1 class="pageh"><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<a href="<?php bloginfo('url'); ?>/biography/" title="Biography" class="readmore">Read on</a>
		</article>
	<?php endwhile; endif; ?>

	<?php query_posts('pagename=home/shows'); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" class="article">
			<h1 class="pageh"><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<a href="<?php bloginfo('url'); ?>/shows/" title="Shows" class="readmore">More shows</a>
		</article>
	<?php endwhile; endif; ?>
	<?php wp_reset_query(); ?>

	<?php if (function_exists('show_promote_video')) : ?>
		<?php show_promote_video(); ?>
	<?php endif; ?>

</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
