<?php

add_action('rest_api_init', 'friendmeFriends');

function friendmeFriends() {

    register_rest_route('friendme/v1', 'friends', array(
        'methods' => 'GET',
        'callback' => 'friendmeAllFriends'
    ));

    register_rest_route('friendme/v1', 'friends/newFriends', array(
        'methods' => 'GET',
        'callback' => 'friendmeNewFriends'
    ));

    register_rest_route('friendme/v1', 'friends', array(
        'methods' => 'POST',
        'callback' => 'friendmeAddFriends'
    ));
}

function friendmeNewFriends() {

    $user = wp_get_current_user();
    $newFriends = get_nonfollowed_users($user);
    $data = [];

    foreach($newFriends as $new) {
        $fullName = $new->user_firstname. ' ' . $new->user_lastname;
        $data[] = [
            'id' => $new->ID,
            'full_name' => $fullName,
            'name' => $new->display_name
        ];
    }

    return new WP_REST_RESPONSE($data, 200);
}

function friendmeAddFriends($data) {

    $addFriend = new WP_User($data['id']);
    $user = wp_get_current_user();

    $post = wp_insert_post([
        'post_type' => 'friend',
        'post_title' => $user->display_name,
        'post_status' => 'publish',
        'meta_input' => [
            'friendship' => $addFriend->data
        ]
    ]);

    update_field('friendship', $addFriend->data, $post);

    wp_update_post([
        'ID' => $post, 
        'post_status' => 'publish'  
    ]);
    
    return count(friendmeFollowing($user));
}

function friendmeAllFriends() {

    $user = wp_get_current_user();
    $friends = [];
    $friends['following'] = friendmeFollowing($user);
    $friends['followers'] = friendmeFollowers($user);

    return new WP_REST_RESPONSE($friends, 200);
}

