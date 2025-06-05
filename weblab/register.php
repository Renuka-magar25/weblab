<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "webtech_db";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "<p style='color:green; text-align:center;'>✅ Registration successful!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background:rgb(219, 171, 211);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 110vh;
        }

        form {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(25, 20, 20, 0.1);
            width: 360px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 12px 0 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: 0.3s ease;
        }

        input:focus {
            border-color:rgb(165, 177, 191);
            box-shadow: 0 0 5px rgba(82, 135, 157, 0.5);
        }

        button {
            padding: 10px 15px;
            margin: 10px 5px 0 0;
            border: none;
            border-radius: 8px;
            background-color:rgb(94, 162, 126);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color:rgb(101, 110, 121);
        }

        button[type="reset"] {
            background-color:rgb(245, 12, 20);
        }

        p {
            text-align: center;
            margin-top: 15px;
        }

        a {
            color:rgb(56, 59, 62);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h2>Register</h2>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />

        <div style="display: flex; justify-content: space-between;">
            <button type="reset">Reset</button>
            <button type="submit" name="submit">Register</button>
        </div>

        <p> <a href="login.php">Login here</a></p>
    </form>
</body>
</html>