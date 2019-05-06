<?php get_header('popup'); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>">
		<h1><?php the_title(); ?></h1>
		
		<?php the_content(); ?>
		<?php
	    $album_meta 	= get_post_meta($post->ID, 'album_meta', true);

		if (!is_array($album_meta)) $album_meta = array(); 
		$itunes 		= ( array_key_exists('itunes', $album_meta) ) ? $album_meta['itunes'] : '';
		$amazon 		= ( array_key_exists('amazon', $album_meta) ) ? $album_meta['amazon'] : '';

		if ($itunes || $amazon) : 
			if($itunes || $amazon) : 
				if($itunes) echo '<a href="' . $itunes . '" class="btn-itunes" target="_blank">View in iTunes</a>';
				if($amazon) echo '<a href="' . $amazon . '" class="btn-amazon" target="_blank">View in Amazon</a>';
			endif;
			?>
		<?php endif; ?>
		<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo rawurlencode(get_permalink()); ?>&amp;layout=standard&amp;show-faces=true&amp;width=400&amp;action=like&amp;font=arial&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" id="facebook-like" style="border:none; overflow:hidden; width:400px; height:70px;"></iframe>
	</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>