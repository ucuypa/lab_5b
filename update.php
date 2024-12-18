<?php
session_start();

if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "lab_5b";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        die("Record not found.");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET name='$name', role='$role' WHERE matric='$matric'";
    if ($conn->query($sql) === TRUE) {
        header("Location: display.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <a href="display.php">Back</a>
    <form method="POST" action="update.php">
        <label>Matric:</label>
        <input type="text" name="matric" value="<?php echo htmlspecialchars($row['matric']); ?>" readonly><br>
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>
        <label>Role:</label>
        <select name="role" required>
            <option value="lecturer" <?php echo ($row['role'] == 'lecturer') ? 'selected' : ''; ?>>Lecturer</option>
            <option value="student" <?php echo ($row['role'] == 'student') ? 'selected' : ''; ?>>Student</option>
        </select><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
