<?php
    require_once "Upload.php";
    require_once "userdb.php";
    /*
    session_start();
    if($_SESSION == null){
        header("Location: Login-Register\Ahbapol_Login.php");
        exit;
    }else*/{
        $userData = $_SESSION['user'];
        $userName = $userData['first_name'] . " " . $userData['last_name'];
        $userEmail = $userData['email'];
        $userPic = "images/" . $userData['profile_picture'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Social network wall - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Social_network_wall.css">
    <script>
        //user data dump
        user = <?= json_encode($_SESSION['user']) ?>;
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
                    <div class="media-left"><a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User" class="media-object img-circle thumb64"></a></div>
                    <div class="media-body media-middle">
                        <h4 class="media-heading text-white">John Doe</h4>
                        <span class="text-white">Aliquam viverra nibh at ipsum dapibus pulvinar et eu ligula.</span>
                    </div>

                </div>
                <div class="bu">
                    <button type="button" class="btn btn-flat btn-primary" id="friends">Friends</button>
                    <button type="button" class="btn btn-flat btn-primary" id="notifications">Notifications</button>
                    <button type="button" class="btn btn-flat btn-primary" id="srch"><a href="./Friend-search.html">Search</a></button>
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
                                        <?php
                                            if(!empty($_POST)) {
                                            //var_dump($_FILES);
                                            //var_dump($_POST);
                                            extract($_POST);
                                            $photo = new Upload("picture", "images/posts/");
                                            addPost($userData['user_id'], $txt, $photo->filename);
                                            echo "<p class='help-block'>Your post has been posted.</p>";
                                            }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        <div class="posts">
                            <?php
                                /*$posts=getFriendsPosts($postDate['post_id']);*/

                            ?>
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
                                <?php
                                    $friends = getFriends($userData['user_id']);
                                    //var_dump($friends);
                                    foreach ($friends as $friend) {
                                        echo "<div class='mda-list-item'><img src='images/{$friend['profile_picture']}' alt='{$friend['first_name']} {$friend['last_name']}' class='mda-list-item-img thumb48'>
                                                <div class='mda-list-item-text'>
                                                    <h3>{$friend['first_name']} {$friend['last_name']}</h3>
                                                    <div class='text-muted text-ellipsis btn-delete'><i id='{$friend['user_id']}' class='fa-solid fa-trash-can delete-can' style='cursor:pointer'></i></div>
                                                </div>
                                            </div>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</body>
</html>