<!DOCTYPE html>
<html>
<head>
<title>PHP Web Page</title>
<link rel="stylesheet" type="text/css" href="Database_Read.css">
</head>
<body>
<h1>Welcome to the PHP Web Page</h1>
<?php
// PHP code starts here
$name = "Clifton";
$age = 19;
$city = "Nairobi";

// Displaying dynamic content using PHP variables
echo "<p>Name: $name</p>";
echo "<p>Age: $age</p>";
echo "<p>City: $city</p>";

// Performing a database query with PHP
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

// Execute a query
$sql = "SELECT * FROM `$dbname`.`users`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<h2>User List:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["name"] . " - " . $row["email"] . " - " . $row["message"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No users found.";
}
// Close the database connection
$conn->close();
?>
</body>
</html>
