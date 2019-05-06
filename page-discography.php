<?php get_header(); ?>

<div class="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" class="article">
			<h1 class="pageh"><?php the_title(); ?></h1>

			<?php the_content(); ?>
<?php
			$albums = new WP_Query('post_type=albums&orderby=menu_order&order=DESC&posts_per_page=-1');
			while ( $albums->have_posts() ) : $albums->the_post();
			    $album_meta 	= get_post_meta($post->ID, 'album_meta', true);

				if (!is_array($album_meta)) $album_meta = array();
				$releasedate 	= ( array_key_exists('releasedate', $album_meta) ) ? $album_meta['releasedate'] : '';
				$itunes 		= ( array_key_exists('itunes', $album_meta) ) ? $album_meta['itunes'] : '';
				$amazon 		= ( array_key_exists('amazon', $album_meta) ) ? $album_meta['amazon'] : '';
?>
				<div class="album">
					<div class="albuminfo">
						<?php the_post_thumbnail('thumbnail'); ?>
						<h2><?php the_title(); ?></h2>
						<?php
						if($releasedate) echo '<div class="lbl_release">Releasedate:<br>' . $releasedate . '</div>';
						if($itunes || $amazon) :
							if($itunes) echo '<a href="' . $itunes . '" class="btn-itunes" target="_blank">View in iTunes</a>';
							if($amazon) echo '<a href="' . $amazon . '" class="btn-amazon" target="_blank">View in Amazon</a>';
						endif;
						?>
					</div>
	<?php
					$songs 	= get_post_meta(get_the_ID(), 'songlist', true);

					if ($songs) : ?>
						<ul class="songlist">
	<?php					foreach ($songs as $song) :
								if ($song['permalink']) :
									echo '<li><a href="' . $song['permalink'] . '" class="hs">' . $song['title'] . '</a></li>';
								else :
									echo '<li>' . $song['title'] . '</li>';
								endif;
							endforeach; ?>
						</ul>
	<?php			endif; ?>
					<div class="clear"><hr /></div>
				</div>
<?php		endwhile; ?>
		</article>

	<?php endwhile; endif; ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
