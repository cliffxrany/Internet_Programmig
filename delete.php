<?php
if (isset($_GET["filename"])) {
    $filename = $_GET["filename"];
    $mysqli = new mysqli("localhost", "root", "toor", "db_CNS");
    $stmt = $mysqli->prepare("DELETE FROM photos WHERE filename = ?");
    $stmt->bind_param("s", $filename);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    // Delete the file from the server
    if (file_exists($filename)) {
        unlink($filename);
    }

    header("Location: browse.php");
    exit;
} else {
    header("Location: browse.php");
    exit;
}
?>