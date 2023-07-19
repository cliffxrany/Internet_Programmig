<!DOCTYPE html>
<html>
<head>
    <title>Photo Browser...</title>
    <style>
        .image-container {
            text-align: center;
        }
        .image-container img {
            max-width: 500px;
            max-height: 500px;
        }
    </style>
</head>
<body>
    <h1>Photo Browser</h1>
    <div class="image-container">
        <?php
        // Retrieve a random photo from the database
        $mysqli = new mysqli("localhost", "root", "toor", "db_CNS");
        $result = $mysqli->query("SELECT * FROM photos ORDER BY RAND() LIMIT 1");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $filename = $row["filename"];
            $caption = $row["caption"];

            echo '<img src="' . $filename . '" alt="' . $caption . '">';
            echo '<p>' . $caption . '</p>';

            echo '<a href="delete.php?filename=' . urlencode($filename) . '">Delete</a>';
        } else {
            echo "No photos found.";
        }

        $result->close();
        $mysqli->close();
        ?>
    </div>

    <div>
        <a href="browse.php?prev=1">&lt;&lt; Previous</a>
        <a href="browse.php">&gt;&gt; Next</a>
    </div>

    <a href="upload.php">Upload Photo</a>
</body>
</html>