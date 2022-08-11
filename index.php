<?php 
get_header(); 

$user = wp_get_current_user();
$addFriends = get_nonfollowed_users($user);
$following = friendmeFollowing($user);
$followers = friendmeFollowers($user);

?>

<div class="main py-5">
    <div class="container">
        <h1 class="main__title text-center pb-5 mb-5">Friend Me</h1>
        <div class="row">
            <div class="col-lg-9">
                <section class="user-info">
                    <h1 class="user-info__display-name">Welcome, <?php echo esc_html($user->user_nicename); ?></h1>
                    <h3 class="user-info__full-name ps-4"><?php echo esc_html($user->user_firstname). ' '.esc_html($user->user_lastname); ?></h3>
                    <h3 class="user-info__full-name ps-4"><?php echo esc_html($user->description)?></h3>
                </section>

                <section class="friends py-5 ps-2">
                    <h1 class="d-inline-block mx-2">Followers(<a href="<?php echo site_url('friend').'#followers'; ?>" id="followers-count"><?php echo count($followers); ?></a>)</h1>
                    <h1 class="d-inline-block">Following(<a href="<?php echo site_url('friend').'#following'; ?>" id="following-count"><?php echo count($following); ?></a>)</h1>
                </section>

            </div>
            <div class="col-lg-3">
                <section class="suggested-friends">
                    <h4 class="add-friends__title">Suggested Friends</h4>
                    <div id="sugFriends" class="list-group">
                        <div class="sugFriends__list">
                        <?php $count = count($addFriends) <= 5 ? count($addFriends) : 5;  
                        for($i = 0; $i<$count; $i++) { ?>
                            <a class="sugFriendsItem list-group-item list-group-item-action " data-id="<?php echo $addFriends[$i]->ID; ?>">
                                <h6 class="d-inline-block"><?php echo $addFriends[$i]->user_firstname . ' ' . $addFriends[$i]->user_lastname; ?></h6>
                                <br>
                                <p class="d-inline-block"><?php echo $addFriends[$i]->user_nicename; ?></p>
                                <div class="add-friends__button-block d-block ms-auto ">
                                    <button type="button" class="addFriendsButton d-inline-block btn btn-outline-dark text-end btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Friend</button>
                                </div>
                            </a>
                        <?php  } ?>
                        </div>
                        <a id="loadButton" class="list-group-item list-group-item-action bg-info text-center py-3">
                            <i class="loadButton--add fs-1 fw-bold fa fa-plus" aria-hidden="true"></i>
                            <div class="loadButton--load d-none spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

