<?php
require_once "Upload.php";
require_once "userdb.php";

session_start();
if ($_SESSION == null) {
    //if user is not logged in
    header("Location: Login-Register\Ahbapol_Login.php");
    exit;
} else {
    //var_dump($_SESSION);
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
    <title>Ahbapol - Main Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main_page.css">
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
                    <div class="media-left"><a href="#"><img src=<?= $userPic ?> alt="User" class="media-object img-circle thumbMain"></a></div>
                    <div class="media-body media-middle">
                        <h4 class="media-heading text-white"><?= $userName ?></h4>
                        <span class="text-white"><?= $userEmail ?></span>
                    </div>

                </div>
                <div class="bu">
                    <button type="button" class="btn btn-flat btn-primary position-relative" id="friends">
                        Friends
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            99+
                        </span>
                    </button>
                    <button type="button" class="btn btn-flat btn-primary" id="notifications">Notifications</button>
                    <button type="button" class="btn btn-flat btn-primary" id="srch"><a href="./Friend-search.php">Search</a></button>
                    <button type="button" class="btn btn-flat btn-primary" id="log_out">Log Out</button>
                </div>

                <div class="pop" id="pop_frnds">
                    <div class="inside">
                        <p>New friendship request from: Angela</p>
                        <button type="button" class="btn btn-flat btn-success">Accept</button>
                        <button type="button" class="btn btn-flat btn-danger">Reject</button>
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
                <div class="pop" id="pop_not">
                    <div class="inside">
                        <p>Stephen Palmer shared a new post</p>
                    </div>
                    <div class="inside">
                        <p>My talking Tom liked your post</p>
                    </div>
                </div>

            </div>
            <div class="container-lg ng-scope">
                <div style = "margin-top: 30px;" class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" class="mt ng-pristine ng-valid" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">What's on your mind?</label>
                                        <textarea rows="2" cols="" aria-multiline="true" tabindex="0" aria-invalid="false" class="no-resize form-control" name="txt" value="<?= isset($txt) ? filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "1" ?>" id="share_post_txt"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Picture(Optional)</label>
                                        <input type="file" id="exampleInputFile" name="picture">
                                    </div>
                                    <button type="submit" class="btn btn-success" id="share_post">Submit</button>
                                </form>
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
                            <div class="posts">
                            </div>

                        </div>
                        <div class="page-buttons"><span class="badge bg-secondary">New</span><button type="button" class="btn btn-flat btn-light" id="friends">Next</button></div>
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
    </script>
</body>

</html>