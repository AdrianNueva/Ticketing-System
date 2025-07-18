<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt the password using MD5

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('images/matatag.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #000;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: #fff;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);    
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
        }
        h2 {
            margin-bottom: 20px;
            color: #104481;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box; /* Ensures the padding and border are included in the element's total width and height */
        }
        .button {
            width: 100%;
            padding: 10px;
            background-color: #104481;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            display: inline-block; /* Ensures the buttons have the same sizing behavior */
            margin-bottom: 10px;
            cursor: pointer;
            box-sizing: border-box; /* Ensures the padding and border are included in the element's total width and height */
        }
        .back-button {
            width: 100%;
            padding: 8px;
            background-color: #104481;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: small;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            display: inline-block; /* Ensures the buttons have the same sizing behavior */
            margin-bottom: 10px;
            cursor: pointer;
            box-sizing: border-box;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        @media (max-width: 768px) {
            .button {
                width: 100%;
                font-size: 16px;
            }
            .logo {
                width: 200px;
                height: auto;
            }
            h1 {
                font-size: 22px;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="button">Login</button>
        </form>
        <a href="homepage.php" class="back-button">Back to Homepage</a>
    </div>
</body>
</html>
