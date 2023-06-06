<?php
    require_once "Upload.php";
    require_once "userdb.php";
    require_once "backend-api.php";
    
    session_start();
    if($_SESSION == null){
        header("Location: Login-Register\Ahbapol_Login.php");
        exit;
    }else{
        $userData = $_SESSION['user'];
        $user_id=(int)$_SESSION["user"]["user_id"];
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
                    <button type="button" class="btn btn-flat btn-primary" id="friends">Notifications</button>
                    <button type="button" class="btn btn-flat btn-primary" id="srch"><a href="./Friend-search.html">Search</a></button>
                </div>

                <div class="pop" id="pop_frnds">
                    <?php
                        $notifications=getNotifications($userData['user_id']);
                        //var_dump($notifications);
                        foreach($notifications as $not){
                            
                            echo "<div class='inside'>
                            <p>New friendship request from: {$not['first_name']}  {$not['last_name']}</p>
                            <button>Accept</button>
                            <button>Reject</button>
                            </div>
                            ";
                        }
                    ?>
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
                                    $limit = 10;
                                    $posts=getFriendsPosts($userData['user_id'], $limit);
                                    foreach($posts as $p){
                                        if($p['image'] ==null){
                                            echo "
                                            <div class='card-body'>
                                            <div class='card'>
                                                <div class='card-heading'>
                                                    <div class='media m0'>
                                                        <div class='media-left'>
                                                            <a href='#'>
                                                                <img src='images/{$p['profile_picture']}' alt='User' class='media-object img-circle thumb48'>
                                                            </a>
                                                        </div>
                                                        <div class='media-body media-middle pt-sm'>
                                                            <p class='media-heading m0 text-bold'>{$p['first_name']} {$p['last_name']}</p>
                                                            <small class='text-muted'><em class='ion-earth text-muted mr-sm'></em><span>{$p['date']}</span></small>
                                                        </div>
                                                    </div>
                                                <div class='p'>{sanitize($p[text])}</div>
                                            </div>
                                            <div class='card-footer form-inline'>
                                                <button type='button' class='btn btn-flat btn-light like' id='{$p['post_id']}'><span>{$p['user']}</span> Like</button>
                                                <input type='text' class='form-control' id='commentInput' placeholder='Write your comments...'>
                                                <button type='button' class='btn btn-flat btn-light comment' id='{$p['post_id']}'>Comment</button>
                                            <div class='comment_to_post' id='comment1_by_user'></div>
                                            </div></div></div>
                                            ";
                                        }else{
                                            echo "
                                            <div class='card-body'>
                                            <div class='card'>
                                                <div class='card-heading'>
                                                    <div class='media m0'>
                                                        <div class='media-left'><a href='#'><img src='images/{$p['profile_picture']}' alt='User' class='media-object img-circle thumb48'></a></div>
                                                        <div class='media-body media-middle pt-sm'>
                                                            <p class='media-heading m0 text-bold'>{$p['first_name']} {$p['last_name']}</p><small class='text-muted'><em class='ion-earth text-muted mr-sm'></em><span>{$p['date']}</span></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='card-item'><img src='images/posts/{$p['image']}' alt='post image' class='fw img-responsive'>
                                                    <div class='card-item-text bg-transparent'>
                                                        <p>{sanitize($p[text])}</p>
                                                    </div>
                                                </div>
                                                <div class='card-footer form-inline'>
                                                    <button type='button' class='btn btn-flat btn-light like' id='{$p['post_id']}'><span>{$p['user']}</span> Like</button>
                                                    <input type='text' class='form-control' id='commentInput' placeholder='Write your comments...'>
                                                    <button type='button' class='btn btn-flat btn-light comment' id='{$p['post_id']}'>Comment</button>
                                                    <div class='comment_to_post' id='{$p['post_id']}'>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            ";
                                        }
                                    }
                                ?>
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