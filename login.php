<?php
session_start();
require_once 'config.php';

// User registration
if(isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email is already registered
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        echo "Email already registered. Please choose a different email.";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashedPassword);
    if($stmt->execute()) {
        echo "Registration successful. You can now log in.";
    } else {
        echo "Registration failed. Please try again.";
    }
    $stmt->close();
}

// User login
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve the user from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0) {
        echo "Invalid email or password.";
        exit;
    }

    // Verify the password
    $row = $result->fetch_assoc();
    if(password_verify($password, $row['password'])) {
        $_SESSION['email'] = $email;
        echo "Login successful. Welcome, $email!";
    } else {
        echo "Invalid email or password.";
    }
    $stmt->close();
}

// User logout
if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h1>User Login</h1>

    <?php if(isset($_SESSION['email'])) { ?>
        <p>You are already logged in as <?php echo $_SESSION['email']; ?>. <a href="?logout">Logout</a></p>
    <?php } else { ?>
        <form method="POST" action="">
            <label>Email:</label>
            <input type="email" name="email" required><br>

            <label>Password:</label>
            <input type="password" name="password" required><br>

            <input type="submit" name="login" value="Log in">
        </form>

        <h2>User Registration</h2>
        <form method="POST" action="">
            <label>Email:</label>
            <input type="email" name="email" required><br>

            <label>Password:</label>
            <input type="password" name="password" required minlength="6" pattern="^(?=.*\d).{6,}$"><br>

            <input type="submit" name="register" value="Register">
        </form>
    <?php } ?>

</body>
</html>