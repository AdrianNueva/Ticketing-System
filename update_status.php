<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['status'] as $id => $status) {
        $id = intval($id); // Ensure the ID is an integer
        $status = $conn->real_escape_string($status); // Escape the status to prevent SQL injection
        $remarks = isset($_POST['remarks'][$id]) ? $conn->real_escape_string($_POST['remarks'][$id]) : ''; // Escape the remarks

        // Update both status and remarks
        $sql = "UPDATE requests SET status='$status', remarks='$remarks' WHERE id=$id";

        if (!$conn->query($sql)) {
            echo "Error updating request ID $id: " . $conn->error . "<br>";
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Update</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('images/matatag.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 90%;
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #104481;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .back-button {
            padding: 10px 20px;
            background-color: #206F3C;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            display: inline-block;
        }
        .back-button:hover {
            background-color: #0d3a6a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Status Update</h1>
        <p>All request statuses updated successfully.</p>
        <a href="admin.php" class="back-button">Go back to Dashboard</a>
    </div>
</body>
</html>
