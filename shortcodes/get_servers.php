<?php
function mt_get_servers() {
  global $post;
  global $results;
  $args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'servers',
    'post_status'      => 'publish',
    'suppress_filters' => true
  );
  $servers = get_posts($args);

  foreach($servers as $post) : setup_postdata($post);
    $results = mt_get_server_response($post);
    $results = $results['result'];

    mt_get_template('get_servers');
  endforeach;
}

add_shortcode('mt_get_servers', 'mt_get_servers' );
