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

function isLiked(user_id, post_id) {
    var response = false;
     $.ajax({
        url: './backend-api.php', 
        method: 'GETLIKEDSTATUS',
        data: JSON.stringify({user_id, post_id}),
        contentType: "application/json",
        async: false,
        success: function(response) {
          if(response.length()) {
            response = true
          }
          else {
            response = true
          }
        },
        error: function(xhr, status, error) {
          // Handle errors, if any
          console.log("fail");
        }
      });

      return response;
}

function generatePost(data) {
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
            <div class='card-footer'>
                <button type='button' class='btn btn-flat btn-light like' id='${data.post_id}'><span>${data.user}</span> Like</button>
                <button type='button' class='btn btn-flat btn-light comment' id='${data.post_id}'>Comment</button>
            <div class='comment_to_post' id='comment1_to_post'>
                <textarea rows='1' aria-multiline='true' tabindex='0' aria-invalid='false' class='no-resize form-control' name='txt'></textarea>
            </div>
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
                <div class="card-footer">
                    <button type="button" class="btn btn-flat btn-light like" id="${data.post_id}"'><span>${data.user}</span> Like</button>
                    <button type="button" class="btn btn-flat btn-light comment" id="${data.post_id}">Comment</button>
                    <div class="comment_to_post" id="comment2_to_post">
                        <textarea rows="1" aria-multiline="true" tabindex="0" aria-invalid="false" class="no-resize form-control" name="txt" value="<?= isset($txt) ? filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "1" ?>"></textarea>
                    </div>
                    <div class="comment_to_post" id="comment2_by_user">
                        
                    </div>
                </div>
            </div>
        </div>`)
    }

    $.ajax({
       url: './backend-api.php', 
       method: 'GETLIKEDSTATUS',
       data: JSON.stringify({user_id, post_id}),
       contentType: "application/json",
       async: false,
       success: function(response) {
         if(response.length()) {
            $(`.like#${data.post_id}`).removeClass("btn-light").addClass("btn-primary");
         }
       },
       error: function(xhr, status, error) {
         // Handle errors, if any
         console.log("fail");
       }
     });
}

function createPosts(user_id, lim) {
    $.ajax({
        url: './backend-api.php', 
        method: 'GETFRIENDPOST',
        data: JSON.stringify({user_id:user_id, limit: lim}),
        contentType: "application/json",
        success: function(response) {
            console.log(response)
            response.forEach(post => {
                generatePost(post)
            });
        },
        error: function(xhr, status, error) {
          console.log("fail");
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

    //getting posts
    posts = createPosts(user_id, 0)
    console.log(posts)

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

    //like button functionality
    $(".card").on("click", ".like", function(){
        console.log(isLiked(user_id, post_id))
        $.ajax({
            url: './backend-api.php', 
            method: 'POSTLIKESTATUS',
            data: JSON.stringify({user_id, post_id}),
            contentType: "application/json",
            success: function(response) {
              //displayFriends(response);
              console.log(response)
            },
            error: function(xhr, status, error) {
              // Handle errors, if any
              console.log("fail");
            }
          });
        console.log(this)
        if($(this).hasClass("btn-light")) {
            var likes = parseInt($(this).find("span").text()) + 1;
            var post_id = parseInt($(this).attr('id'))
            //console.log(likes, post_id)

            $(this).removeClass("btn-light").addClass("btn-primary")
            $(this).find("span").text(likes)

            $.ajax({
                url: './backend-api.php', 
                method: 'DELETELIKESTATUS',
                data: JSON.stringify({user_id, post_id}),
                contentType: "application/json",
                success: function(response) {
                  //displayFriends(response);
                  console.log(response)
                },
                error: function(xhr, status, error) {
                  // Handle errors, if any
                  console.log("fail");
                }
              });

        }
        else {
            var likes = parseInt($(this).find("span").text()) - 1;
            var post_id = parseInt($(this).attr('id'))
            $(this).removeClass("btn-primary").addClass("btn-light")
            $(this).find("span").text(likes)
        }

        $.ajax({
            url: './backend-api.php', 
            method: 'PUTLIKES',
            data: JSON.stringify({post_id,likes}),
            contentType: "application/json",
            success: function(response) {
              //displayFriends(response);
              console.log("oke")
            },
            error: function(xhr, status, error) {
              // Handle errors, if any
              console.log("fail");
            }
          });
        
     })
    $i=1;
    $(".card").on(`click`, ".comment" ,function(){
        $t = (this.id);
        
        if($i%2==1){
            $(`#${$t}_to_post`).css("visibility", "visible");
            $(`#${$t}`).text("Post");

        }else{
            $(`#${$t}_to_post`).css("visibility", "collapse");
            $(`#${$t}`).text("Comment");
            $val = $(`#${$t}_to_post>textarea`).val();
            $(`#${$t}_by_user`).css("visibility", "visible");

            $e = $("<div class='inside'><p></p></div>");
            $e.attr(`id`, `${$t}_by_user${$i}`);

            $(`#${$t}_by_user`).prepend($e);
            $(`#${$t}_by_user${$i}`).text(`${$val}`);
            
        }
        $i++;
    });

})