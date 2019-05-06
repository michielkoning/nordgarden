<?php
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}

function init_javascript() {
    if (!is_admin()) {
        wp_register_script( 'main', get_bloginfo('template_url') . '/js/main.js', false, '1.0', true);
        wp_enqueue_script( 'main' );
    }
}

add_action('init', 'init_javascript');

// add a favicon to your
function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico?v=3" />';
}
add_action('wp_head', 'blog_favicon');

add_theme_support( 'post-thumbnails' );

if ( ! function_exists( 'ng_commentlist' ) ) :

function ng_commentlist( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'ping back' :
		case 'trackback' :
	?>
	<li class="post ping back">
		<p><?php _e( 'Pingback:', 'twenty eleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twenty eleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">
			<footer class="comment-meta">
				<div class="comment-author card">
					<?php
						echo get_avatar( $comment, 39 );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twenty eleven' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<time pubdate datetime="%2$s">%3$s</time>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twenty eleven' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
			</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twenty eleven' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( __( 'Edit', 'twenty eleven' ), '<div class="edit-link">', '</div>' ); ?>
			</div><!-- .reply -->

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for ng_commentlist()

add_filter('show_admin_bar', '__return_false');

function facebook_faces_widget_display() {  ?>
	<section class="widget">
		<h1>Friends of GVC</h1>
	<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FGVC-Wageningen%2F176923695729449&amp;width=250&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;height=258&amp;appId=323957647947" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:258px;" allowTransparency="true"></iframe>
	</section>
<?php
}

wp_register_sidebar_widget(
    'facebook_faces_widget',
    'Facebook faces',
    'facebook_faces_widget_display',
    array(
        'description' => 'Show Facebook fans of your page'
    )
);


add_action( 'wp', 'update_feed_setup_schedule' );

//On an early action hook, check if the hook is scheduled - if not, schedule it.
function update_feed_setup_schedule() {
	if ( ! wp_next_scheduled( 'update_feed_hourly_event' ) ) {
		wp_schedule_event( time(), 'hourly', 'update_feed_hourly_event');
	}
}

add_action( 'update_feed_hourly_event', 'update_feed_hourly' );
//haal de feed op uit yahoo
function update_feed_hourly() {
	$feed_url = 'https://rest.bandsintown.com/artists/Nordgarden/events?app_id=TerjeNordgardenWebsite';

	$json = file_get_contents($feed_url);
	$decoded = json_decode($json);

	$tours = array();
	foreach($decoded as $obj) :
		if ($obj->datetime) {
			$tours[] = array(
				'name' => $obj->lineup->name,
				'date' => $obj->datetime,
				'venue' => ($obj->venue->name == 'Unknown venue') ? null : $obj->venue->name,
				'city' => ($obj->venue->city == 'Unknown') ? null : $obj->venue->city,
				'url' => $obj->url
			);
		}
	endforeach;

	update_option( 'tours', $tours );

}

 function show_tours_from_songkick(){
	$tours = maybe_unserialize(get_option('tours'));
	if($tours) :
		$i = 1;
?>
		<ul class="events">
<?php		foreach($tours as $tour) :

				$date =  mysql2date('j M H:i',$tour['date']);
				$location = null;
				if ($tour['venue'] && $tour['city']) {
					$location = strtoupper($tour['city']) . ' @ ' . ucfirst($tour['venue']);
				} else if ($tour['venue']) {
					$location = ucfirst($tour['venue']);
				} else if ($tour['city']) {
					$location = strtoupper($tour['city']);
				}
?>
				<li><a href="<?php echo $tour['url']; ?>" target="_blank"><span class="date"><?php echo $date; ?></span><br><span class="location"><?php echo $location; ?></span></a></li>
<?php			if($i == $amount) break;
				$i++;
			endforeach;
?>
		</ul>
<?php else : ?>
		<p>No tours announced for now.</p>
<?php endif;
}?>