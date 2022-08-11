<?php

// function is_login_page() {

//     return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
// }

// if(!is_admin()){
// function redirectLoggedOutUsers() {
//     if(!is_user_logged_in() && !is_login_page()){

//         wp_redirect('/wp-admin');
//     }
// }
// add_action('init', 'redirectLoggedOutUsers');
// }

//Custom Routes
require get_theme_file_path('/inc/routes/friends-route.php');
require get_theme_file_path('/inc/utils/friends.php');

function friendme_custom_rest() {

    register_rest_field('user', 'full_name', array(

        'get_callback' => function($res){
            $user = get_user_by('id', $res['id']);
            $fullName = $user->user_firstname;
            $fullName .= ' ' . $user->user_lastname;
            return $fullName;
        },
    ));
}

add_action('rest_api_init', 'friendme_custom_rest');

function redirectUsers(){
    $currentUser = wp_get_current_user();

    if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber'){

        wp_redirect(site_url('/'));
        exit;
    }
}

add_action('admin_init', 'redirectUsers');


function noSubAdminBar(){
    $currentUser = wp_get_current_user();

    if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber'){

        show_admin_bar(false);
    }
}

add_action('init', 'noSubAdminBar');

function friendme_theme_files() {

    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css');

    wp_enqueue_script('fontawesome-js', 'https://kit.fontawesome.com/0d2ab70d3f.js', array('jquery'), true, true);
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery'), true, true);
    wp_enqueue_script('main-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);

    wp_localize_script('main-js', 'friendmeData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}

add_action('wp_enqueue_scripts', 'friendme_theme_files');

//Add title tag
add_theme_support('title-tag');

//Add post thumbnails
add_theme_support('post-thumbnails');

//After Setup Theme Support
function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );

}

add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );

