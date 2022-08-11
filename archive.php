<?php get_header(); 

$user = wp_get_current_user();
$following = friendmeFollowing($user);
$followers = friendmeFollowers($user);
?>

<section class="friends py-5">
    <div class="container">
        <div class="row">
            <div id="followers" class="col-lg-6 col-md-6 my-5">
                <h1>Followers</h1>
                <hr class="w-50">
                <div id="followerFriends" class="list-group w-50">
                        <div class="followerFriends__list">
                        <?php 
                        foreach($followers as $follower) { ?>
                            <a class="followersItem list-group-item list-group-item-action " data-id="<?php echo $follower['id']; ?>">
                                <h6 class="d-inline-block"><?php echo $follower['user_firstname'] . ' ' . $follower['user_lastname']; ?></h6>
                                <br>
                                <p class="d-inline-block"><?php echo $follower['nickname']; ?></p>
                                <?php if(isMutual($user->ID, $follower['id'])){ ?>
                                    <div class="add-friends__button-block d-block ms-auto ">
                                        <button type="button" class="addFriendsButton d-inline-block btn btn-info text-end btn-sm"><i class="fa-solid fa-right-left"></i> Mutual</button>
                                    </div>
                                <?php } ?>
                            </a>
                        <?php  } ?>
                        </div>
                </div>
            </div>
            <div id="following" class="col-lg-6 col-md-6 my-5">
                <h1>Following</h1>
                <hr class="w-50">
                <div id="followingFriends" class="list-group w-50">
                        <div class="followingFriends__list">
                        <?php 
                        foreach($following as $follow) { ?>
                            <a class="followingItem list-group-item list-group-item-action " data-id="<?php echo $follow['ID']; ?>">
                                <h6 class="d-inline-block"><?php echo $follow['user_firstname'] . ' ' . $follow['user_lastname']; ?></h6>
                                <br>
                                <p class="d-inline-block"><?php echo $follow['nickname']; ?></p>
                                <?php if(isMutual($user->ID, $follow['ID'])){ ?>
                                    <div class="add-friends__button-block d-block ms-auto ">
                                        <button type="button" class="addFriendsButton d-inline-block btn btn-info text-end btn-sm"><i class="fa-solid fa-right-left"></i> Mutual</button>
                                    </div>
                                <?php } ?>
                            </a>
                        <?php  } ?>
                        </div>
                </div>
            </div>
        </div>
        <div class="mx-auto text-center">
            <a href="<?php echo site_url('/'); ?>" class="btn btn-lg btn-info my-3">Back Home</a>
        </div>
    </div>
</section>

<?php get_footer() ?>