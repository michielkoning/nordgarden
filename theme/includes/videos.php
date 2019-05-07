<?php
/**
 * @package wp-videos
 * @version 0.1
 */
/*
Plugin Name: Show Videos
Description: Show Videos
Author: Michiel Koning
Version: 0.1
*/
add_action('admin_menu', 'add_videomenu');

function add_videomenu()
{
  $plugin_page = add_menu_page('Videos', 'Videos', 'edit_posts', 'videos-handle', 'video_page', plugin_dir_url(__FILE__) . 'youtube.png');
  add_action('admin_head-' . $plugin_page, 'videos_header');
}

add_action('admin_init', 'video_js_dependencies');
function video_js_dependencies()
{
  wp_enqueue_script(array("jquery-ui-sortable"));
}

function videos_header()
{
  ?>
  <style type="text/css">
    #videobox li {
      margin: 0 5px 5px 12px;
    }

    .ui-state-highlight {
      height: 1.5em;
      line-height: 1.2em;
    }

    .delvideo {
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

    .delvideo:hover {
      background: url("images/xit.gif") no-repeat scroll -10px;
      0 transparent;
    }

    .message_order_updated,
    .message_video_removed {
      display: none;
    }
  </style>
  <script type="text/javascript">
    jQuery(function($) {
      $("#videobox").sortable({
        placeholder: "ui-state-highlight"
      });
      $("#videobox").disableSelection();
    });

    function remove_video(video_id) {
      var data = {
        action: 'removevideo',
        del_video: video_id,
        _ajax_nonce: '<?php echo wp_create_nonce('remove_video_nonce'); ?>'
      };

      jQuery.post(ajaxurl, data, function(response) {
        jQuery('#videobox').html(response);
        jQuery('.updated, .error').hide()
        jQuery('.message_video_removed').show();
        change_video_order();
      })
    };

    function change_video_order() {
      jQuery("#videobox").sortable({
        opacity: 0.6,
        cursor: 'move',
        update: function() {
          var order = jQuery(this).sortable("toArray");

          var data = {
            action: 'change_video_order',
            order: order,
            _ajax_nonce: '<?php echo wp_create_nonce('change_video_order_nonce'); ?>'
          };

          jQuery.post(ajaxurl, data, function(response) {
            jQuery('#videobox').html(response);
            jQuery('.updated, .error').hide()
            jQuery('.message_order_updated').show();
            change_video_order();
          })

        }
      });
    };

    jQuery(function() {
      change_video_order();
    });
  </script>
<?php

}


function video_page()
{
  //must check that the user has the required capability
  if (!current_user_can('edit_posts')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
  }

  if (isset($_POST['new_video']) && wp_verify_nonce($_POST['videos_noncename'], plugin_basename(__FILE__))) {
    $video_ID = $_POST['new_video'];

    $url = "http://gdata.youtube.com/feeds/api/videos/" . $video_ID;
    $handle = @fopen($url, 'r');
    if (!$handle) {
      echo '<div class="error"><p><strong>Video does not exist</strong></p></div>';
    } else {
      $doc = new DOMDocument;
      $doc->load($url);
      $title = $doc->getElementsByTagName("title")->item(0)->nodeValue;

      $videolist = get_videolist();

      if (
        in_array(array('key' => $video_ID, 'title' => $title), $videolist)
        || in_array(array('key' => $video_ID, 'title' => $title, 'highlight' => 1), $videolist)
      ) {
        echo '<div class="error"><p><strong>Video already in list</strong></p></div>';
      } else {
        $add_item = array('key' => $video_ID, 'title' => $title);
        $videolist[] = $add_item;
        $videolist = array_reverse($videolist);
        $insert_data =  maybe_serialize($videolist);
        update_option('videos', $insert_data);
        echo '<div class="updated"><p><strong>Video ' . $title . ' added</strong></p></div>';
      }
    }
  } elseif (isset($_POST['promoted_video']) && wp_verify_nonce($_POST['promoted_video_noncename'], plugin_basename(__FILE__))) {
    $videolist = get_videolist();

    foreach ($videolist as $key => $videoitem) {
      if (array_key_exists('highlight', $videoitem)) {
        unset($videolist[$key]['highlight']);
      };
    }

    $selected_video = $_POST['promoted_video'];
    if (($selected_video !== ''))
      $videolist[$selected_video]['highlight'] = 1;

    $insert_data =  maybe_serialize($videolist);
    update_option('videos', $insert_data);

    if (isset($_POST['promoted_video_title'])) {
      $promoted_video_title = $_POST['promoted_video_title'];
      update_option('promoted_video_title', $promoted_video_title);
    }
    echo '<div class="updated"><p><strong>Selected video updated</strong></p></div>';
  }

  $promoted_video_title = get_option('promoted_video_title');
  ?>

  <div class="updated message_video_removed">
    <p><strong>Video removed</strong></p>
  </div>
  <div class="updated message_order_updated">
    <p><strong>Order updated</strong></p>
  </div>
  <div class="wrap">
    <h2>Videos</h2>
    <form name="form1" method="post" action="">
      <?php wp_nonce_field(plugin_basename(__FILE__), 'videos_noncename'); ?>
      <p>
        <input type="text" name="new_video" value="" size="20">
        <input type="submit" name="Submit" class="button-secondary" value="<?php esc_attr_e('Add video') ?>" />
      </p>
    </form>

    <ul id="videobox">
      <?php admin_show_videos(); ?>
    </ul>
    <h3>Promoted video</h3>
    <form name="form1" method="post" action="">
      <?php wp_nonce_field(plugin_basename(__FILE__), 'promoted_video_noncename'); ?>

      <p>
        <select name="promoted_video">
          <option value="">None</option>
          <?php admin_show_promoted_video(); ?>
        </select>
      </p>
      <p>
        <input type="text" name="promoted_video_title" value="<?php echo $promoted_video_title; ?>" size="20">
      </p>
      <p>
        <input type="submit" name="Submit" class="button-secondary" value="<?php esc_attr_e('Save') ?>" />
      </p>
    </form>
  </div>
<?php
}

