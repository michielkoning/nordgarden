<?php
/**
 * @package wp-discography
 * @version 0.1
 */
/*
Plugin Name: Show Albums and lyrics
Description: Show Albums and lyrics
Author: Michiel Koning
Version: 0.1
*/

add_action('init', 'create_album_post_type');
add_action('init', 'create_song_post_type');

function create_album_post_type()
{
  register_post_type(
    'albums',
    array(
      'labels' => array(
        'name' => __('Albums', 'nordgarden'),
        'singular_name' => __('Album', 'nordgarden'),
        'add_new' => __('New album', 'nordgarden'),
        'add_new_item' => __('Add new album', 'nordgarden'),
        'edit_item' => __('Edit album', 'nordgarden'),
        'new_item' => __('New album', 'nordgarden'),
        'view_item' => __('View album', 'nordgarden'),
        'search_items' => __('Search albums', 'nordgarden'),
        'not_found' => __('No albums found', 'nordgarden'),
        'not_found_in_trash' => __('No albums found in Trash', 'nordgarden')
      ),
      'supports' => array('title', 'thumbnail', 'page-attributes'),
      'public' => true,
      'menu_position' => 200,
      'register_meta_box_cb' => 'add_album_metaboxes',
      'menu_icon' => 'dashicons-format-audio'
    )
  );
}

function create_song_post_type()
{
  register_post_type(
    'songs',
    array(
      'labels' => array(
        'name' => __('Songs', 'nordgarden'),
        'singular_name' => __('Song', 'nordgarden'),
        'add_new' => __('New song', 'nordgarden'),
        'add_new_item' => __('Add new song', 'nordgarden'),
        'edit_item' => __('Edit song', 'nordgarden'),
        'new_item' => __('New song', 'nordgarden'),
        'view_item' => __('View song', 'nordgarden'),
        'search_items' => __('Search songs', 'nordgarden'),
        'not_found' => __('No songs found', 'nordgarden'),
        'not_found_in_trash' => __('No songs found in Trash', 'nordgarden')
      ),
      'supports' => array('title', 'editor'),
      'public' => true,
      'menu_position' => 210,
      'register_meta_box_cb' => 'add_song_metaboxes',
      'show_in_menu' => 'edit.php?post_type=albums',
    )
  );
}

function add_album_metaboxes()
{
  add_meta_box('albummeta', 'Album information', 'album_metadata_box', 'albums', 'side');
  add_meta_box('songmeta', 'Songs', 'edit_songlist', 'albums', 'normal');
}

function add_song_metaboxes()
{
  add_meta_box('album_metadata', 'Song information', 'album_metadata_box', 'songs', 'side');
}


function album_metadata_box()
{

  global $post;
  wp_nonce_field(plugin_basename(__FILE__), 'albums_noncename');
  // Get the location data if its already been entered
  $album_meta   = get_post_meta($post->ID, 'album_meta', true);

  if (!is_array($album_meta)) $album_meta = array();
  $releasedate   = (array_key_exists('releasedate', $album_meta)) ? $album_meta['releasedate'] : '';
  $itunes     = (array_key_exists('itunes', $album_meta)) ? $album_meta['itunes'] : '';
  $amazon     = (array_key_exists('amazon', $album_meta)) ? $album_meta['amazon'] : '';

  // Echo out the field
  if ($post->post_type == 'albums') {
    echo '<p>Releasedate:</p>';
    echo '<input type="text" name="releasedate" value="' . $releasedate . '" class="widefat" />';
  } else {
    echo '<input type="hidden" name="releasedate" value="" class="widefat" />';
  }
  echo '<p>iTunes link</p>';
  echo '<input type="text" name="itunes" value="' . $itunes . '" class="widefat" />';
  echo '<p>Amazon link</p>';
  echo '<input type="text" name="amazon" value="' . $amazon . '" class="widefat" />';
}


function save_album_meta($post_id)
{
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return $post_id;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if (!wp_verify_nonce($_POST['albums_noncename'], plugin_basename(__FILE__))) {
    return $post_id;
  }

  // Is the user allowed to edit the post or page?
  if (!current_user_can('edit_post', $post_id))
    return $post_id;

  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.

  $album_meta = array(
    'releasedate'       =>  $_POST['releasedate'],
    'itunes'         =>  $_POST['itunes'],
    'amazon'         =>  $_POST['amazon']
  );

  update_post_meta($post_id, 'album_meta', $album_meta);
}


add_action('save_post', 'save_album_meta');

function admin_show_songlist($post_id)
{
  $songs   = get_post_meta($post_id, 'songlist', true);

  if (is_array($songs)) :
    $i = 0; ?>
    <ul id="sortable">
      <?php foreach ($songs as $song) :
        echo '<li id="song_' . $i . '"><a href="#" onclick="remove_song(' . $i . ')" class="delsong">X</a>&nbsp;' . ($i + 1) . '. ' . $song['title'] . '</li>';
        $i++;
      endforeach;
      ?>
    </ul>
  <?php
endif;

$the_query = new WP_Query('post_type=songs&posts_per_page=-1');
if ($the_query->have_posts()) : ?>
    <select style="width:250px;" name="songlist" id="songlist">
      <?php
      while ($the_query->have_posts()) : $the_query->the_post();
        $permalink = get_permalink(get_the_ID());
        if (!is_array($songs)) $songs = array();
        if (
          !in_array(array('id' => get_the_ID(), 'title' => get_the_title(), 'permalink' => $permalink), $songs)
          && !in_array(array('id' => get_the_ID(), 'title' => get_the_title(), 'permalink' => ''), $songs)
        ) {
          echo '<option value="' . get_the_ID() . '">' . get_the_title() . '</option>';
        }
      endwhile; ?>
    </select>
    <input name="addsong" type="button" class="button" id="addsong" accesskey="p" onclick="add_song(document.getElementById('songlist').value)" value="Add song" />

  <?php
endif;
}

