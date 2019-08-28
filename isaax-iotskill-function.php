<?php
/*
* Plugin Name: IoTエンジニア養成キットのサイト必須プラグイン
* Version: 1.1
* Author: Xshell,Inc.
* Text Domain: isaax-iotskill-function
* Author URI: https://xshell.io
* License: GPL2
*/

/**
 * ログイン時のリダイレクト先をトップページへ
 */
add_action( 'admin_init', function () {
	if( !current_user_can('edit_posts') ){
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
 * 投稿権限がないユーザーにはログイン時に管理バーを表示させない
 */
add_filter( 'show_admin_bar', function ($content) {
	if( current_user_can("edit_posts") ){
		return $content;
	}
	return false;
});

/**
 * GAにUser-IDを送信する
 */
add_action( 'wp_footer', function () {
	$user = wp_get_current_user();
	if( in_array('subscriber', $user->roles)){
		// ログインしている user_id を使用してUser-ID を設定します。
		$script = "<script>gtag('set', {'user_id': '%s'});</script>";
		echo sprintf($script, esc_attr($user->user_login));
	}
});
