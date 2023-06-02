<?php
session_start();
if($_SESSION == null) {
    //if user is not logged in
    header("Location: Login-Register\Ahbapol_Login.php");
    exit;
}
else {
    //var_dump($_SESSION);
    $userData = $_SESSION['user'];
    $userName = $userData['first_name'] . " ". $userData['last_name'];
    $userEmail = $userData['email'];
    $userPic = $userData['profile_picture'] != null ? "images\/".$userData['profile_picture'] : "Img\default.png";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>Social network wall - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main_page.css">
    <script>
        //user data dump
        user = <?=json_encode($_SESSION['user'])?>;
        console.log("aaaaaaaaaaa")
        //console.log(user)
    </script>
    <script src="jquery-3.7.0.min.js"></script>
    <script src="main_page.js"></script>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <section ui-view autoscroll="false" ng-class="app.viewAnimation" class="ng-scope container ng-fadeInLeftShort" style>
        <div ui-view class="ng-fadeInLeftShort ng-scope">
            <div class="container-overlap bg-indigo-500 ng-scope">

                <div class="media m0 pv">
                    <div class="media-left"><a href="#"><img src=<?=$userPic?> alt="User" class="media-object img-circle thumbMain"></a></div>
                    <div class="media-body media-middle">
                        <h4 class="media-heading text-white"><?=$userName?></h4>
                        <span class="text-white"><?=$userEmail?></span>
                    </div>

                </div>
                <div class="bu">
                    <button type="button" class="btn btn-flat btn-primary" id="friends">Friends</button>
                    <button type="button" class="btn btn-flat btn-primary" id="notifications">Notifications</button>
                    <button type="button" class="btn btn-flat btn-primary" id="srch"><a href="./Friend-search.php">Search</a></button>
                    <button type="button" class="btn btn-flat btn-primary" id="log_out">Log Out</button>
                </div>

                <div class="pop" id="pop_frnds">
                    <div class="inside">
                        <p>New friendship request from: Angela</p>
                        <button>Accept</button>
                        <button>Reject</button>
                    </div>
                    <div class="inside">
                        <p>New friendship request from: Harry</p>
                        <button>Accept</button>
                        <button>Reject</button>
                    </div>
                    <div class="inside">
                        <p>New friendship request from: Eren Yeşiltepe</p>
                        <button>Accept</button>
                        <button>Reject</button>
                    </div>
                </div>
                <div class="pop" id="pop_not" >
                    <div class="inside">
                        <p>Stephen Palmer shared a new post</p>
                    </div>
                    <div class="inside">
                        <p>My talking Tom liked your post</p>
                    </div>
                </div>

            </div>
            <div class="container-lg ng-scope">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form action class="mt ng-pristine ng-valid">
                                    <div class="input-group mda-input-group">
                                        <div class="mda-form-group">
                                            <div class="mda-form-control">
                                                <!--post text area-->
                                                <textarea rows="1" aria-multiline="true" tabindex="0" aria-invalid="false" class="no-resize form-control" name="txt" value="<?= isset($txt) ? filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "1" ?>" id="share_post_txt"></textarea>
                                                <div class="mda-form-control-line"></div>
                                                <label class="m0">What's on your mind?</label>
                                            </div><span class="mda-form-msg right">Any message here</span>
                                        </div>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-success" style="margin-top:-44px" id="share_post">
                                                POST
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        <div class="posts">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-heading">
                                        <div class="media m0">
                                            <div class="media-left"><a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User" class="media-object img-circle thumb48"></a></div>
                                            <div class="media-body media-middle pt-sm">
                                                <p class="media-heading m0 text-bold">Stephen Palmer</p><small class="text-muted"><em class="ion-earth text-muted mr-sm"></em><span>2 hours</span></small>
                                            </div>
                                        </div>
                                        <div class="p">Ut egestas consequat faucibus. Donec id lectus tortor. Maecenas at porta purus. Etiam feugiat risus massa. Vivamus fermentum libero vel felis aliquet interdum. </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-flat btn-primary like" id="like1">Like</button>
                                        <button type="button" class="btn btn-flat btn-primary comment" id="comment1">Comment</button>
                                        <div class="comment_to_post" id="comment1_to_post">
                                            <textarea rows="1" aria-multiline="true" tabindex="0" aria-invalid="false" class="no-resize form-control" name="txt" value="<?= isset($txt) ? filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "1" ?>"></textarea>
                                        </div>
                                        <div class="comment_to_post" id="comment1_by_user">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="card">
                                    <div class="card-heading">
                                        <div class="media m0">
                                            <div class="media-left"><a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User" class="media-object img-circle thumb48"></a></div>
                                            <div class="media-body media-middle pt-sm">
                                                <p class="media-heading m0 text-bold">Ricky Wagner</p><small class="text-muted"><em class="ion-earth text-muted mr-sm"></em><span>10 hours</span></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="MaterialImg" class="fw img-responsive">
                                        <div class="card-item-text bg-transparent">
                                            <p>The sun was shinning</p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-flat btn-primary like" id="like2">Like</button>
                                        <button type="button" class="btn btn-flat btn-primary comment" id="comment2">Comment</button>
                                        <div class="comment_to_post" id="comment2_to_post">
                                            <textarea rows="1" aria-multiline="true" tabindex="0" aria-invalid="false" class="no-resize form-control" name="txt" value="<?= isset($txt) ? filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "1" ?>"></textarea>
                                        </div>
                                        <div class="comment_to_post" id="comment2_by_user">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="card reader-block">
                                    <div class="card-heading">
                                        <div class="media m0">
                                            <div class="media-left"><a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User" class="media-object img-circle thumb48"></a></div>
                                            <div class="media-body media-middle pt-sm">
                                                <p class="media-heading m0 text-bold">Stephen Palmer</p><small class="text-muted"><em class="ion-earth text-muted mr-sm"></em><span>Yesterday</span></small>
                                            </div>
                                        </div>
                                        <div class="p">
                                            <div class="mb">Donec a purus auctor dui hendrerit accumsan non quis augue nisl sed iaculis.</div><a href>
                                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Pic" class="mr-sm thumb48"></a>
                                            <a href><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Pic" class="mr-sm thumb48"></a>
                                            <a href><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Pic" class="mr-sm thumb48"></a>
                                            <a href><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Pic" class="mr-sm thumb48"></a>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-flat btn-primary like" id="like3">Like</button>
                                        <button type="button" class="btn btn-flat btn-primary comment" id="comment3">Comment</button>
                                    </div>
                                    <div class="comment_to_post" id="comment3_to_post">
                                        <textarea rows="1" aria-multiline="true" tabindex="0" aria-invalid="false" class="no-resize form-control" name="txt" value="<?= isset($txt) ? filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "1" ?>"></textarea>
                                    </div>
                                    <div class="comment_to_post" id="comment3_by_user">
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="push-down"></div>
                        <div class="card card-transparent">
                            <h5 class="card-heading">Friends</h5>
                            <div class="mda-list">
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Eric Graves</a></h3>
                                        <div class="text-muted text-ellipsis">Ut ac nisi id mauris</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Bruce Ramos</a></h3>
                                        <div class="text-muted text-ellipsis">Sed lacus nisl luctus</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Marie Hall</a></h3>
                                        <div class="text-muted text-ellipsis">Donec congue sagittis mi</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Russell Hart</a></h3>
                                        <div class="text-muted text-ellipsis">Donec convallis arcu sit</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Eric Graves</a></h3>
                                        <div class="text-muted text-ellipsis">Ut ac nisi id mauris</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Jessie Cox</a></h3>
                                        <div class="text-muted text-ellipsis">Sed lacus nisl luctus</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Jonathan Soto</a></h3>
                                        <div class="text-muted text-ellipsis">Donec congue sagittis mi</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Guy Carpenter</a></h3>
                                        <div class="text-muted text-ellipsis">Donec convallis arcu sit</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script type="text/javascript">
        //
        //carried it to main_page.js
        //

        /*$i=3;
        $(`#share_post`).on(`click`, function(){
            $e = $("<div class='card-body'><div class='card'><div class='card-heading'><div class='media m0'><div class='media-left'><a href='#'><img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='User' class='media-object img-circle thumb48'></a></div><div class='media-body media-middle pt-sm'><p class='media-heading m0 text-bold'>Stephen Palmer</p><small class='text-muted'><em class='ion-earth text-muted mr-sm'></em><span>2 hours</span></small></div></div><div class='p'></div></div><div class='card-footer'><button type='button' class='btn btn-flat btn-primary like' id='like1'>Like</button><button type='button' class='btn btn-flat btn-primary comment' id='comment1'>Comment</button><div class='comment_to_post' id='comment1_to_post'><textarea rows='1' aria-multiline='true' tabindex='0' aria-invalid='false' class='no-resize form-control' name='txt'></textarea></div><div class='comment_to_post' id='comment1_by_user'></div></div></div></div>");
            
            $val=$(`#share_post_txt`).val();
            $(`.posts`).prepend($e);
            $(`.p`).text(`${$val}`);
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
        });*/
    </script>
</body>
</html>