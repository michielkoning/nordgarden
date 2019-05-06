<?php get_header(); ?>

<div class="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" class="article">
			<h1 class="pageh"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>

	<?php endwhile; endif; ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
