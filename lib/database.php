<?php

function OpenCon()
{
   $dbhost = "localhost";
   $dbuser = "ibrlive";
   $dbpass = "tubelight";
   $db = "ibrMock";


   // $username = "ibrlive";
   // $password = "tubelight";
   // $dbname = "ibrMock";
   // $dbhost = "localhost";
   // $dbuser = "root";
   // $dbpass = "";
   // $db = "ibrMock";

   $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);


   return $conn;
}

function CloseCon($conn)
{
   $conn->close();
}
