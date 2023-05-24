<?php
//var_dump($_GET);

//header('Content-Type: application/json');
require_once "./Login-Register/userdb.php";


if(isset($_GET)){
    $text=$_GET["afilter"];
    $filter=$_GET["filter_type"];

    // Process the data and prepare the response
    $q="select * from users where ".$filter." like '%".$text."%' ";
    //var_dump($q);
    $stmt = $db->prepare($q) ;
    $stmt->execute();
    $result= $stmt->fetchAll() ;

    //var_dump($result);
    // Send the response back to the client

    echo json_encode($result);
}

