<?php
    session_start();
    $user_id=(int)$_SESSION["user"]["user_id"];
    $userData = $_SESSION['user'];
    $userName = $userData['first_name'] . " " . $userData['last_name'];
    $userEmail = $userData['email'];
    $userPic = $userData['profile_picture'] != null ? "images/" . $userData['profile_picture'] : "images\default.png";
    echo "<p style='display:none;' id='userid' class='".$user_id."'></p>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./main_page.css">
    <link rel="stylesheet" href="./friend_search.css">
    <script src="./friend_search.js"></script>
</head>
<body>

<section class="container">
    <div class="container-overlap bg-indigo-500 ng-scope">
        <div class="media m0 pv">
            <div class="media-left"><a href="./main_page.php"><img src=<?= $userPic ?> alt="User" class="media-object img-circle thumbMain"></a></div>
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


    <section class="mycontainer">
        <div class="timeline">
            <h4>Search For A Friend</h4>
            <input type="text" id="tosearch">
            <select name="filter-option" id="filter-opt">
                <option value="email">mail</option>
                <option value="first_name">first name</option>
                <option value="last_name">last name</option>
            </select>
            <button id="searchbtn">Search</button>
        </div>
        <div class="friends-part">
        
        </div>
        <p id="result"></p>
    </section>
</section>
    
</body>
</html>