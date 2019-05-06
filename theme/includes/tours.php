<?php
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
