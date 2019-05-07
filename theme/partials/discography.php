<div class="albums">
  <?php
  $albums = new WP_Query(array(
    'post_type' => 'albums',
    'posts_per_page' => '-1'
  ));
  while ($albums->have_posts()) : $albums->the_post();
    $album_meta   = get_post_meta($post->ID, 'album_meta', true);

    if (!is_array($album_meta)) $album_meta = array();
    $releasedate   = (array_key_exists('releasedate', $album_meta)) ? $album_meta['releasedate'] : '';
    $itunes     = (array_key_exists('itunes', $album_meta)) ? $album_meta['itunes'] : '';
    $amazon     = (array_key_exists('amazon', $album_meta)) ? $album_meta['amazon'] : '';
    ?>
    <div class="album">
      <div class="albuminfo">
        <?php the_post_thumbnail('thumbnail'); ?>
        <h2><?php the_title(); ?></h2>
        <?php
        if ($releasedate) echo '<div class="lbl_release">Releasedate: ' . $releasedate . '</div>';
        if ($itunes || $amazon) :
          if ($itunes) echo '<a href="' . $itunes . '" class="btn-itunes" target="_blank">View in iTunes</a>';
          if ($amazon) echo '<a href="' . $amazon . '" class="btn-amazon" target="_blank">View in Amazon</a>';
        endif;
        ?>
      </div>
      <?php
      $songs   = get_post_meta(get_the_ID(), 'songlist', true);

      if ($songs) : ?>
        <ul class="songlist">
          <?php foreach ($songs as $song) :
            if ($song['permalink']) :
              echo '<li><a href="' . $song['permalink'] . '" class="hs">' . $song['title'] . '</a></li>';
            else :
              echo '<li>' . $song['title'] . '</li>';
            endif;
          endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
<?php endwhile; ?>

</div>
