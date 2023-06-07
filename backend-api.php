<?php
  header("Content-Type: application/json") ;
  require "userdb.php" ;

  $method = $_SERVER["REQUEST_METHOD"] ;
  
  $json = file_get_contents('php://input'); 
  $input = json_decode($json) ; 

  if ( $method === "GETPOST") {
     $out = getPosts($input->user_id) ; 
  }

  if ( $method === "GETFRIENDPOST") {
    $out = getFriendsPosts($input->user_id, $input->limit); 
 }

  if( $method === "GETCOMMENT"){
    $out = getComments($input->post_id);
  }

  if ( $method === "FRIEND") {
    $out = getFriends($input->user_id);
 }

  if ( $method === "GETNOT") {
      $out = getNotifications($input->user_id);
  }

  if( $method === "DELETENOT"){
    $out = deleteNotification($input->sender_id, $input->reciever_id, $input->type);
  }

  if ( $method === "GETLIKESTATUS") {
    $out = getLikeStatus($input->user_id, $input->post_id);
  }

  if ( $method === "POSTLIKESTATUS") {
    $out = addLikeStatus($input->user_id, $input->post_id);
  }

  if ( $method === "POST") {
      $out = addPost($input->user_id, $input->text, $input->photo);
  }

  if ( $method === "POSTCOMMENT") {
      $out = addComment($input->user_id, $input->post_id, $input->text);
  }

  if( $method === "POSTFRIEND"){
    $out = addFriend($input->user_id, $input->friend_id);
  }

  if( $method === "POSTREQUEST"){
    $out = friendRequest($input->receiver, $input->sender, $input->type);
  }

  if( $method === "FINDUSER"){
    $out = findUser($input->filter, $input->keyword);
  }

  if( $method === "PUTLIKES"){
    $out = updateLikes($input->post_id, $input->likes);
  }

  if( $method === "DELETELIKESTATUS"){
    $out = deleteLikeStatus($input->user_id, $input->post_id);
  }

  if($method == "REMOVEFRIEND"){
    $out = removeFriend($input->user_id,$input->friend_id);
  }

  if($method == "GETUSER"){
    $out = getUserById($input->user_id);
  }

  echo json_encode($out) ;