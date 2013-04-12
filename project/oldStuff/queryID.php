<?php
/**
 * Just a test to make sure I'm getting the right results from the database
 */

require("../databaseAccess.php");

$DBcnct = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Ensure it works
if (mysqli_connect_errno($DBcnct)) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();
}
$email = "dylan.e.moore@gmail.com";

$tableNameQuery = "SELECT userID FROM users WHERE userEmail LIKE \"$email\"";

$userIDRow = $DBcnct->query($tableNameQuery);
print_r($userIDRow);
$userID = mysqli_fetch_row($userIDRow);
print_r($userID);

$firstName = "Dylan";
$userNameTable = $firstName . $userID[0] . "Table";
print_r($userNameTable);
