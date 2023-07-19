<?php
// Database helper
    $servername = "localhost";
    $username = "root";
    $password = "toor";
    $dbname = "db_CNS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

//Read from database 
function dbReadDatabase($conn, $sql){
    $result = $conn->query($sql);
    return $result;
    // Close the database connection
    $conn->close();
}
//Write to database
function dbWriteDatabase($conn, $sql){
    $result = $conn->query($sql);
    return $result;
     // Close the database connection
    $conn->close();
}

?>