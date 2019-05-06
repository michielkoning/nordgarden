<?php get_header(); ?>

<?php query_posts('pagename=home/new-cd'); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<aside id="post-<?php the_ID(); ?>" class="cover">
		<div class="img"><img src="<?php bloginfo('template_url'); ?>/images/cover.jpg" alt="" /></div>
		<div class="text">
			<h1 class="sitetitle"><?php the_title();?></h1>
			<?php the_content(); ?>
		</div>
		<div class="clear"></div>
	</aside>
<?php endwhile; endif; ?>
<?php wp_reset_query(); ?>


<div class="content">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>">
			<header>
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<p>Posted on <?php the_time('F jS, Y'); ?></p>
			</header>
			<section>
				<?php the_content('Read more on "'.the_title('', '', false).'" &raquo;'); ?>
			</section>

			<footer>
				<fb:like href="<?php echo get_permalink(); ?>" layout="button" action="like" show_faces="false" share="true"></fb:like>
				<p><?php edit_post_link('Edit', '', ' &bull; '); ?> <?php comments_popup_link('Respond to this post &raquo;', '1 Response &raquo;', '% Responses &raquo;'); ?></p>
			</footer>
		</article>

		<?php endwhile; ?>

		<nav class="paging">
			<p><?php posts_nav_link('&nbsp;&bull;&nbsp;'); ?></p>
		</nav>

		<?php else : ?>

		<article>
			<h1>Not Found</h1>
			<p>Sorry, but the requested resource was not found on this site.</p>
		</article>

	<?php endif; ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>