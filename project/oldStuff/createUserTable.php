<?php

/**
 * User: dylan
 * Date: 2013-04-10
 * Time: 10:15 AM
 */

//require("../../databaseAccess.php");

/*
 * This section will set up the user's personal table
 *
 *  _______  ______    _______  _______  _______  _______    __   __  _______  _______  ______
 *|       ||    _ |  |       ||   _   ||       ||       |  |  | |  ||       ||       ||    _ |
 *|       ||   | ||  |    ___||  |_|  ||_     _||    ___|  |  | |  ||  _____||    ___||   | ||
 *|       ||   |_||_ |   |___ |       |  |   |  |   |___   |  |_|  || |_____ |   |___ |   |_||_
 *|      _||    __  ||    ___||       |  |   |  |    ___|  |       ||_____  ||    ___||    __  |
 *|     |_ |   |  | ||   |___ |   _   |  |   |  |   |___   |       | _____| ||   |___ |   |  | |
 *|_______||___|  |_||_______||__| |__|  |___|  |_______|  |_______||_______||_______||___|  |_|
 * _______  _______  _______  ___      _______
 *|       ||   _   ||  _    ||   |    |       |
 *|_     _||  |_|  || |_|   ||   |    |    ___|
 *  |   |  |       ||       ||   |    |   |___
 *  |   |  |       ||  _   | |   |___ |    ___|
 *  |   |  |   _   || |_|   ||       ||   |___
 *  |___|  |__| |__||_______||_______||_______|
 *
 *
 */


// make the connection
$createUserTable = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


// Ensure it works
if (mysqli_connect_errno($createUserTable)) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();
}


$tableNameQuery = "SELECT userID FROM users WHERE userEmail LIKE \"$userEmail\"";

$userIDRow = $createUserTable->query($tableNameQuery);
print_r($userID);
$userID = mysqli_fetch_row($userIDRow);
printr("<br>\n" . $userID);

$userNameTable = $firstName . $userID . "Table";
print_r($userNameTable);

$tableQuery = "CREATE TABLE $userNameTable (
                            userID INT(15) PRIMARY KEY NOT NULL,
                            entryID INT (15) NOT NULL,
                            entryName VARCHAR(45) NOT NULL,
                            entryDesc VARCHAR(200),
                            entryType VARCHAR (45),
                            entryDate DATETIME NOT NULL
)";




$createUserTable->query($tableQuery);

$createUserTable->close();