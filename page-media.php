<?php get_header(); ?>

<div class="content">


		<article class="article">
			<h1 class="pageh">Media</h1>
	
			<div class="medialinks">
				<a href="#video" title="Videos">Videos</a> &bull; <a href="#photos" title="Photos">Photos</a>
			</div>
			
			<?php show_videos(); ?>

			
			<h2 class="photoh">Photos</h2>
			<a name="photos"></a>
			<?php query_posts('pagename=media/photos'); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
				<?php the_content(); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_query(); ?>
		</article>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
