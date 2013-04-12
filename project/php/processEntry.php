<?php
require("../../databaseAccess.php");
require("entryClass.php");

/**
 * Just some database interaction tests for my entry class
 */



$tableName = $_POST['tableName'];
$entryName = $_POST['entryName'];
$entryType = $_POST['entryType'];
$entryDesc = $_POST['entryDesc'];
$entryDate = $_POST['entryDate'];

print_r($_POST);

print_r($entryDate);

$newEntry = new \entry\entry($tableName, $entryName,$entryDate);
echo "<br>\n" . print_r($newEntry) .  "<br>\nT";
$test = $newEntry->getEntryName();
echo $test;
$newEntry->createEntryType($entryType);

print_r($newEntry);