import $ from 'jquery';

class Friends {

    constructor() {

        this.events();
    }

    events() {

        $('.sugFriends__list').on('click', '.addFriendsButton', this.addFriend);
    }

    addFriend(e) {
        
        let addedFriend = $(e.target).parents('a');
        let addedFriendBtn = $(e.target);
        let followingCount = $('#following-count');

        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', friendmeData.nonce);
            },
            url: `${friendmeData.root_url}/wp-json/friendme/v1/friends?id=${addedFriend.attr("data-id")}`,
            type: 'POST',
            success: (res) => {
                console.log('Success');
                console.log(res);
                addedFriend.slideUp();
                followingCount.text(res);
            },
            error: (res) => {
                console.log('Error');
                console.log(res);
            }
        });
    }
}


export default Friends;