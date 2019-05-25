<?php
/**
Plugin Name: Email Logger
Plugin URI: https://gravityflow.io
Description: Creates a post for each notification sent.
Version: 1.0
Author: Gravity Flow
Author URI: https://gravityflow.io
License: GPL-2.0+
------------------------------------------------------------------------
Copyright 2015-2018 Steven Henty S.L.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses.
 */
function create_email_post_type() {

	register_post_type( 'email',
		array(
			'labels' => array(
				'name' => __( 'Emails' ),
				'singular_name' => __( 'Email' )
			),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'publicly_queryable'  => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'rewrite' => array('slug' => 'email'),
		)
	);
}
add_action( 'init', 'create_email_post_type' );

add_action( 'gform_after_email', 'gravityflow_filter_gform_after_email', 10, 13 );
function gravityflow_filter_gform_after_email( $is_success, $to, $subject, $message, $headers, $attachments, $message_format, $from, $from_name, $bcc, $reply_to, $entry, $cc ) {
	$page = array(
		'post_type'    => 'email',
		'post_content' => $message,
		'post_name'    => sanitize_title_with_dashes( $subject ),
		'post_parent'  => 0,
		'post_author'  => 1,
		'post_status'  => 'publish',
		'post_title'   => $subject,
	);
	wp_insert_post( $page );
}

// Prevent do_pings from sending requests to all the links in the posts e.g. one-click approval links.
/*
if (isset($_GET['doing_wp_cron'])) {
	remove_action('do_pings', 'do_all_pings');
	wp_clear_scheduled_hook('do_pings');
}
*/

