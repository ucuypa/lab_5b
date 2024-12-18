<?php
session_start();

// Check session
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Page</title>
    <style>
        table {
            width: 70%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid blue;
            color: blue;
            border-radius: 3px;
            margin-right: 5px;
        }
        a.delete {
            color: red;
            border: 1px solid red;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">User Information</h2>
    <a href="logout.php" style="margin-left:20px;">Logout</a>
    <table>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $dbpassword = "";
        $dbname = "lab_5b";

        $conn = new mysqli($servername, $username, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT matric, name, role FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["matric"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["role"]) . "</td>";
                echo "<td>
                    <a href='update.php?matric=" . urlencode($row["matric"]) . "'>Update</a>
                    <a href='delete.php?matric=" . urlencode($row["matric"]) . "' class='delete' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