function get_videolist()
{
  $videolist = maybe_unserialize(get_option('videos'));
  if (!is_array($videolist)) $videolist = array();
  return $videolist;
}

function admin_show_videos()
{
  $videolist = get_videolist();
  $i = 0;

  foreach ($videolist as $videoitem) :
    echo '<li id="video_' . $i . '"><a href="#" onclick="remove_video(' . $i . '); return false;" class="delvideo">X</a>&nbsp;' . $videoitem['title'] . '</li>';
    $i++;
  endforeach;
}

function admin_show_promoted_video()
{
  $videolist = get_videolist();
  $i = 0;
  foreach ($videolist as $videoitem) :
    $selected = (array_key_exists('highlight', $videoitem)) ? ' selected="selected"' : '';
    echo '<option value="' . $i . '"' . $selected . '>' . $videoitem['title'] . '</option>';
    $i++;
  endforeach;
}

add_action('wp_ajax_removevideo', 'removevideo_callback');
add_action('wp_ajax_change_video_order', 'change_video_order_callback');

function removevideo_callback()
{
  check_ajax_referer('remove_video_nonce');
  $del_video = $_POST['del_video'];

  $videolist = get_videolist();
  if (count($videolist) > 0) {
    unset($videolist[$del_video]);
    $videolist = array_values($videolist);
    $insert_data =  maybe_serialize($videolist);
    update_option('videos', $insert_data);
  }
  admin_show_videos();
  die();
}

function change_video_order_callback()
{
  check_ajax_referer('change_video_order_nonce');
  $order = $_POST['order'];

  $videolist = get_videolist();
  $new_order = array();
  foreach ($order as $videoitem) {
    $videoitem = str_replace('video_', '', $videoitem);
    $videoitem = (int)$videoitem;
    $new_order[] = $videolist[$videoitem];
  }
  update_option('videos', $new_order);

  admin_show_videos();
  die();
}

function show_videos()
{
  $videolist = get_videolist();
  if (count($videolist) > 0) : ?>
    <div class="videoblock">
      <h2>Videos</h2>
      <a name="video"></a>

      <div id="videoplayer">
        <iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $videolist[0]['key']; ?>?fs=1" frameborder="0" allowfullscreen></iframe>
      </div>
      <?php if (count($videolist) > 1) : ?>
        <div class="videolist">
          <a name="videos"></a>


          <?php foreach ($videolist as $video) : ?>
            <div class="video-box" style="background-image:url(http://img.youtube.com/vi/<?php echo $video['key']; ?>/1.jpg)">
              <a href="<?php echo $video['key']; ?>" title="<?php echo $video['title']; ?>" class="btn-video"><?php echo $video['title']; ?></a>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <div class="clear">
        <hr />
      </div>
    </div>

  <?php endif;
}

function show_promote_video()
{
  $videolist = get_videolist();
  $promoted_video_title = get_option('promoted_video_title');

  foreach ($videolist as $key => $videoitem) {
    if (array_key_exists('highlight', $videoitem)) { ?>
      <article class="article">
        <h1 class="pageh"><?php echo $promoted_video_title; ?></h1>
        <iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $videolist[$key]['key']; ?>?fs=1" frameborder="0" allowfullscreen></iframe>
      </article>
      <?php
      break;
    };
  }

  ?>
<?php

}
