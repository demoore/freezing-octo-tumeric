<?php
require("../../databaseAccess.php");
require("createUserClass.php");

/**
 * This is php file is just for HTML interaction.
 * It requires three arguments from an HTML form (POST method)
 * "userEmail", "password", "firstName"
 *
 */

// TODO add some regex to strip everything for security

// Information from the form
$userEmail = $_POST['userEmail'];
$firstName = $_POST['firstName'];
$password = $_POST['password'];
$rePassword = $_POST['rePassword'];


$user = new createUser($userEmail, $password, $firstName);

//This is just for debug information, we'll remove it when we're done.
print_r($user);