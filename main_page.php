<?php
require_once "Upload.php";
require_once "userdb.php";

const SALTING = "_256_SALT_39482766230482601" ;

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

function csrf_check() { 
    if ( isset($_POST["csrf_token"]) && isset($_COOKIE["secret"])) {
        return password_verify($_COOKIE["secret"] . SALTING  , $_POST["csrf_token"]) ;
    }
    return false; 
 }

function create_csrf_token() {
    $secret = bin2hex(random_bytes(10)) ; // create random 10 bytes (20 hex digits)
    setcookie("secret", $secret) ; // session cookie
    return password_hash($secret . SALTING, PASSWORD_BCRYPT) ;
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ahbapol - Main Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="main_page.css">
    <link rel="icon" type="image/x-icon" href="./Img/logo.png">
    <script>
        //user data dump
        user = <?= json_encode($_SESSION['user']) ?>;
        //console.log(user)
    </script>
    <script src="jquery-3.7.0.min.js"></script>
    <script src="main_page.js"></script>
</head>

<body>
    <script>
    </script>
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
                        <span id ="numNot" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"></span>
                    </button>
                    <button type="button" class="btn btn-flat btn-primary" id="srch">Search</button>
                    <button type="button" class="btn btn-flat btn-primary" id="log_out">Log Out</button>
                </div>
                <div class="pop" id="pop_frnds"></div>
                </div>

            </div>
            <div class="container-lg ng-scope">
                <div style = "margin-top: 10px;" class="row bgcontain">
                    <div class="col-md-8">
                        <div class="card bgcard">
                            <div class="card-body">
                                <form method="post" class="mt ng-pristine ng-valid" enctype="multipart/form-data">
                                    <input type="hidden" name="csrf_token" value="<?= create_csrf_token() ?>">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">What's on your mind?</label>
                                        <textarea rows="2" cols="" aria-multiline="true" tabindex="0" aria-invalid="false" class="no-resize form-control" name="txt" style="resize:vertical;" value="<?= isset($txt) ? filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "1" ?>" id="share_post_txt"></textarea>
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
                                    $photo = new Upload("picture", "images/posts");
                                    if ($txt == "") {
                                        echo "<p class='help-block'>Please enter a text.</p>";
                                    }
                                    else {
                                        if ( csrf_check() ) {
                                            addPost($userData['user_id'], $txt, $photo->filename);
                                            echo "<p class='help-block'>Your post has been posted.</p>";
                                        } 
                                        else 
                                        { 
                                           echo "<p class='help-block'>CSRF Error.</p>" ; 
                                           exit ;
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="posts">
                            </div>
                            <button type="button" class="btn btn-flat btn-light" id="loadMore">Load More</button>
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="push-down"></div>
                        <div class="card card-transparent">
                            <h5 class="card-heading">Friends</h5>
                            <div class="mda-list" id="friend-list">
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