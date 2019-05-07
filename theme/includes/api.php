<?php

function get_tours()
{
  return maybe_unserialize(get_option('tours'));
}

function get_discography()
{
  $posts = get_posts(array(
    'post_type'   => 'albums',
    'numberposts' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
  ));

  $albums = [];
  foreach ($posts as $post) {
    $album =  new stdClass();

    $album->title = $post->post_title;
    $album->album_meta = $post->album_meta;
    $album->songlist = $post->songlist;
    $albums[] = $album;
  }

  return $albums;
}
// /wp-json/wp/v2/posts
// /wp-json/site/v1/tours
add_action('rest_api_init', function () {
  register_rest_route(
    'site/v1',
    '/tours/',
    array(
      'methods' => 'GET',
      'callback' => 'get_tours'
    )
  );
});

// /wp-json/site/v1/discography
add_action('rest_api_init', function () {
  register_rest_route(
    'site/v1',
    '/discography/',
    array(
      'methods' => 'GET',
      'callback' => 'get_discography'
    )
  );
});
