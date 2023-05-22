<?php
$key1 = $_GET['key1'];
$key2 = $_GET['key2'];

// Process the data and prepare the response
$response = array('result' => 'success', 'message' => 'Data received');

// Send the response back to the client
header('Content-Type: application/json');
echo json_encode($response);

