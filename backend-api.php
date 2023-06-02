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

  if ( $method === "POST") {
      $out = addPost($input->user_id, $input->text);
  }

  if ( $method === "POSTCOMMENT") {
      $out = addComment($input->user_id, $input->post_id, $input->text);
  }

  if( $method === "POSTFRIEND"){
    $out = addFriend($input->user_id, $input->friend_id);
  }

  if( $method === "POSTREQUEST"){
    $out = friendRequest($input->reciever, $input->sender, $input->type);
  }

  if( $method === "FINDUSER"){
    $out = findUser($input->filter, $input->keyword);
  }

  echo json_encode($out) ;