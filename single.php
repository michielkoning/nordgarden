<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="content">
		<article id="post-<?php the_ID(); ?>">
			<header>

				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<p class="datetime">Posted on <?php the_time('F jS, Y'); ?></p>
			</header>
			<section>
				<?php the_content(); ?>

			</section>

			<footer>
				<fb:like href="<?php echo get_permalink(); ?>" layout="button" action="like" show_faces="false" share="true"></fb:like>
				<p><?php edit_post_link('Edit this entry','','.'); ?></p>
			</footer>

		</article>

		<nav class="paging">
			<div class="prev"><?php previous_post_link(); ?></div>
			<div class="next"><?php next_post_link(); ?></div>
			<div class="clear"></div>
		</nav>

		<?php comments_template( '', true ); ?>

	</div>

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>