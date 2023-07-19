<!DOCTYPE html>
<html>
    <head>
        <title>PHP Form Handling</title>
<link rel="stylesheet" type="text/css" href="Database_Write.css">

    </head>

    <body>
        <h1>PHP Form Handling</h1>
        <?php
        if(!isset($_POST['submit'])){
            ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required><br><br>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required><br><br>

                <label for="message">Message:</label><br>
                <textarea name="message" id="message" rows="5" cols="30"></textarea><br><br>

                <input type="submit" name="submit" value="Submit">
            </form>
            <?php
        } else {
            // Retrieve form data
            $name = $_POST["name"];
            $email = $_POST["email"];
            $message = $_POST["message"];

            // Display submitted data
            echo "<h2>Form Submission Successful</h2>";
            echo "<p>Name: Your name is $name</p>";
            echo "<p>Email: Your email is $email</p>";
            echo "<p>Message: You said $message</p>";
            echo "<p>==================================================</p>";

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

            $userName =  mysqli_real_escape_string($conn, trim($name));
            $emailAddress = mysqli_real_escape_string($conn, trim($email));
            $message = mysqli_real_escape_string($conn, trim($message));

            // Execute a query
            $sql = "INSERT INTO `$dbname`.`users` (`name`,`email`,`message`) VALUES ('$userName','$emailAddress','$message')";
            $writeResult = $conn->query($sql);

            // Close the database connection
            $conn->close();
        }
        ?>
    </body>
</html>
