<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Ahpapol Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="./ahbapol.png">
<link rel="stylesheet" href="./register.css">
</head>
<body>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    extract($_POST);
    $firstName_sanitized = filter_var($firstName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastName_sanitized = filter_var($lastName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(empty($firstName) || empty($lastName)){
        $errorName = "Enter a name!!" ;
    }

    if(empty($email)){
        $errorMail = "Enter an email!!" ;
    }else{
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errorMail = "Enter a valid email!!" ;
      }
    }
  
    if(empty($password1) || empty($password2)){
        $errorPassword = "Enter a password!!" ;
    }else{
      if($password1 != $password2){
        $errorPassword = "Passwords do not match!!" ;
     }
    }
    
    $today = date("Y-m-d"); 
    if ($date < $today && preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date)) {}
    else{
      $errorDate = "Enter a valid date!!" ;
    }
    
  


  }
?>

<div class="container">
  <div id="content">
    <div class="container-fluid">
      <div class="lock-container">
          <div class="panel panel-default text-center">
          <img src="./ahbapol.png" class="img-circle img-login">
            <form action="?" method="post">
              <div class="panel-body">
                <div class = "profile-img">
                  <p>Profile Image:</p>
                  <input type="file" name="profile" style="width: 200px;" >
                </div>
                <input class="form-control" type="text" name="firstName" placeholder="First Name" value = "<?= $firstName ?? "" ?>">
                <input class="form-control" type="text" name="lastName" placeholder="Last Name"  value = "<?= $lastName ?? "" ?>" >
                <span class = "error" ><?= $errorName ?? "" ?></span>
                <input class="form-control" type="text" name="email" placeholder="e-mail" value = "<?= $email ?? "" ?>" >
                <span class = "error" ><?= $errorMail ?? "" ?></span>
                <input class="form-control" type="password" name="password1" placeholder="Enter Password" >
                <input class="form-control" type="password" name="password2" placeholder="Re-enter Password" >
                <span class = "error" ><?= $errorPassword ?? "" ?></span>
                <input type="date" class="date" name="date" style="width: 320px;" value = "<?= $date ?? "" ?> "><br>
                <span class = "error" ><?= $errorDate ?? "" ?></span>
                <button type="submit" style="background-color: #9600bf;" class="btn btn-success">Register</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="footer">
  <div class="container footer-container">
    <p class="text-muted">Şükrü Ege Korkmaz 22002902 - Zeynep Yıldız 22101745 - Boran Deniz Düzgün 22002200 - Eren Yeşiltepe 22002527</p>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
	$(function(){
$("body").addClass("login breakpoint-1024");
});
</script>
</body>
</html>