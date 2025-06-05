<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "webtech_db";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: landing.php");
            exit();
        } else {
            $error = "❌ Incorrect password.";
        }
    } else {
        $error = "❌ No user found with this email.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background:rgb(243, 235, 235);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 2 4px 20px rgba(71, 63, 63, 0.1);
            width: 350px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 15px 0 5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 3px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: 0.3s ease;
        }

        input:focus {
            border-color:hsl(78, 67.70%, 75.70%);
            box-shadow: 0 0 5px rgba(0,123,255,0.5);
        }

        button {
            padding: 10px 15px;
            margin: 10px 5px 0 0;
            border: none;
            border-radius: 8px;
            background-color:rgb(222, 121, 212);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color:rgb(104, 137, 172);
        }

        button[type="reset"] {
            background-color:rgb(22, 118, 162);
        }

        .error-message {
            text-align: center;
            color: red;
            margin-bottom: 10px;
            font-weight: bold;
        }

        p {
            text-align: center;
            margin-top: 15px;
        }

        a {
            color:rgb(29, 33, 37);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h2>Login</h2>

        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />

        <div style="display: flex; justify-content: space-between;">
            <button type="reset">Reset</button>
            <button type="submit" name="submit">Login</button>
        </div>

        <p> <a href="register.php">Register here</a></p>
    </form>
</body>
</html>