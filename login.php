<?php
session_start();
$error = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "lab_5b";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch input values
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Validate user credentials
    $sql = "SELECT * FROM users WHERE matric='$matric' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['matric'] = $matric;
        header("Location: display.php"); // Redirect to the display page
        exit();
    } else {
        $error = "Invalid Matric or Password!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px auto;
            width: 300px;
            text-align: center;
        }
        form {
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 2px 2px 10px #aaa;
        }
        input, button {
            margin: 10px 0;
            padding: 8px;
            width: 90%;
        }
        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: blue;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <label>Matric:</label>
        <input type="text" name="matric" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
        <a href="form.php">Register Here</a>
    </form>
    <?php
    if ($error) {
        echo "<p class='error'>$error</p>";
    }
    ?>
</body>
</html>
