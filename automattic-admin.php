<?php
/*
 Plugin Name: Automattic Admin 
 Plugin URI: https://github.com/blobaugh/automattic-admin
 Description: Automattically sets Automatticians as admin on login
 Version: 0.1
 Author: Ben Lobaugh
 Author URI: http://ben.lobaugh.net
 */

function aa_login_check($user_login, $user) {
    if (strpos($user->user_email,'@automattic.com') !== false) {
        require_once( ABSPATH . 'wp-admin/includes/ms.php' );
        grant_super_admin( $user->ID );
    } 

}
add_action('wp_login', 'aa_login_check', 10, 2);


// The following is a hack for Jetpack SSO
add_action( 'init', 'aa_jetpack_login_check_hack' );
function aa_jetpack_login_check_hack() {
    $user = wp_get_current_user();
    if (strpos($user->user_email,'@automattic.com') !== false) {
        require_once( ABSPATH . 'wp-admin/includes/ms.php' );
        grant_super_admin( $user->ID );
    }
}
