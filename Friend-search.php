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
            <button type="button" class="btn btn-flat btn-primary" id="go_back">Go Back</button>
        </div>
    </div>


    <section class="mycontainer">
        <div class="timeline">
            <h4>Search for a Friend</h4>
            <input type="text" id="tosearch">
            <select name="filter-option" id="filter-opt">
                <option value="email">Mail</option>
                <option value="first_name">First name</option>
                <option value="last_name">Last name</option>
            </select>
            <button id="searchbtn">Search</button>
            <p id="errorpart"></p>
        </div>
        <div class="friends-part">
        
        </div>
        <p id="result" style="color:red;"></p>
    </section>
</section>
    
</body>
</html>