<?php
  header("Content-Type: application/json") ;
  require "userdb.php" ;

  $method = $_SERVER["REQUEST_METHOD"] ;
  
  $json = file_get_contents('php://input'); 
  $input = json_decode($json) ;  

  if ( $method === "GET") {
     $out = getPosts($input->user_id, $input->post_number) ;
     sleep(1) ;  
  }