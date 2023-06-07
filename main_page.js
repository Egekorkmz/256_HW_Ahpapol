//text sanitization
function sanitize(string) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#x27;',
        "/": '&#x2F;',
    };
    const reg = /[&<>"'/]/ig;
    return string.replace(reg, (match)=>(map[match]));
}

function generatePost(data, user_id) {
    //no image
    if(data.image == null) {
        $('.posts').append(`<div class='card-body'>
            <div class='card'>
                <div class='card-heading'>
                    <div class='media m0'>
                        <div class='media-left'>
                            <a href='#'>
                                <img src='images/${data.profile_picture}' alt='User' class='media-object img-circle thumb48'>
                            </a>
                        </div>
                        <div class='media-body media-middle pt-sm'>
                            <p class='media-heading m0 text-bold'>${data.first_name} ${data.last_name}</p>
                            <small class='text-muted'><em class='ion-earth text-muted mr-sm'></em><span>${data.date}</span></small>
                        </div>
                    </div>
                <div class='p'>${sanitize(data.text)}</div>
            </div>
            <div class='card-footer form-inline'>
                <button type='button' class='btn btn-flat btn-light like' id='${data.post_id}'><span>${data.user}</span> Like</button>
                <input type="text" class="form-control" id="commentInput" placeholder="Write your comments...">
                <button type='button' class='btn btn-flat btn-light comment' id='${data.post_id}'>Comment</button>
            <div class='comment_to_post' id='comment1_by_user'></div>
            </div></div></div>`);
    }
    //image
    else {
        $('.posts').append(`<div class="card-body">
            <div class="card">
                <div class="card-heading">
                    <div class="media m0">
                        <div class="media-left"><a href="#"><img src="images/${data.profile_picture}" alt="User" class="media-object img-circle thumb48"></a></div>
                        <div class="media-body media-middle pt-sm">
                            <p class="media-heading m0 text-bold">${data.first_name} ${data.last_name}</p><small class="text-muted"><em class="ion-earth text-muted mr-sm"></em><span>${data.date}</span></small>
                        </div>
                    </div>
                </div>
                <div class="card-item"><img src="images/posts/${data.image}" alt="post image" class="fw img-responsive">
                    <div class="card-item-text bg-transparent">
                        <p>${sanitize(data.text)}</p>
                    </div>
                </div>
                <div class="card-footer form-inline">
                    <button type="button" class="btn btn-flat btn-light like" id="${data.post_id}"'><span>${data.user}</span> Like</button>
                    <input type="text" class="form-control" id="commentInput" placeholder="Write your comments...">
                    <button type="button" class="btn btn-flat btn-light comment" id="${data.post_id}">Comment</button>
                    <div class="comment_to_post" id="${data.post_id}">
                        
                    </div>
                </div>
            </div>
        </div>`) 
    }

    $.ajax({
       url: './backend-api.php', 
       method: 'GETLIKESTATUS',
       data: JSON.stringify({user_id, post_id:   data.post_id}),
       contentType: "application/json",
       success: function(response) {
        //console.log(response)
         if(response.length) {
            $(`.like#${data.post_id}`).removeClass("btn-light").addClass("btn-primary");
         }
       },
       error: function(xhr, status, error) {
         // Handle errors, if any
         console.log("fail");
       }
     });
}

//generates comments of a spesific post
function generateComments(post_id){
    $.ajax({
        url: './backend-api.php', 
        method: 'GETCOMMENT',
        data: JSON.stringify({post_id}),
        contentType: "application/json",
        success: function(response) {
        //console.log(response)
          if(response.length) {
            response.forEach(comment => {
                $(`#${post_id}.comment`).after(`<div class='comment_to_post' id='comment1_by_user'>
                        <img src='images/${comment.profile_picture}' alt='User' class='media-object img-circle thumb40'>
                        <div class="margin10">
                            <small class='text-muted'><em class='ion-earth text-muted mr-sm'></em><span>${comment.first_name} ${comment.last_name}</span></small>
                            <p class='media-heading m0'>${sanitize(comment.comment)}</p>
                    </div>
                </div>`);
            });   
          }
        },
        error: function(xhr, status, error) {
          // Handle errors, if any
          console.log("comment gereration fail");
        }
      });

}

