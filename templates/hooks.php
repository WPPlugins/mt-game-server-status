<?php
function mt_get_servers_before_content($post) {
  $html  = '';
  $html .= '<div class="row">';
  $html .= '<div class="servers-list-wrap">';
  $html .= '<div class="row">';
  $html .= '<a href="' . get_the_permalink($post->ID) . '">';
  echo $html;
}
add_filter('get_servers_before_content', 'mt_get_servers_before_content', 5, 1);

function mt_get_servers_left_content($results, $post) {
  $type = get_post_meta( $post->ID, '_mt_server_type', true );
  $results = array_pop($results);
  $map_name = str_replace(' ', '', strtolower($results['gq_mapname']));
  $html  = '';
  $html .= '<div class="servers-left-content">';
  echo $html;
  $html = '';
  if(has_post_thumbnail()) :
    the_post_thumbnail('large', array( 'class' => 'img img-responsive', 'itemprop' => 'image', 'title' => get_the_title(get_post_thumbnail_id()), 'alt' => get_the_title(get_post_thumbnail_id()) ));
  else :
    $html .= '<img alt="' . $results['gq_mapname'] . '" title="' . $results['gq_mapname'] . '" src="http://image.gametracker.com/images/maps/160x120/' . $type . '/' . $map_name . '.jpg">';
  endif;
  $html .= '</div>';
  echo $html;
}
add_filter('get_servers_content', 'mt_get_servers_left_content', 5, 2);

function mt_get_servers_right_content($results, $post) {
  $results = array_pop($results);
  $html  = '';
  $html .= '<div class="servers-right-content">';
    $html .= '<h4>' . $post->post_title . '</h4>';
    $html .= '<div class="server-map"><p><strong>' . __('Map: ') . '</strong>' . $results['gq_mapname'] . '</p></div>';
    $html .= '<div class="server-players"><p><strong>' . __('Players: ') . '</strong>' . $results['gq_numplayers'] . '/' . $results['gq_maxplayers'] . '</p></div>';
    $html .= '<div class="server-ip"><p><strong>' . __('Address: ') . '</strong>' . $results['gq_address'] . ':' . $results['gq_port_client'] . '</p></div>';
  $html .= '</div>';
  echo $html;
}
add_filter('get_servers_content', 'mt_get_servers_right_content', 10, 2);

function mt_get_servers_after_content() {
  $html  = '';
  $html .= '</a>';
  $html .= '</div>';
  $html .= '<hr>';
  $html .= '</div>';
  $html .= '</div>';
  echo $html;
}
add_filter('get_servers_after_content', 'mt_get_servers_after_content', 30);

function mt_single_servers_critical_info($post) {
  $response = mt_get_server_response($post);
  $response = $response['result'];
  $response = array_pop($response);
  if($response['gq_password']) :
    $password_status = __('Yes');
  else :
    $password_status = __('No');
  endif;
  $html  = '';
  $html .= '<div class="server-box-half">';
    $html .= '<div class="server-box-inner">';
      $html .= '<div class="server-title">';
        $html .= '<h3>' . $post->post_title . '</h3>';
      $html .= '</div>';
      $html .= '<div class="server-ip">';
        $html .= '<p><strong>' . __('IP Address: ') . '</strong>' . $response['gq_address'] . '</p>';
      $html .= '</div>';
      $html .= '<div class="server-port">';
        $html .= '<p><strong>' . __('Port: ') . '</strong>' . $response['gq_port_client'] . '</p>';
      $html .= '</div>';
      $html .= '<div class="server-password">';
        $html .= '<p><strong>' . __('Password Protected: ') . '</strong>' . $password_status . '</p>';
      $html .= '</div>';
    $html .= '</div>';
  $html .= '</div>';
  echo $html;
}
add_filter('single_servers_content', 'mt_single_servers_critical_info', 5, 1);

function mt_single_servers_misc_info($post) {
  $response = mt_get_server_response($post);
  $response = $response['result'];
  $response = array_pop($response);
  if($response['gq_dedicated'] == 'd') :
    $is_dedicated = __('Yes');
  else :
    $is_dedicated = __('No');
  endif;
  $html  = '';
  $html .= '<div class="server-box-half">';
    $html .= '<div class="server-box-inner">';
      $html .= '<div class="server-title">';
        $html .= '<h3>' . __('Server Info') . '</h3>';
      $html .= '</div>';
      $html .= '<div class="server-game">';
        $html .= '<p><strong>' . __('Game: ') . '</strong>' . $response['gq_gametype'] . '</p>';
      $html .= '</div>';
      $html .= '<div class="server-players">';
        $html .= '<p><strong>' . __('Players: ') . '</strong>' . $response['gq_numplayers'] . '/' . $response['gq_maxplayers'] . '</p>';
      $html .= '</div>';
      $html .= '<div class="server-gametime">';
        $html .= '<p><strong>' . __('Dedicated Server: ') . '</strong>' . $is_dedicated . '</p>';
      $html .= '</div>';
    $html .= '</div>';
  $html .= '</div>';
  echo $html;
}
add_filter('single_servers_content', 'mt_single_servers_misc_info', 10, 1);

