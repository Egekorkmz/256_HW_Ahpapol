//tetx sanitization
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

function generatePost(data) {
    $(`<div class='card-body'>
        <div class='card'>
            <div class='card-heading'>
                <div class='media m0'>
                    <div class='media-left'>
                        <a href='#'>
                            <img src='${data}' alt='User' class='media-object img-circle thumb48'>
                        </a>
                    </div>
                    <div class='media-body media-middle pt-sm'>
                        <p class='media-heading m0 text-bold'>Stephen Palmer</p>
                        <small class='text-muted'><em class='ion-earth text-muted mr-sm'></em><span>2 hours</span></small>
                    </div>
                </div>
            <div class='p'></div>
        </div>
        <div class='card-footer'>
            <button type='button' class='btn btn-flat btn-primary like' id='like1'>Like</button>
            <button type='button' class='btn btn-flat btn-primary comment' id='comment1'>Comment</button>
        <div class='comment_to_post' id='comment1_to_post'>
            <textarea rows='1' aria-multiline='true' tabindex='0' aria-invalid='false' class='no-resize form-control' name='txt'></textarea>
        </div>
        <div class='comment_to_post' id='comment1_by_user'></div>
        </div></div></div>`);
}

$(function() {
    //log out button
    $("#log_out").click(function() {
        window.location = "./Login-Register/logout.php"
    })

    //getting posts
    $.ajax({
        url: './backend-api.php', 
        method: 'POST',
        data: JSON.stringify({user_id:user.user_id,text:val}),
        contentType: "application/json",
        success: function(response) {
          //displayFriends(response);
        },
        error: function(xhr, status, error) {
          // Handle errors, if any
          console.log("fail");
        }
      });

    //share post button
    $i=3;
    $(`#share_post`).on(`click`, function(){
        val=sanitize($(`#share_post_txt`).val());
        $.ajax({
            url: './backend-api.php', 
            method: 'POST',
            data: JSON.stringify({user_id:user.user_id,text:val}),
            contentType: "application/json",
            success: function(response) {
              //displayFriends(response);
            },
            error: function(xhr, status, error) {
              // Handle errors, if any
              console.log("fail");
            }
          });
        }) 

        /*
        $e = $("<div class='card-body'><div class='card'><div class='card-heading'><div class='media m0'><div class='media-left'><a href='#'><img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='User' class='media-object img-circle thumb48'></a></div><div class='media-body media-middle pt-sm'><p class='media-heading m0 text-bold'>Stephen Palmer</p><small class='text-muted'><em class='ion-earth text-muted mr-sm'></em><span>2 hours</span></small></div></div><div class='p'></div></div><div class='card-footer'><button type='button' class='btn btn-flat btn-primary like' id='like1'>Like</button><button type='button' class='btn btn-flat btn-primary comment' id='comment1'>Comment</button><div class='comment_to_post' id='comment1_to_post'><textarea rows='1' aria-multiline='true' tabindex='0' aria-invalid='false' class='no-resize form-control' name='txt'></textarea></div><div class='comment_to_post' id='comment1_by_user'></div></div></div></div>");
        
        $val=$(`#share_post_txt`).val();
        $(`.posts`).prepend($e);
        $(`.p`).text(`${$val}`);
        */

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
    $i=1;
    $(`.like`).on(`click`, function(){
        $t=(this.id);
        $i++;
        $(`#${$t}`).css("background", "pink");
        $(`#${$t}`).text("Unlike");
        if($i%2==1){
            $(`#${$t}`).text("Like");
            $(`#${$t}`).css("background", "grey");
        }
    });
    $i=1;
    $(`.comment`).on(`click`, function(){
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