function edit_songlist()
{
  global $post;
  // Noncename needed to verify where the data originated
  wp_nonce_field(plugin_basename(__FILE__), 'albums_songlist_noncename');
  ?>
  <div id="songlist_box">
    <?php admin_show_songlist($post->ID); ?>
  </div>
<?php

}

add_action('admin_head', 'albums_header');

// Hook for adding admin menus
function albums_js_dependencies()
{
  wp_enqueue_script(array("jquery-ui-sortable"));
}

add_action('admin_init', 'albums_js_dependencies');

function albums_header()
{
  global $post; ?>
  <style type="text/css">
    #sortable li {
      margin: 0 5px 5px 12px;
    }

    .ui-state-highlight {
      height: 1.5em;
      line-height: 1.2em;
    }

    .delsong {
      background: url("images/xit.gif") no-repeat scroll 0 0 transparent;
      overflow: hidden;
      text-indent: -9999px;
      display: block;
      float: left;
      height: 10px;
      width: 10px;
      margin: 3px 0 0 -10px;
      position: absolute;
    }

    .delsong:hover {
      background: url("images/xit.gif") no-repeat scroll -10px;
      0 transparent;
    }
  </style>
  <script type="text/javascript">
    function add_song(song_id) {
      var data = {
        action: 'addsong',
        post_id: <?php echo $post->ID; ?>,
        song_id: song_id,
        _ajax_nonce: '<?php echo wp_create_nonce('add_song_nonce'); ?>'
      };

      jQuery.post(ajaxurl, data, function(response) {
        jQuery('#songlist_box').html(response);
        change_songlist();
      })
      return false;
    }

    function remove_song(song_id) {
      var data = {
        action: 'removesong',
        post_id: <?php echo $post->ID; ?>,
        song_id: song_id,
        _ajax_nonce: '<?php echo wp_create_nonce('remove_song_nonce'); ?>'
      };

      jQuery.post(ajaxurl, data, function(response) {
        jQuery('#songlist_box').html(response);
        change_songlist();
      })
      return false;
    }

    function change_songlist() {
      jQuery("#sortable").sortable({
        opacity: 0.6,
        cursor: 'move',
        update: function() {
          var order = jQuery(this).sortable("toArray");

          var data = {
            action: 'change_songorder',
            post_id: <?php echo $post->ID; ?>,
            order: order,
            _ajax_nonce: '<?php echo wp_create_nonce('change_songorder_nonce'); ?>'
          };

          jQuery.post(ajaxurl, data, function(response) {
            jQuery('#songlist_box').html(response);
            change_songlist();
          })

        }
      });
    };

    jQuery(function() {
      change_songlist();
    });
  </script>

<?php
}

add_action('wp_ajax_addsong', 'addsong_callback');
add_action('wp_ajax_removesong', 'removesong_callback');
add_action('wp_ajax_change_songorder', 'change_songorder_callback');

function addsong_callback()
{
  check_ajax_referer('add_song_nonce');
  $post_id   = $_POST['post_id'];
  $song_id   = $_POST['song_id'];
  $song     = get_post($song_id);

  if ($song) {
    $title    = $song->post_title;

    $permalink  = (strlen($song->post_content) > 5) ? get_permalink($song_id) : '';

    $songs = get_post_meta($post_id, 'songlist', true);
    if (!is_array($songs)) $songs = array();
    $songs = maybe_unserialize($songs);
    $songs[] = array(
      'id'    => $song_id,
      'title'   => $title,
      'permalink'  => $permalink
    );

    update_post_meta($post_id, 'songlist', $songs);
    admin_show_songlist($post_id);
  }
  die();
}

function removesong_callback()
{
  check_ajax_referer('remove_song_nonce');
  $post_id   = $_POST['post_id'];
  $song_id   = $_POST['song_id'];

  $songs = get_post_meta($post_id, 'songlist', true);
  unset($songs[$song_id]);
  $songs = array_values($songs);
  update_post_meta($post_id, 'songlist', $songs);
  admin_show_songlist($post_id);
  die();
}

function change_songorder_callback()
{
  check_ajax_referer('change_songorder_nonce');
  $post_id   = $_POST['post_id'];
  $order     = $_POST['order'];

  $songs = get_post_meta($post_id, 'songlist', true);
  $new_order = array();
  foreach ($order as $song) {
    $song_item = str_replace('song_', '', $song);
    $song_item = (int)$song_item;

    $new_order[] = $songs[$song_item];
  }

  update_post_meta($post_id, 'songlist', $new_order);
  admin_show_songlist($post_id);
  die();
}
