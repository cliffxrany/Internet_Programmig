<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the long URL from the form
    $longUrl = $_POST['longUrl'];

    // Generate a unique short code
    $shortCode = generateShortCode();

    // Create the short URL
    $shortUrl = 'http://192.168.198.129/' . $shortCode;

    // Store the URL in the database
    storeUrl($longUrl, $shortCode);

    // Display the shortened URL to the user
    echo "Shortened URL: <a href='$shortUrl'>$shortUrl</a>";
}

// Function to generate a unique short code for the URL
function generateShortCode($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

// Function to store the long URL and short code in the database
function storeUrl($longUrl, $shortCode) {
    $conn = mysqli_connect('localhost', 'root', 'toor', 'db_CNS');

    // Check if the connection was successful
    if (!$conn) {
        die('Database connection failed: ' . mysqli_connect_error());
    }

    // Escape the input to prevent SQL injection
    $longUrl = mysqli_real_escape_string($conn, $longUrl);
    $shortCode = mysqli_real_escape_string($conn, $shortCode);

    // Insert the URL into the database
    $query = "INSERT INTO urls (long_url, short_code) VALUES ('$longUrl', '$shortCode')";
    mysqli_query($conn, $query);

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>URL Shortener</title>
</head>
<body>
    <h1>URL Shortener</h1>
    <form method="POST" action="url.php">
        <label for="longUrl">Long URL:</label>
        <input type="text" name="longUrl" id="longUrl" required>
        <br>
        <input type="submit" name="submit" value="Shorten URL">
    </form>
</body>
</html>