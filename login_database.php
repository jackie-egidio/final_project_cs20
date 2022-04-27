<?php
    // DATABASE ACCESS
    $server = "localhost"; // your server
    $userid = "ugutmktwtgbzx"; // your user id
    $pw = "|dt1f3%|8#Jr"; // your pw
    $db= "dbgjk5twgel6hd"; // your database

    $mysqli = new mysqli($server, $userid, $pw, $db);

    // Create connection
    $conn = new mysqli($server, $userid, $pw);

    // Select the database
    $conn->select_db($db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $mysqli;
?>
