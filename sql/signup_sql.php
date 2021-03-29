<?php
require("../db/connectdb.php");

function signUp($email, $password, $firstName, $lastName, $age, $phone)
{
    global $db;
    // add user into db
    $stamt = $db->prepare("INSERT INTO users(email, password, firstName, lastName, age, phone) VALUES (?, ?, ?, ?, ?, ?)");
    $stamt->bind_param("ssssii", $email, $password, $firstName, $lastName, $age, $phone);
    $stamt->execute();
    $stamt->close();
}
