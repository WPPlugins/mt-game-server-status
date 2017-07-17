<?php
function mt_get_servers_table() {
  global $post;
  global $servers;
  $args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'servers',
    'post_status'      => 'publish',
    'suppress_filters' => true
  );
  $servers = get_posts( $args );

  mt_get_template('get_servers_table');
}

add_shortcode('mt_get_servers_table', 'mt_get_servers_table' );
