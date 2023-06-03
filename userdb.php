<?php
require_once "Upload.php"; 
const DSN = "mysql:host=localhost;dbname=ahbapol;port=3306;charset=utf8mb4" ;
const USER = "root" ; 
const PASSWORD = "" ;

try {
    $db = new PDO(DSN, USER, PASSWORD) ;
 } catch(PDOException $e) {
   echo json_encode(["error" => "API Server is down due to DB Connection"]);
   exit ;
 }
 
 
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
     return $stmt->fetchALL() ;
 }

 function getNotifications($user_id){
    global $db ;
    $stmt = $db->prepare("select * from notification where reciever_id = ?") ;
    $stmt->execute([$user_id]);
    return $stmt->fetchALL();
 }

 function getPosts($user_id){
    global $db ;
    $stmt = $db->prepare("select * from posts where user_id = ?") ;
    $stmt->execute([$user_id]);
    return $stmt->fetchALL();
 }

 //gets the posts posted by friends and the user together, page should be multiples of 10
 function getFriendsPosts($user_id, $limit) {
   global $db ;
    $stmt = $db->prepare("select users.user_id, users.first_name, users.last_name, users.profile_picture, posts.post_id, posts.text, posts.image, posts.date, posts.likes user FROM `posts`, `friends_with`, `users` WHERE users.user_id = friends_with.friend_id and posts.user_id = friends_with.friend_id and friends_with.user_id = ? UNION select users.user_id, users.first_name, users.last_name, users.profile_picture, posts.post_id, posts.text, posts.image, posts.date, posts.likes user FROM `posts`, `users` WHERE users.user_id = posts.user_id  and users.user_id = ? order by date desc limit $limit,".$limit + 10 . ";") ;
    $stmt->execute([$user_id, $user_id]);
    return $stmt->fetchALL();
 }

 function getComments($post_id){
    global $db ;
    $stmt = $db->prepare("select users.first_name, users.last_name, users.profile_picture, comments.post_id, comments.comment from users, comments where users.user_id = comments.user_id and comments.post_id = ?") ;
    $stmt->execute([$post_id]);
    return $stmt->fetchALL();
 }

 function getFriends($user_id){
    global $db ;
    $stmt = $db->prepare("select users.user_id, users.first_name, users.last_name, users.profile_picture, users.email from users, friends_with where friends_with.friend_id = users.user_id and friends_with.user_id = ?;") ;
    $stmt->execute([$user_id]);
    return $stmt->fetchALL();
 }

 function getFriendRequests($user_id){
    global $db ;
    $stmt = $db->prepare("select * from friend_requests where reciever_id = ?") ;
    $stmt->execute([$user_id]);
    return $stmt->fetchALL();
 }

 //gets like status
 function getLikeStatus($user_id, $post_id){
   global $db ;
   $stmt = $db->prepare("select * from liked where user_id = ? and post_id = ?") ;
   $stmt->execute([$user_id, $post_id]);
   return $stmt->fetchALL();
}


 function addPost($user_id, $text, $photo){
    global $db ;
    try {
        //$photo = new Upload("profile", "../images");
        $stmt = $db->prepare("insert into posts (user_id, text, image) values (?, ?, ?)") ;
        $stmt->execute([$user_id, $text, $photo]) ;
        $id = $db->lastInsertId() ;
        return ["id" => $id,] ;
     } catch(PDOException $e) {
       return ["error" => "API Error: Insert post"] ;
     }
 }

 function addComment($user_id, $post_id, $text){
    global $db ;
    try {
        $stmt = $db->prepare("insert into comments (user_id, post_id, comment) values (?, ?, ?)") ;
        $stmt->execute([$user_id, $post_id, $text]) ;
        $id = $db->lastInsertId() ;
        return ["id" => $id,] ;
     } catch(PDOException $e) {
       return ["error" => "API Error: Insert comment"] ;
     }
 }

 function friendRequest($reciever, $sender, $type){
    global $db ;
    try {
        $stmt = $db->prepare("insert into notification (reciever_id, sender_id, type) values (?, ?, ?)") ;
        $stmt->execute([$reciever, $sender, $type]) ;
        $id = $db->lastInsertId() ;
        return ["id" => $id,] ;
     } catch(PDOException $e) {
       return ["error" => "API Error: Insert friend request"] ;
     }
 }

 function addLikeStatus($user_id, $post_id){
    global $db ;
    try {
        $stmt = $db->prepare("insert into liked (user_id, post_id) values (?, ?)") ;
        $stmt->execute([$user_id, $post_id]) ;
        $id = $db->lastInsertId() ;
        return ["id" => $id,] ;
     } catch(PDOException $e) {
       return ["error" => "API Error: add like status"] ;
     }
 }

 function addFriend($user_id, $friend_id){
   global $db ;
   try {
       $stmt = $db->prepare("insert into friends_with (user_id, friend_id) values (?, ?)") ;
       $stmt->execute([$user_id, $friend_id]) ;
       $stmt->execute([$friend_id ,$user_id]) ;
       $id = $db->lastInsertId() ;
       return ["id" => $id,] ;
    } catch(PDOException $e) {
      return ["error" => "API Error: Insert friend"] ;
    }
}

 function findUser($filter, $text){
    global $db ;
    $stmt = $db->prepare("select * from users where ".$filter." like '%".$text."%'") ;
    $stmt->execute();
    return $stmt->fetchALL() ;
 }

function updateLikes($post_id, $likes){
   global $db ;
   try {
      $stmt = $db->prepare("update posts set likes = ? where post_id = ?") ;
      $stmt->execute([$likes, $post_id]);
      $id = $db->lastInsertId() ;
      return ["id" => $id,] ;
   } catch(PDOException $e) {
     return ["error" => "API Error: Update Likes"] ;
   }
}

function deleteLikeStatus($user_id, $post_id){
   global $db ;
   try {
       $stmt = $db->prepare("delete from liked where user_id = ? and post_id = ?") ;
       $stmt->execute([$user_id, $post_id]) ;
       $id = $db->lastInsertId() ;
       return ["id" => $id,] ;
    } catch(PDOException $e) {
      return ["error" => "API Error: delete like status"] ;
    }
}
