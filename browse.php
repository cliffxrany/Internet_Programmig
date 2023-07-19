<!DOCTYPE html>
<html>
<head>
    <title>Browse Photos</title>
</head>
<body>
    <h1>Browse Photos</h1>
    <!-- Link to upload photos -->
    <a href="upload.php">Upload Photos</a>
    <br><br>
    <?php
    require_once "config.php";

    // Retrieve photos from the database
    $sql = "SELECT id, filename, caption FROM photos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $photos = $result->fetch_all(MYSQLI_ASSOC);
        ?>
        <div>
            <!-- Display photo -->
            <img id="photo" src="<?php echo $photos[0]['filename']; ?>" width="500" height="300" alt="Photo">
            <br>
            <!-- Display caption -->
            <div id="caption"><?php echo $photos[0]['caption']; ?></div>
            <br>
            <!-- Buttons for navigating and deleting photos -->
            <button onclick="previousPhoto()">Previous</button>
            <button onclick="nextPhoto()">Next</button>
            <button onclick="deletePhoto()">Delete</button>
        </div>

        <script>
        var currentIndex = 0;
        var photos = <?php echo json_encode($photos); ?>;

        // Function to show a specific photo
        function showPhoto(index) {
            document.getElementById("photo").src = photos[index]['filename'];
            document.getElementById("caption").innerHTML = photos[index]['caption'];
            currentIndex = index;
        }

        // Function to show the previous photo
        function previousPhoto() {
            if (currentIndex > 0) {
                showPhoto(currentIndex - 1);
            }
        }

        // Function to show the next photo
        function nextPhoto() {
            if (currentIndex < photos.length - 1) {
                showPhoto(currentIndex + 1);
            }
        }

        // Function to delete the current photo
        function deletePhoto() {
            var photoId = photos[currentIndex]['id'];
            if (confirm("Are you sure you want to delete this photo?")) {
                window.location.href = "delete.php?id=" + photoId;
            }
        }

        // Show the initial photo
        showPhoto(currentIndex);
        </script>
        <?php
    } else {
        echo "No photos found.";
    }
    ?>
</body>
</html>