function deleteNotification(user_id, friend_id, type){
    $.ajax({
        url: './backend-api.php',
        method: 'DELETENOT',
        data: JSON.stringify({sender_id: friend_id, reciever_id: user_id, type}),
        contentType: "application/json",
        });
}

function addFriend(user_id, friend_id){
    $.ajax({
        url: './backend-api.php',
        method: 'POSTFRIEND',
        data: JSON.stringify({user_id:user_id, friend_id:friend_id}),
        contentType: "application/json",
        success: function(response){
            deleteNotification(user_id, friend_id, 1);
            createFriends(user_id)
        }
    })
}

function removeFriend(user_id, friend_id){
    $.ajax({
        url: './backend-api.php',
        method: 'REMOVEFRIEND',
        data: JSON.stringify({user_id:user_id, friend_id:friend_id}),
        contentType: "application/json",
        success: function(response){
            if(response.length){
                $i=1;
                $(`#${$i}reject`).remove(`#${$i}inside`);
                $i++;
            }
        }
    })
}

function createPosts(user_id, lim) {
    $.ajax({
        url: './backend-api.php', 
        method: 'GETFRIENDPOST',
        data: JSON.stringify({user_id:user_id, limit: lim}),
        contentType: "application/json",
        success: function(response) {
            //console.log(response)
            response.forEach(post => {
                generatePost(post, user_id)
                generateComments(post.post_id)
            });
        },
        error: function(error) {
          console.log(error['responseText']);
        }
      });
}

//
//jquery function
//
$(function() {
    var user_id = user.user_id
    //log out button
    $("#log_out").click(function() {
        window.location = "./Login-Register/logout.php"
    })

    $("#srch").click(function() {
        window.location = "./Friend-search.php"
    })

    var limit = 0
    //getting posts
    createPosts(user_id, limit)
    createFriends(user_id)
    getNotifications(user['user_id']);
        setInterval(function() {
            getNotifications(user['user_id']);
            createFriends(user['user_id'])
        }, 5000);

    //loading more posts
    $("#loadMore").on("click",function(){
        limit += 10
        createPosts(user_id, limit)
    })

    //
    //like button functionality
    //
    $(".card").on("click", ".like", function(){
        //console.log(this)
        //if not liked
        if($(this).hasClass("btn-light")) {
            var likes = parseInt($(this).find("span").text()) + 1;
            var post_id = parseInt($(this).attr('id'))

            $(this).removeClass("btn-light").addClass("btn-primary")
            $(this).find("span").text(likes)
            var method_type = 'POSTLIKESTATUS'
        }
        //if liked
        else {
            var likes = parseInt($(this).find("span").text()) - 1;
            var post_id = parseInt($(this).attr('id'))
            $(this).removeClass("btn-primary").addClass("btn-light")
            $(this).find("span").text(likes)

            var method_type = 'DELETELIKESTATUS'
        }
        //update database
        $.ajax({
            url: './backend-api.php', 
            method: method_type,
            data: JSON.stringify({user_id, post_id}),
            contentType: "application/json",
            success: function(response) {
              //console.log("like should be added")
              //updates like count
                $.ajax({
                    url: './backend-api.php', 
                    method: 'PUTLIKES',
                    data: JSON.stringify({post_id,likes}),
                    contentType: "application/json",
                    success: function(response) {
                    },
                    error: function(xhr, status, error) {
                    // Handle errors, if any
                    console.log("failed request");
                    }
                });
            },
            error: function(xhr, status, error) {
              // Handle errors, if any
              console.log("failed request");
            }
          });

        
        
    })

    //comment functionality
    $(".card").on("click", ".comment", function(){
        var post_id = parseInt($(this).attr('id'))
        var text = $(this).prev().val()

        $.ajax({
            url: './backend-api.php', 
            method: 'POSTCOMMENT',
            data: JSON.stringify({user_id, post_id, text}),
            contentType: "application/json",
            success: function(response) {
                $(".comment_to_post").remove()  
                generateComments(post_id)

            },
            error: function(error) {
              console.log(error['responseText']);
            }
          });
    })

    $i=1;
    $(`#notifications`).on(`click`, function(){
        $(".pop").css("visibility", "collapse");
        $i++;
        $("#pop_not").css("visibility", "visible");
        if($i%2==1){
            $("#pop_not").css("visibility", "collapse");
        }
    });
    $i=1;
    $(`#friends`).on(`click`, function(){
        $(".pop").css("visibility", "collapse");
        $i++;
        $("#pop_frnds").css("visibility", "visible");
        if($i%2==1){
            $("#pop_frnds").css("visibility", "collapse");
        }
    });

    $(".mda-list").on("click",".delete-can",function(){
        var fid=$(this).attr("id")
        var name=$(this).parent().parent().children("h3").html()
        //console.log(fid+"   "+name)
        deleteFriend(user_id,fid)
        //console.log("pressed")
        $(this).parent().parent().parent().html("<p style='color:red;'>You removed "+name+"</p>")
    })

})

