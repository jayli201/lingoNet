<?php

// only accept requests from angular url
// header('Access-Control-Allow-Origin: http://localhost:4200');

// all requests from everywhere
header('Access-Control-Allow-Origin: *');

// setup
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

// connect to friends_sql.php, which connects to db
require("friends_sql.php");

$pendingFriends = getPendingFriends($_SESSION['email']);
$incomingFriends = getIncomingFriends($_SESSION['email']);
$acceptedFriends = getAcceptedFriends($_SESSION['email']);

// retrieve data from the request
$postdata = file_get_contents("php://input");

// Process data
// (this example simply extracts the data and restructures them back)

// Extract json format to PHP array
$request = json_decode($postdata);
// $request = json_decode($pendingFriends);


$data = [];
foreach ($request as $k => $v) {
  $temp = "$k => $v";
  $data[0]['post_' . $k] = $v;
}
// $temp will have the last key-value pair of the array

$current_date = date("Y-m-d");
// Send response (in json format) back to the front end
echo json_encode(['content' => $data, 'response_on' => $current_date]);
