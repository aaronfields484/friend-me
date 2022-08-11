import $ from 'jquery';

class LoadMore {

    constructor() {

        this.events();
    } 

    events() {

        $('.suggested-friends').on('click', '#loadButton', this.loadMoreUsers.bind(this));
    }

    loadMoreUsers() {

        let currentFriends = [];

        //Add Spinner
        $('#loadButton .loadButton--add').addClass('d-none');
        $('#loadButton .loadButton--load').removeClass('d-none');
        
        $('#sugFriends .sugFriendsItem').each((i, obj) => {

            currentFriends.push(Number(obj.dataset.id));
        });



        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', friendmeData.nonce);
            },
            url: `${friendmeData.root_url}/wp-json/friendme/v1/friends/newFriends`,
            type: 'GET',
            success: (res) => {
                console.log('Success');
                console.log(res);
                let newFriends = res.filter(user => !currentFriends.includes(user.id));
                this.addUsers(newFriends, 2);

                //Remove Spinner
                $('#loadButton .loadButton--add').removeClass('d-none');
                $('#loadButton .loadButton--load').addClass('d-none');
             },
            error: (res) => {
                console.log('Error');
                console.log(res);
            }
        });
    }

    addUsers(friends, count) {

        let step = 0;
        friends.map((friend)=> {
            if(step >= count) {

                return;
            }
            step++;
            console.log(friend);
            $('.sugFriends__list').append(`
            <a class="sugFriendsItem list-group-item list-group-item-action" data-id="${friend.id}">
                        <h6 class="d-inline-block">${friend.full_name}</h6>
                        <br>
                        <p class="d-inline-block">${friend.name}</p>
                        <div class="add-friends__button-block d-block ms-auto ">
                            <button type="button" class="addFriendsButton d-inline-block btn btn-outline-dark text-end btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Friend</button>
                        </div>
            </a>
            `);
        });
    
    }
}

export default LoadMore;