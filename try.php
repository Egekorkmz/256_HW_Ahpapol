<?php
//header('Content-Type: application/json');
require_once "./Login-Register/userdb.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $text=$_GET["afilter"];
    $filter=$_GET["filter_type"];

    // Process the data and prepare the response
    $q="select * from users where ".$filter." like '%".$text."%' ";
    //var_dump($q);
    $stmt = $db->prepare($q) ;
    $stmt->execute();
    $result= $stmt->fetchAll() ;
    
    // Send the response back to the client
    echo json_encode($result);
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    $friend_id= (int)$_POST["friend_id"];
    $user_id=(int)$_SESSION["user"]["user_id"];

    $sql = "insert into requests (reciever_id,sender_id) values (?,?)" ;
    $stmt = $db->prepare($sql) ;
    $stmt->execute([$friend_id,$user_id]) ;
   
    echo "".$friend_id." ".$user_id;


    exit;
}

