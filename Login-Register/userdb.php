<?php

const DSN = "mysql:host=localhost;dbname=ahbappol;port=3306;charset=utf8mb4" ;
const USER = "root" ; 
const PASSWORD = "" ;

 $db = new PDO(DSN, USER, PASSWORD) ;
 
 function checkUser($email, $pass) {
     global $db ;
     $user = getUser($email) ;
     if ( $user ) {
         return password_verify($pass, $user["password_hashed"]) ;
     }
     return false ;
 }

 function validSession() {
     return isset($_SESSION["user"]) ;
 }

 function getUser($email) {
     global $db ;
     $stmt = $db->prepare("select * from users where email=?") ;
     $stmt->execute([$email]);
     return $stmt->fetch() ;
 }
