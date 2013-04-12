<?php
require("../../databaseAccess.php");
require("createUserClass.php");

/**
 * This is php file is just for HTML interaction.
 * It requires three arguments from an HTML form (POST method)
 * "userEmail", "password", "firstName"
 *
 */

// Information from the form
$userEmail = $_POST['userEmail'];
$password  = $_POST['password'];
$firstName = $_POST['firstName'];



$user = new createUser($userEmail,$password,$firstName);

//This is just for debug information, we'll remove it when we're done.
print_r($user);