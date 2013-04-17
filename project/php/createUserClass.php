<?php
/**
 * User: Dylan
 * Description
 * This class is meant to be the interface between the database and
 * the user. It sets up a user in the 'users' table and creates a
 * personal table for that user. Easy-peasy.
 */
require("passwordCheck.php");
//require("../../databaseAccess.php");
class createUser
{

    private $email;
    private $password;
    private $firstName;
    private $userName;
    private $userID;
    private $tableName;

    public $message = "You fucked up Jim.";

    function __construct($inEmail, $inPassword, $inFirstName)
    {
        $this->email = $inEmail;
        $this->firstName = $inFirstName;
        $userNameArray = array();
        $this->tableName = "";


        $this->password = $inPassword;


        // create the user name from the userEmail
        $emailPattern = "/^.*?(?=@)/";
        preg_match($emailPattern, $this->email, $userNameArray);
        $this->userName = $userNameArray[0];

        $this->createUserEntry();
        $this->userID = $this->getUserID();
        $this->createUserTable();
        $this->setUserTableName();

    }


    /*
     *  _______  ______    _______  _______  _______  _______    __   __  _______  _______  ______
     *|       ||    _ |  |       ||   _   ||       ||       |  |  | |  ||       ||       ||    _ |
     *|       ||   | ||  |    ___||  |_|  ||_     _||    ___|  |  | |  ||  _____||    ___||   | ||
     *|       ||   |_||_ |   |___ |       |  |   |  |   |___   |  |_|  || |_____ |   |___ |   |_||_
     *|      _||    __  ||    ___||       |  |   |  |    ___|  |       ||_____  ||    ___||    __  |
     *|     |_ |   |  | ||   |___ |   _   |  |   |  |   |___   |       | _____| ||   |___ |   |  | |
     *|_______||___|  |_||_______||__| |__|  |___|  |_______|  |_______||_______||_______||___|  |_|
     */


    public function createUserEntry()
    {
        // Make the connection...
        $DBConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // ... and ensure it works
        if (mysqli_connect_errno($DBConnection)) {
            echo "Failed to connect to the database: " . mysqli_connect_error();
            exit();
        }

        // Set up our Query
        $userCreateQuery = "INSERT INTO users (userName, userEmail, userFirstName, userPassword)
                    VALUES (\"$this->userName\", \"$this->email\" ,\"$this->firstName\", \"$this->password\")";


        $DBConnection->query($userCreateQuery);
        $DBConnection->close();


    }

    /*
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


    public function createUserTable()
    {

        // Make the connection...
        $DBConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // ... and ensure it works
        if (mysqli_connect_errno($DBConnection)) {
            echo "Failed to connect to the database: " . mysqli_connect_error();
            exit();
        }

        $firstName = $this->firstName;
        $userID = $this->userID;
        $userNameTable = $firstName . $userID . "Table";
        $this->tableName = $userNameTable;

        $tableQuery = "CREATE TABLE $userNameTable (
                            entryID INT (15) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                            entryName VARCHAR(45) NOT NULL,
                            entryDesc VARCHAR(200),
                            entryType VARCHAR (45),
                            entryDate DATETIME NOT NULL
        )";


        $DBConnection->query($tableQuery) or die(mysqli_error($DBConnection));

        $DBConnection->close();


    }

    /*
     *  _______  _______  _______    __   __  _______  _______  ______
     *|       ||       ||       |  |  | |  ||       ||       ||    _ |
     *|  _____||    ___||_     _|  |  | |  ||  _____||    ___||   | ||
     *| |_____ |   |___   |   |    |  |_|  || |_____ |   |___ |   |_||_
     *|_____  ||    ___|  |   |    |       ||_____  ||    ___||    __  |
     * _____| ||   |___   |   |    |       | _____| ||   |___ |   |  | |
     *|_______||_______|  |___|    |_______||_______||_______||___|  |_|
     * _______  _______  _______  ___      _______    __    _  _______  __   __  _______
     *|       ||   _   ||  _    ||   |    |       |  |  |  | ||   _   ||  |_|  ||       |
     *|_     _||  |_|  || |_|   ||   |    |    ___|  |   |_| ||  |_|  ||       ||    ___|
     *  |   |  |       ||       ||   |    |   |___   |       ||       ||       ||   |___
     *  |   |  |       ||  _   | |   |___ |    ___|  |  _    ||       ||       ||    ___|
     *  |   |  |   _   || |_|   ||       ||   |___   | | |   ||   _   || ||_|| ||   |___
     *  |___|  |__| |__||_______||_______||_______|  |_|  |__||__| |__||_|   |_||_______|
     */
    public function setUserTableName()
    {

        // Make the connection...
        $DBConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // ... and ensure it works
        if (mysqli_connect_errno($DBConnection)) {
            echo "Failed to connect to the database: " . mysqli_connect_error();
            exit();
        }

        $tableNameQuery = "UPDATE users
                           SET userTable=\"$this->tableName\"
                           WHERE userID=$this->userID";

        $DBConnection->query($tableNameQuery) or die(mysqli_error($DBConnection));
        $DBConnection->close();
    }


    /**
     * @return userID
     */
    /*
     *    ____ _____ _____   _   _ ____  _____ ____    ___ ____
     *   / ___| ____|_   _| | | | / ___|| ____|  _ \  |_ _|  _ \
     *  | |  _|  _|   | |   | | | \___ \|  _| | |_) |  | || | | |
     *  | |_| | |___  | |   | |_| |___) | |___|  _ <   | || |_| |
     *   \____|_____| |_|    \___/|____/|_____|_| \_\ |___|____/
     */

    public function getUserID()
    {


        $DBConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Ensure it works
        if (mysqli_connect_errno($DBConnection)) {
            echo "Failed to connect to the database: " . mysqli_connect_error();
            exit();
        }

        $userIDQuery = "SELECT userID FROM users WHERE userEmail LIKE \"$this->email\"";

        $userIDRow = $DBConnection->query($userIDQuery) or die(mysqli_error($DBConnection));
        $userIDArray = mysqli_fetch_row($userIDRow) or die(mysqli_error($DBConnection));

        $userID = $userIDArray;

        $DBConnection->close();

        return $userID[0];
    }


}

