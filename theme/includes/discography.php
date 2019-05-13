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
// add_action('init', 'create_youtube_post_type');

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
      'supports' => array('title', 'thumbnail'),
      'public' => true,
      'menu_position' => 200,
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
      'show_in_menu' => 'edit.php?post_type=albums'
    )
  );
}
