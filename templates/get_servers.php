<?php global $results; global $post; ?>

<?php do_action( 'get_servers_before_content', $post); ?>

<?php do_action( 'get_servers_content', $results, $post ); ?>

<?php do_action( 'get_servers_after_content' ); ?>
