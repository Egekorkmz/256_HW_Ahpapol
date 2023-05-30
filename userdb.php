<?php

const DSN = "mysql:host=localhost;dbname=ahbappol;port=3306;charset=utf8mb4" ;
const USER = "root" ; 
const PASSWORD = "" ;

 $db = new PDO(DSN, USER, PASSWORD) ;
 
 function checkUser($email, $pass) {
     global $db ;
     $user = getUser($email) ;
     if ( $user ) {
         if (password_verify($pass, $user["password_hashed"])) {
             return 1 ;
         }else{
             return 0 ;
         }
     }
     return 2 ;
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

 function getUsers(){
    global $db ;
     $stmt = $db->prepare("select * from users") ;
     $stmt->execute();
     return $stmt->fetch() ;
 }

 function getNotification($user_id){
    global $db ;
    $stmt = $db->prepare("select * from notification where reciever_id = ?") ;
    $stmt->execute([$user_id]);
    return $stmt->fetch();
 }

 function getPosts($user_id){
    global $db ;
    $stmt = $db->prepare("select * from posts where user_id = ?") ;
    $stmt->execute([$user_id]);
    return $stmt->fetch();
 }

 function getComments($post_id){
    global $db ;
    $stmt = $db->prepare("select * from comments where post_id = ?") ;
    $stmt->execute([$post_id]);
    return $stmt->fetch();
 }

 function getFriends($user_id){
    global $db ;
    $stmt = $db->prepare("select friend_id from friends_with where user_id = ?") ;
    $stmt->execute([$user_id]);
    return $stmt->fetch();
 }