<?php
  session_start() ;
  require "userdb.php" ;
  // check if the user authenticated before
  if( !validSession()) {
      header("Location: index.php?error") ; // redirect to login page
      exit ; 
  }
 
  $userData = $_SESSION["user"] ;
//   $userData = getUser($token) ;
var_dump($userData);
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
</head>
<body>
    <h1>Sensitive Information</h1>
    <h3>Welcome <?= $userData["first_name"] ?></h3>
    <div>
        <?php
          if (empty($user["profile"])) {
            echo "<img src='images/default.jpg'>" ;
          } else { 
            echo "<img src='../images/d7c3b06f1e0b982c27acf4134340c68755f52222.png'>" ;
          } ?>
    </div>
    <div>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>