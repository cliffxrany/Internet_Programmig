<!DOCTYPE html>
<html>
<head>
    <title>Photo Upload</title>
</head>
<body>
    <h1>Upload Photo</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="photo" accept="image/jpeg, image/png" required><br>
        <input type="text" name="caption" placeholder="Enter caption" required><br>
        <input type="submit" value="Upload">
    </form>
    <a href="browse.php">Browse Photos</a>
    <?php
    require_once "config.php";
    // Handle the photo upload
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $targetDir = "photos/";
        $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
        $caption = $_POST["caption"];

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png");

        if (in_array($imageFileType, $allowedExtensions)) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                // Save caption in the database
                $mysqli = new mysqli("localhost", "root", "toor", "db_CNS");
                $stmt = $mysqli->prepare("INSERT INTO photos (filename, caption) VALUES (?, ?)");
                $stmt->bind_param("ss", $targetFile, $caption);
                $stmt->execute();
                $stmt->close();
                $mysqli->close();
                echo "Photo uploaded successfully.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPEG and PNG files are allowed.";
        }
    }
    ?>
</body>
</html>