function mt_single_servers_players_info($post) {
  $response = mt_get_server_response($post);
  $response = $response['result'];
  $response = array_pop($response);
  $players  = $response['players'];
  $players_id  = $response['players'];
  if($players_id) :
    $players_id  = $players[0]['name'];
  endif;
  $html  = '';
  $html .= '<div class="server-box-three-quarters">';
    $html .= '<div class="server-box-inner">';
      $html .= '<div class="server-title">';
        $html .= '<h3>' . __('Players') . '</h3>';
      $html .= '</div>';
      $html .= '<div class="server-playerstable">';
        if(!$players) :
          $html .= '<p>' . __('No players online') . '</p>';
        elseif(!$players_id) :
          $html .= '<p>' . __('Player reporting is not supported by this game') . '</p>';
        else :
          $html .= '<table class="server-table">';
            $html .= '<thead>';
              $html .= '<tr>';
                $html .= '<th>' . __('Name') . '</th>';
                $html .= '<th>' . __('Score') . '</th>';
                $html .= '<th>' . __('Time Played') . '</th>';
              $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
                foreach($players as $player) :
                  $html .= '<tr>';
                    $html .= '<td>' . $player['gq_name'] . '</td>';
                    $html .= '<td>' . $player['gq_score'] . '</td>';
                    $html .= '<td>' . mt_secondsToString($player['gq_time']) . '</td>';
                  $html .= '</tr>';
                endforeach;
            $html .= '</tbody>';
          $html .= '</table>';
        endif;
      $html .= '</div>';
    $html .= '</div>';
  $html .= '</div>';
  echo $html;
}
add_filter('single_servers_content', 'mt_single_servers_players_info', 15, 1);

function mt_single_servers_map_info($post) {
  $response = mt_get_server_response($post);
  $response = $response['result'];
  $response = array_pop($response);
  $type = get_post_meta( $post->ID, '_mt_server_type', true );
  $map_name = str_replace(' ', '', strtolower($response['gq_mapname']));
  $html  = '';
  $html .= '<div class="server-box-quarter">';
    $html .= '<div class="server-box-inner">';
      $html .= '<div class="server-title">';
        $html .= '<h3>' . __('Map') . '</h3>';
      $html .= '</div>';
      $html .= '<div class="server-map"><p><strong>' . __('Map: ') . '</strong>' . $response['gq_mapname'] . '</p></div>';
      $html .= '<div class="server-image">';
      echo $html;
      $html = '';
        if(has_post_thumbnail()) :
          the_post_thumbnail('large', array( 'class' => 'img img-responsive', 'itemprop' => 'image', 'title' => get_the_title(get_post_thumbnail_id()), 'alt' => get_the_title(get_post_thumbnail_id()) ));
        else :
          $html .= '<img alt="' . $response['gq_mapname'] . '" title="' . $response['gq_mapname'] . '" src="http://image.gametracker.com/images/maps/160x120/' . $type . '/' . $map_name . '.jpg">';
        endif;
      $html .= '</div>';
    $html .= '</div>';
  $html .= '</div>';
  echo $html;
}
add_filter('single_servers_content', 'mt_single_servers_map_info', 20, 1);

function mt_get_servers_table_content($servers, $post) {
  global $post;
  if (count($servers) === 1) {
    $servers = array($servers);
  }
  $html = '';
  $html .= '<table class="server-table">';
    $html .= '<thead>';
      $html .= '<tr>';
        $html .= '<th>' . __('Server') . '</th>';
        $html .= '<th>' . __('IP:Port') . '</th>';
        $html .= '<th>' . __('Players') . '</th>';
        $html .= '<th>' . __('Map') . '</th>';
      $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
      foreach($servers as $post) :
        $response = mt_get_server_response($post);
        $response = array_pop($response['result']);
        $html .= '<tr>';
          $html .= '<td><a href="' . get_the_permalink($post->ID) . '">' . $post->post_title . '</a></td>';
          $html .= '<td><a href="' . get_the_permalink($post->ID) . '">' . $response['gq_address'] . ':' . $response['gq_port_client'] . '</a></td>';
          $html .= '<td><a href="' . get_the_permalink($post->ID) . '">' . $response['gq_numplayers'] . '/' . $response['gq_maxplayers'] . '</a></td>';
          $html .= '<td><a href="' . get_the_permalink($post->ID) . '">' . $response['gq_mapname'] . '</a></td>';
        $html .= '</tr>';
      endforeach;
    $html .= '</tbody>';
  $html .= '</table>';
  echo $html;
}
add_filter('get_servers_table_content', 'mt_get_servers_table_content', 5, 2);
