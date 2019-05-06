<?php
$tours = maybe_unserialize(get_option('tours'));
if ($tours) :
  ?>
  <ul class="events">
    <?php foreach ($tours as $tour) :
      $date =  mysql2date('j M H:i', $tour['date']);
      $location = null;
      if ($tour['venue'] && $tour['city']) {
        $location = strtoupper($tour['city']) . ' @ ' . ucfirst($tour['venue']);
      } else if ($tour['venue']) {
        $location = ucfirst($tour['venue']);
      } else if ($tour['city']) {
        $location = strtoupper($tour['city']);
      }
      ?>
      <li>
        <a href="<?php echo $tour['url']; ?>" target="_blank">
          <span class="date"><?php echo $date; ?></span><br>
          <span class="location"><?php echo $location; ?></span>
        </a>
      </li>
    <?php
  endforeach;
  ?>
  </ul>
<?php else : ?>
  <p>No tours announced for now.</p>
<?php endif;
