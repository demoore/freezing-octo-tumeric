<?php
/**
 * User: dylan
 * Date: 2013-04-10
 * Time: 10:15 AM
 */

//require("../../databaseAccess.php");

/*
 * This functions creates the user in the database
 * It takes the following arguments
 * createUser( user email, user password, first name)
 *  _______  ______    _______  _______  _______  _______    __   __  _______  _______  ______
 *|       ||    _ |  |       ||   _   ||       ||       |  |  | |  ||       ||       ||    _ |
 *|       ||   | ||  |    ___||  |_|  ||_     _||    ___|  |  | |  ||  _____||    ___||   | ||
 *|       ||   |_||_ |   |___ |       |  |   |  |   |___   |  |_|  || |_____ |   |___ |   |_||_
 *|      _||    __  ||    ___||       |  |   |  |    ___|  |       ||_____  ||    ___||    __  |
 *|     |_ |   |  | ||   |___ |   _   |  |   |  |   |___   |       | _____| ||   |___ |   |  | |
 *|_______||___|  |_||_______||__| |__|  |___|  |_______|  |_______||_______||_______||___|  |_|
 */
function createUser($userEmail, $password, $firstName){
// make the connection
$createUser = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Ensure it works
if (mysqli_connect_errno($createUser)) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();
}


// Parse the email to make a proper table name and user entry
$emailPattern = "/^.*?(?=@)/";
preg_match($emailPattern,$userEmail,$parsedUserName);
print_r($parsedUserName);

$userCreateQuery = "INSERT INTO users (userName, userEmail, userFirstName, userPassword)
                    VALUES (\"$parsedUserName[0]\", \"$userEmail\" ,\"$firstName\", \"$password\")";




$createUser->query($userCreateQuery);

$createUser->close();

}
