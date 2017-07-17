<?php
function mt_servers() {

  $args = array(
    'labels' => array(  'name' => __( 'Servers' ), 'singular_name' => __( 'Server' ) ),
    'public' => true,
    'supports' => array('title', 'thumbnail', 'editor'),
    'has_archive' => false,
    'rewrite' => array( 'slug' => 'servers' ),
  );

  register_post_type( 'servers', $args);

}

add_action( 'init', 'mt_servers' );

function mt_servers_metabox() {

  $prefix = '_mt_';

  $cmb_group = new_cmb2_box( array(
    'id'           => $prefix . 'servers_metabox',
    'title'        => __( 'Server Details', 'cmb2' ),
    'context'      => 'side',
    'priority'     => 'default',
    'object_types' => array( 'servers' ),
    ) );

    $cmb_group->add_field( array(
      'name' => 'IP',
      'id'   => $prefix . 'server_ip',
      'type' => 'text',
    ) );

    $cmb_group->add_field( array(
      'name' => 'Query Port',
      'id'   => $prefix . 'server_query_port',
      'type' => 'text',
    ) );

    $cmb_group->add_field( array(
      'name'             => __( 'Server', 'cmb2' ),
      'id'               => $prefix . 'server_type',
      'type'             => 'select',
      'show_option_none' => true,
      'options'          => mt_get_protocol_options()
    ) );

}

add_action( 'cmb2_admin_init', 'mt_servers_metabox' );