function deleteFriend(userid,friendid){
    $.ajax({
        url: './backend-api.php', 
        method: 'REMOVEFRIEND',
        data: JSON.stringify({user_id:userid, friend_id:friendid}),
        contentType: "application/json",
        success: function(response) {
            console.log("successfully removed")
        },
        error: function(error) {
          console.log(error['responseText']);
        }
      });

      $.ajax({
        url: './backend-api.php', 
        method: 'POSTREQUEST',
        data: JSON.stringify({receiver:friendid, sender:userid, type:0}),
        contentType: "application/json",
        success: function(response) {
            console.log("remove notif sent")
        },
        error: function(error) {
          console.log(error['responseText']);
        }
      });
}


function getNotifications(user_id){
    //console.log(user_id)
    $.ajax({
        url: './backend-api.php', 
        method: 'GETNOT',
        data: JSON.stringify({user_id}),
        contentType: "application/json",
        success: function(response) {
            $("#numNot").text(response.length);
            $("#pop_frnds").html("");
            response.forEach((temp)=>{
                if(temp["type"] == 1)
                    $("#pop_frnds").append(`<div class='inside' id='${temp['sender_id']}'>
                                            <p>New friendship request from: ${temp['first_name']} ${temp['last_name']} </p>
                                            <button class="btn btn-flat btn-success" >Accept</button>
                                            <button class="btn btn-flat btn-danger" >Reject</button>
                                            </div>`);
                else{
                    $("#pop_frnds").append(`<div class='inside unfriend' id='${temp['sender_id']}'>
                                            <p> ${temp['first_name']} ${temp['last_name']} unfriended you.</p>
                                            </div>`);    
                        }
                }
                
            )},
        error: function(error) {
            console.log(error['responseText']);
        }
    });
}

function createFriends(user_id){
    //console.log(user_id)
    $.ajax({
        url: './backend-api.php', 
        method: 'FRIEND',
        data: JSON.stringify({user_id}),
        contentType: "application/json",
        success: function(response) {
            list = $("#friend-list")
            list.html("");
            if(response.length == 0) {
                list.append("<div class='mda-list-item'><div class='text-muted text-ellipsis'>You have no friends yet.</div></div>")
            }
            else {
                response.forEach((friend)=>{
                        list.append(`<div class='mda-list-item'><img src='images/${friend['profile_picture']}' alt='${friend['first_name']} ${friend['last_name']}' class='mda-list-item-img thumb48'>
                        <div class='mda-list-item-text'>
                            <h3>${friend['first_name']} ${friend['last_name']}</h3>
                            <div class='text-muted text-ellipsis btn-delete'><i id='${friend['user_id']}' class='fa-solid fa-trash-can delete-can' style='cursor:pointer'></i></div>
                        </div>
                    </div>`);
                    })
            }
            },
        error: function(error) {
            console.log(error['responseText']);
        }
    });
}

$(function(){
    $("#pop_frnds").on("click","button.btn-success",function(){
        //alert("pressed");
        var sender_id = $(this).parent().attr("id");
        var user_id = user.user_id;
        addFriend(user_id,sender_id);
        $(this).parent().html(`<p style='color:green;'>You accepted the request. </p>`);
    });

    $("#pop_frnds").on("click",".btn-danger",function(){
        var sender_id = $(this).parent().attr("id");
        var user_id = user.user_id;
        deleteNotification(user_id,sender_id, 1);
        $(this).parent().html(`<p style='color:red;'>You rejected the request. </p>`);
    });

    $("#pop_frnds").on("click",".unfriend",function(){
        var sender_id = $(this).attr("id");
        var user_id = user.user_id;
        deleteNotification(user_id,sender_id,0);
        $(this).html(`<p style='color:red;'> Notification deleted.</p>`);
    });
});        