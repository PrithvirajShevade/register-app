<!DOCTYPE html>
<html>
<head>
  <title>Insecure Registration</title>
</head>
<body>

<h1>Register Form (Buggy)</h1>

<form method="POST">
  <label for="name">Full Name:</label><br>
  <input type="text" id="name" name="name"><br><br>

  <label for="email">Email Address:</label><br>
  <input type="text" id="email" name="email"><br><br>

  <label for="password">Password:</label><br>
  <input type="text" id="password" name="password"><br><br> <!-- ❌ should be type="password" -->

  <input type="submit" name="submit" value="Register">
</form>

<?php
// 🚨 Insecure, for scanning purpose only
if (isset($_POST['submit'])) {
    $name = $_POST['name'];           // ❌ No validation
    $email = $_POST['email'];         // ❌ No sanitization
    $password = $_POST['password'];   // ❌ Stored in plain text

    // ❌ Hardcoded DB credentials (security risk)
    $conn = new mysqli("localhost", "root", "", "test");

    // ❌ Vulnerable to SQL Injection
    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($query) === TRUE) {
        echo "<h2>Registration Successful!</h2>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

</body>
</html>
