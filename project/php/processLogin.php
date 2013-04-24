<?php
/**
 * User: dylan
 * Date: 2013-04-17
 * Time: 12:10 PM
 */

/**
 * User: Gus
 * Date: 2013-04-21
 * Time: 9:43 PM
 */


//Set the time to 3600
$time = 3600;
// Set the session name, id , time + time integer value
setcookie(session_name(), session_id(), time() + $time);
session_start();
require('../../databaseAccess.php');


// TODO SQL injection protection
// Check if the user has already logged in
if (isset($_SESSION['loginForm'], $_SESSION['passwordForm'])) {

    $userEmail = $_SESSION['loginForm'];
    $password = $_SESSION['passwordForm'];
    echo "<a href='logout.php'>Logout</a>";
} else {
// First we get the parameters

    $userEmail = $_POST['loginForm'];
    $password = $_POST['passwordForm'];
    $_SESSION['loginForm'] = $userEmail;
    $_SESSION['passwordForm'] = $password;

}

// This query will return all the data, we may just have to change
// the scope to the table name we're trying to access
$userQuery = "SELECT * FROM users WHERE
              userEmail = \"$userEmail\" AND userPassword = \"$password\"";

// Make the connection...
$DBConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// ... and ensure it works
if (mysqli_connect_errno($DBConnection)) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();

}
/*
$queryResults = $DBConnection->query($userQuery) or die(mysqli_error($DBConnection));

if ($queryResults->num_rows == 1) {
    $row = $queryResults->fetch_object();
    echo "<pre>";
    print_r($queryResults);
    echo $row->userName;
    echo "\n";
    echo $row->userTable;
    echo "</pre>";
	
} else {
    //echo "<pre>";
	 //If username or password does not exist or is incorrect then return to login page
	 echo "login or password is incorrect";
	 header("location:\project/project/php/logout.php"); 
}

$queryResults->free();
$DBConnection->close();



*/
