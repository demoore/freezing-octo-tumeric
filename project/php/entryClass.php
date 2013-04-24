<?php
/**
 * User: dylan
 * Date: 2013-04-11
 * Time: 3:56 PM
 */

namespace entry;

/**
 * Class entry
 * @package entry
 * @args    table name, entry name, entry date
 */

class entry {

    private $entryName;
    private $entryText;
    private $entryDate;
    private $entryStartTime;
    private $entryEndTime;
    private $entryType;
    private $entryID;
    private $userTableName;

    function __construct($inUserTableName, $inEntryName, $inEntryDate) {
        $this->userTableName = $inUserTableName;
        $this->entryName     = $inEntryName;


        $this->entryDate     = $this->transformDate($inEntryDate);

        $this->createEntry();
        $this->entryID = $this->getEntryID();

    }

    public function createEntry() {
        // Make the connection...
        $DBConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // ... and ensure it works
        if(mysqli_connect_errno($DBConnection)){
            echo "Failed to connect to the database: " . mysqli_connect_error();
            exit();
        }

        $entryQuery = "INSERT INTO $this->userTableName (entryName, entryDate)
                       VALUES (\"$this->entryName\", \"$this->entryDate\")";



        $DBConnection->query($entryQuery) or die(mysqli_error($DBConnection));
        $DBConnection->close();



    }

    public function createStartAndEndTime($entryStartTime, $entryEndTime) {
        // Make the connection...
        $DBConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // ... and ensure it works
        if(mysqli_connect_errno($DBConnection)){
            echo "Failed to connect to the database: " . mysqli_connect_error();
            exit();
        }


        $this->entryStartTime = $this->transformTime($entryStartTime);
        $this->entryEndTime   = $this->transformTime($entryEndTime);


        $entryQuery = "INSERT INTO $this->userTableName (entryStartTime, entryEndTime)
                       VALUES ($this->entryStartTime, $this->entryEndTime)";

        $DBConnection->query($entryQuery);
        $DBConnection->close();
    }

    public function createEntryType($entryType) {
        // Make the connection...
        $DBConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // ... and ensure it works
        if(mysqli_connect_errno($DBConnection)){
            echo "Failed to connect to the database: " . mysqli_connect_error();
            exit();
        }

        $this->entryType = $entryType;
        $entryTypeQuery = "UPDATE $this->userTableName
                           SET entryType = \"$this->entryType\"
                           WHERE entryID = $this->entryID";

        $DBConnection->query($entryTypeQuery) or die(mysqli_error($DBConnection));
        $DBConnection->close();

    }

    public function deleteEntry($inEntryToDelete) {
        // Make the connection...
        $DBConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // ... and ensure it works
        if(mysqli_connect_errno($DBConnection)){
            echo "Failed to connect to the database: " . mysqli_connect_error();
            exit();
        }


        $deleteQuery ="DELETE FROM $this->userTableName
                       WHERE entryID = $inEntryToDelete";

        $DBConnection->query($deleteQuery) or die(mysqli_error($DBConnection));
        $DBConnection->close();

    }

    public function moveEntryDate($newEntryDate) {
        // Make the connection...
        $DBConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // ... and ensure it works
        if(mysqli_connect_errno($DBConnection)){
            echo "Failed to connect to the database: " . mysqli_connect_error();
            exit();
        }

        $newDate = $this->transformDate($newEntryDate);

        $dateQuery = "UPDATE $this->userTableName
                      SET    entryDate = \"$newDate\"
                      WHERE  entryID   = $this->entryID";

        $DBConnection->query($dateQuery) or die (mysqli_error($DBConnection));
        $DBConnection->close();

    }

    public function getEntryID() {
        // Make the connection...
        $DBConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // ... and ensure it works
        if(mysqli_connect_errno($DBConnection)){
            echo "Failed to connect to the database: " . mysqli_connect_error();
            exit();
        }

        $entryIDQuery = "SELECT entryID FROM $this->userTableName
                         WHERE  entryDate = \"$this->entryDate\"
                         AND    entryName = \"$this->entryName\"";

        $userIDRow = $DBConnection->query($entryIDQuery) or die(mysqli_error($DBConnection));
        $userIDArray = mysqli_fetch_row($userIDRow) or die(mysqli_error($DBConnection));

        $userID = $userIDArray[0];

        $DBConnection->close();

        return $userID;
    }


    private function transformDate($inDate){
        //Some date processing
        $inDate = date ("Y-m-d", strtotime($inDate));
        return $inDate;
    }

    private function transformTime($inTime) {
        $inTime = date("HH:MM:SS". strtotime($inTime));
        return $inTime;

    }


    /*
     *  _______  _______  _______  _______  _______  ______    _______
     *|       ||       ||       ||       ||       ||    _ |  |       |
     *|    ___||    ___||_     _||_     _||    ___||   | ||  |  _____|
     *|   | __ |   |___   |   |    |   |  |   |___ |   |_||_ | |_____
     *|   ||  ||    ___|  |   |    |   |  |    ___||    __  ||_____  |
     *|   |_| ||   |___   |   |    |   |  |   |___ |   |  | | _____| |
     *|_______||_______|  |___|    |___|  |_______||___|  |_||_______|
     * _______  __    _  ______
     *|   _   ||  |  | ||      |
     *|  |_|  ||   |_| ||  _    |
     *|       ||       || | |   |
     *|       ||  _    || |_|   |
     *|   _   || | |   ||       |
     *|__| |__||_|  |__||______|
     * _______  _______  _______  _______  _______  ______    _______
     *|       ||       ||       ||       ||       ||    _ |  |       |
     *|  _____||    ___||_     _||_     _||    ___||   | ||  |  _____|
     *| |_____ |   |___   |   |    |   |  |   |___ |   |_||_ | |_____
     *|_____  ||    ___|  |   |    |   |  |    ___||    __  ||_____  |
     * _____| ||   |___   |   |    |   |  |   |___ |   |  | | _____| |
     *|_______||_______|  |___|    |___|  |_______||___|  |_||_______|
     */
    public function setEntryDate($entryDate)
    {
        $this->entryDate = $entryDate;
    }

    public function getEntryDate()
    {
        return $this->entryDate;
    }

    public function setEntryEndTime($entryEndTime)
    {
        $this->entryEndTime = $entryEndTime;
    }

    public function getEntryEndTime()
    {
        return $this->entryEndTime;
    }

    public function setEntryName($entryName)
    {
        $this->entryName = $entryName;
    }

    public function getEntryName()
    {
        return $this->entryName;
    }

    public function setEntryStartTime($entryStartTime)
    {
        $this->entryStartTime = $entryStartTime;
    }

    public function getEntryStartTime()
    {
        return $this->entryStartTime;
    }

    public function setEntryText($entryText)
    {
        $this->entryText = $entryText;
    }

    public function getEntryText()
    {
        return $this->entryText;
    }

    public function setEntryType($entryType)
    {
        $this->entryType = $entryType;
    }

    public function getEntryType()
    {
        return $this->entryType;
    }





}