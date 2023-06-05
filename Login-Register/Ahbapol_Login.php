<?php
  session_start();
  require "..\userdb.php" ;
  
  // auto login 
  if ( validSession()) {
      header("Location: ..\main_page.php") ;
      exit ;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<title>Ahpapol Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="../Img/logo.png">
<link rel="stylesheet" href="./login.css">
</head>
<body>
<?php
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    extract($_POST);
    $email = $_POST["e-mail"];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errorMail = "Enter a valid email!!" ;
    }elseif(empty($password)){
        $errorPass = "Enter a password!!" ;
    }else{
      $check = checkUser($email, $password) ;
      //var_dump($check) ;
      if ( $check === 1 ) {
        $_SESSION["user"] = getUser($email) ;
        header("Location: ..\main_page.php") ;
        exit ;
      }elseif($check === 2){
        $errorMail = "Wrong email!!" ;
      }else{
        $errorPass = "Wrong password!!";
      }
    $authError = true ;
    }
   }
?>
<div class="container">
  <div id="content">
    <div class="container-fluid">
      <div class="lock-container">
          <div class="panel panel-default text-center">
          <img src="../Img/ahbapol.png" class="img-login">
          <form action="" method="post">
            <div class="panel-body">
              <input class="form-control" name="e-mail" type="text" placeholder="User Email" value = "<?= $email ?? ""?>" >
              <span class = "error" ><?= $errorMail ?? "" ?></span>
              <input class="form-control" name="password" type="password" placeholder="Enter Password" >
              <span class = "error" ><?= $errorPass ?? "" ?></span>
              <button type="submit" class="btn btn-success" style=" background-color:#AD7BE9; border:solid 2px #3E54AC">Login</button>
              <a href="Ahbapol_Register.php" class="btn btn-success"  id="register-btn">Register</a>
              <!--<a href="#" class="forgot-password">Forgot password?</a>-->
            </div>
          </form>
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