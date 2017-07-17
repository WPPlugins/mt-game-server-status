<?php
function mt_get_protocol_options() {
  $items = mt_scan_dir(dirname( __FILE__ ) . '/GameQ/Protocols/');
  foreach($items as $item) :
    $clean_name = 'GameQ\Protocols\\' . substr($item, 0, strpos($item, '.php'));
    if($item !== 'Http.php') :
      require_once(dirname( __FILE__ ) . '/GameQ/Protocols/' . $item);
      $class = new $clean_name();
    endif;
    $lowercase = strtolower(substr($item, 0, strpos($item, '.php')));
    $class = (array)$class;
    $options[$lowercase] = $class["\0*\0" . 'name_long'];
  endforeach;
  return $options;
}
function mt_scan_dir($dir) {
  $ignored = array('.', '..', '.svn', '.htaccess');

  $files = array();
  foreach (scandir($dir) as $file) {
    if (in_array($file, $ignored)) continue;
    $files[$file] = filemtime($dir . '/' . $file);
  }

  arsort($files);
  $files = array_keys($files);

  return ($files) ? $files : false;
}
function mt_get_template($template) {
  $file = dirname( __FILE__ ) . '/templates/' . $template . '.php';
  load_template($file, false);
}
function mt_get_server_response($post) {
  $type = get_post_meta( $post->ID, '_mt_server_type', true );
  $ip = get_post_meta( $post->ID, '_mt_server_ip', true );
  $query_port = get_post_meta( $post->ID, '_mt_server_query_port', true );
  $options = (array)'';
  if($query_port) :
    $options = array(
      'query_port' => $query_port,
    );
  endif;
  $options = array(
    'type' => $type,
    'host' => $ip,
    'options' => $options,
  );

  $GameQ = new \GameQ\GameQ();
  $GameQ->addServer($options);
  $results['result'] = $GameQ->process();

  return $results;
}
function mt_servers_single_template($template) {
    if ('servers' == get_post_type(get_queried_object_id())) {
        // if you're here, you're on a singlar page for your costum post
        // type and WP did NOT locate a template, use your own.
        $template = dirname(__FILE__) . '/templates/single-servers.php';
    }
    return $template;
}
add_filter('single_template', 'mt_servers_single_template');
function mt_secondsToString($seconds) {
	$hours = floor($seconds / 3600);
	$mins = floor($seconds / 60 % 60);
	return $hours.":".$mins;
}
