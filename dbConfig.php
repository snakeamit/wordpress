<?php
//DB details
$dbHost = 'localhost';
$dbUsername = 'ibrlive';
$dbPassword = 'tubelight';
$dbName = 'ibrMock';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
}