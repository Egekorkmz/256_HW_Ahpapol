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
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>