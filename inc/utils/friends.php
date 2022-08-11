<?php

function friendmeFollowing($user) {

$userFriends = new WP_QUERY(array(
    'post_type' => 'friend',
    'author__in' => $user->ID,
    'posts_per_page' => -1,
    'orderby' => 'title', 
    'order' => 'ASC'
));

$friends = [];

while($userFriends->have_posts()) {
    $userFriends->the_post();

    $friends[] = get_field('friendship');
}

return $friends;

}

function friendmeFollowers($user) {


$userFriends = new WP_QUERY(array(
    'post_type' => 'friend',
    'posts_per_page' => -1,
    'orderby' => 'date', 
    'order' => 'DESC',
    'meta_query' => array(
        array(
          'key' => 'friendship',
          'compare' => '=',
          'type' => 'numeric',
          'value' =>  $user->ID
        )
      )
));

$friends = [];

while($userFriends->have_posts()) {
    $userFriends->the_post();

    $friends[] = array(
        'id'=> get_the_author_meta('id'),
        'nickname'=> get_the_author_meta('nickname'),
        'user_firstname' => get_the_author_meta('user_firstname'),
        'user_lastname' => get_the_author_meta('user_lastname'),
    );
}

return $friends;

}

function isFollowing($currentUser, $user) {

    $isFollowing = new WP_Query([
        'post_type' => 'friend',
        'posts_per_page' => -1,
        'author__in' => $currentUser,
        'meta_query' => array(
            array(
            'key' => 'friendship',
            'compare' => '=',
            'type' => 'numeric',
            'value' =>  $user
            )
      )
    ]);

    return $isFollowing->have_posts();
}

function isFollower($currentUser, $user) {

    $isFollowing = new WP_Query([
        'post_type' => 'friend',
        'posts_per_page' => -1,
        'author__in' => $user,
        'meta_query' => array(
            array(
            'key' => 'friendship',
            'compare' => '=',
            'type' => 'numeric',
            'value' =>  $currentUser
            )
      )
    ]);

    return $isFollowing->have_posts();
}

function get_nonfollowed_users($user) {

    $allUsers = get_users( array( 'role__in' => array( 'administrator', 'subscriber' ) ) );
    
    $friends = [];
    
    foreach($allUsers as $singleUser) {

        if(!isFollowing($user->ID, $singleUser->ID) && $user->ID != $singleUser->ID) {

            $friends[] = $singleUser;
        }
    }
    
    return $friends;    
}

function isMutual($user, $friend) {

    if(isFollowing($user, $friend) && isFollower($user, $friend)) {

        return true;
    }

    return false;
}