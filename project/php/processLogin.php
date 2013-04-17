<?php
/**
 * User: dylan
 * Date: 2013-04-17
 * Time: 12:10 PM
 */
require('../../databaseAccess.php');
// TODO SQL injection protection

// First we get the parameters
$userEmail = $_POST['loginForm'];
$password = $_POST['passwordForm'];

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
    echo "<pre>";
}

$queryResults->free();
$DBConnection->close();