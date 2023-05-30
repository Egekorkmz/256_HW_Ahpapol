<?php
  header("Content-Type: application/json") ;
  require "userdb.php" ;

  $method = $_SERVER["REQUEST_METHOD"] ;
  
  $json = file_get_contents('php://input'); 
  $input = json_decode($json) ;  

  if ( $method === "GETPOST") {
     $out = getPosts($input->user_id) ;
     sleep(1) ;  
  }

  if( $method === "GETCOMMENT"){
    $out = getComments($input->post_id);
    sleep(1) ;
  }

  if ( $method === "FRIEND") {
    $out = getFriends($input->user_id);
    sleep(1) ;  
 }

    if ( $method === "GETNOT") {
        $out = getNotification($input->user_id);
        sleep(1) ;
    }




  echo json_encode($out) ;