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

$incomingFriends = getIncomingFriends($_GET['email']);
