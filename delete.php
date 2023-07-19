<?php
require_once "config.php";

if (isset($_GET['id'])) {
    $photoId = $_GET['id'];

    // Retrieve photo details
    $stmt = $conn->prepare("SELECT filename FROM photos WHERE id = ?");
    $stmt->bind_param("i", $photoId);
    $stmt->execute();
    $stmt->bind_result($filename);
    $stmt->fetch();
    $stmt->close();

    // Delete photo from database
    $stmt = $conn->prepare("DELETE FROM photos WHERE id = ?");
    $stmt->bind_param("i", $photoId);
    $stmt->execute();
    $stmt->close();

    // Delete photo file from the server
    if (unlink($filename)) {
        echo "Photo deleted successfully.";
    } else {
        echo "Failed to delete the photo.";
    }
}