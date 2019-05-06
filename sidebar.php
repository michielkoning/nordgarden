		<aside class="aside">
			<h1 class="hidden">Sidebar</h1>

			<div class="clear"><hr /></div>

<!-- 	<?php query_posts('pagename=home/shows'); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section class="sideblog">
				<h1 class="mainh"><?php the_title(); ?></h1>

				<article id="post-<?php the_ID(); ?>" class="tours">
					<?php the_content(); ?>
					<a href="<?php bloginfo('url'); ?>/shows/" title="Shows" class="readmore">More shows</a>
				</article>
			</section>

	<?php endwhile; endif; ?>
	<?php wp_reset_query(); ?> -->

	<?php if (function_exists('show_tours_from_songkick')) : ?>
		<section class="sideblog">
			<h1 class="mainh">On tour</h1>
			<article class="tours">
				<?php show_tours_from_songkick(); ?>
			</article>
		</section>
	<?php endif; ?>


			<a href="http://www.myspace.com/nordgarden" target="_blank" class="btn-myspace" title="Nordgarden on MySpace">Nordgarden on MySpace</a>
			<a href="http://www.facebook.com/nordgarden1#!/nordgarden1" target="_blank" class="btn-facebook" title="Nordgarden on Facebook">Nordgarden on Facebook</a>

</aside>
