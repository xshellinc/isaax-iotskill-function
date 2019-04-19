<?php
/*
* Plugin Name: IoTエンジニア養成キットのサイト必須プラグイン
* Version: 1
* Author: Xshell,Inc.
* Text Domain: isaax-iotskill-function
* Author URI: https://xshell.io
* License: GPL2
*/

/**
 * ログイン時のリダイレクト先をトップページへ
 */
add_action( 'admin_init', function () {
	if( !current_user_can('administrator') ){
		$home_url = site_url('', 'http');
		wp_safe_redirect($home_url);
		exit();
	}
} );

/**
 * ログアウト時のリダイレクト先をトップページへ
 */
add_action( 'wp_logout', function () {
	$home_url = site_url('', 'http');
	wp_safe_redirect($home_url);
	exit();
});

/**
 * 購読者がログイン時に管理バーを表示させない
 */
add_filter( 'show_admin_bar', function ($content) {
	if( current_user_can("administrator") ){
		return $content;
	}
	return false;
});
