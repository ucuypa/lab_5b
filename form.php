<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
</head>
<body>
    <form action="process.php" method="post">
        <label>Matric:</label>
        <input type="text" name="matric" required><br><br>

        <label>Name:</label>
        <input type="text" name="name" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <label>Role:</label>
        <select name="role" required>
            <option value="">Please select</option>
            <option value="lecturer">Lecturer</option>
            <option value="Student">Student</option>
        </select><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
