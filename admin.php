<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('images/matatag.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #104481;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #104481;
            color: #fff;
        }


        /* Shared button styles */
        .button, .back-button, .update-button {
            padding: 10px 20px;  /* Uniform padding */
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;  /* Uniform font weight */
            font-size: 16px;    /* Uniform font size */
            display: inline-block;  /* Ensure inline-block for both */
        }

        /* Specific button colors */
        .back-button, .button {
            background-color: #206F3C;
        }

        .update-button {
            background-color: #104481;
        }

        /* Hover states */
        .button:hover, .back-button:hover, .update-button:hover {
            background-color: #0d3a6a;
        }

        /* Flexbox adjustment */
        .update-form {
            display: flex;
            justify-content: right;
            align-items: center;
            margin-top: 20px;
            gap: 10px;
        }
        select {
            padding: 5px;
            font-size: 14px;
        }

        /* Pagination */
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a {
            padding: 10px 20px;
            margin: 0 5px;
            background-color: #104481;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
        }
        .pagination a:hover {
            background-color: #0d3a6a;
        }
        .pagination .disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
    </style>
</head><body>
    <div class="container">
        <!-- Title and Statistics Button -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1 style="margin: 0; color: #104481;">Admin Dashboard</h1>
            <a href="statistics.php" style="
                padding: 10px 20px; 
                background-color: #206F3C; 
                color: #fff; 
                text-decoration: none; 
                border-radius: 5px; 
                font-weight: bold;
                transition: background-color 0.3s;">
                View Statistics
            </a>
        </div>

        <form action="update_status.php" method="post">

            <table>
                <tr>
                    <th>ID</th>
                    <th>Created At</th>
                    <th>Name</th>
                    <th>Type of Services</th>
                    <th>Service Details</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                    <th>Remarks</th>
                </tr>

                <?php
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $limit = 10;
                $offset = ($page - 1) * $limit;

                $total_result = $conn->query("SELECT COUNT(*) AS total FROM requests");
                $total_rows = $total_result->fetch_assoc()['total'];
                $total_pages = ceil($total_rows / $limit);

                $sql = "SELECT * FROM requests ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td>" . $row['user'] . "</td>";
                        echo "<td>" . $row['type_of_service'] . "</td>";
                        echo "<td>" . $row['service_details'] . "</td>";
                        echo "<td>
                            <form action='update_status.php' method='post'>
                                <select name='status[" . $row['id'] . "]' style='color: " . getColor($row['status']) . ";' onchange='this.style.color = this.options[this.selectedIndex].style.color;'>
                                    <option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . " style='color: orange;'>Pending</option>
                                    <option value='In Progress'" . ($row['status'] == 'In Progress' ? ' selected' : '') . " style='color: blue;'>In Progress</option>
                                    <option value='Completed'" . ($row['status'] == 'Completed' ? ' selected' : '') . " style='color: green;'>Completed</option>
                                    <option value='For RO Action'" . ($row['status'] == 'For RO Action' ? ' selected' : '') . " style='color: red;'>For RO Action</option>
                                    <option value='For CO Action'" . ($row['status'] == 'For CO Action' ? ' selected' : '') . " style='color: purple;'>For CO Action</option>
                                </select>
                                <button type='submit'>Update</button>
                            </form>
                        </td>";
                        echo "<td>" . $row['last_updated'] . "</td>";
                        echo "<td>
                            <textarea name='remarks[" . $row['id'] . "]' rows='5' cols='15'>" . (isset($row['remarks']) ? htmlspecialchars($row['remarks']) : '') . "</textarea>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No requests found</td></tr>";
                }

                function getColor($status) {
                    switch ($status) {
                        case 'Pending': return 'orange';
                        case 'In Progress': return 'blue';
                        case 'Completed': return 'green';
                        case 'For RO Action': return 'red';
                        case 'For CO Action': return 'purple';
                        default: return 'black';
                    }
                }
                ?>
            </table>

            <div class="update-form">
                <a href="homepage.php" class="back-button">Back to Homepage</a>
            </div>
        </form>

        <!-- Pagination controls -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">&#8592; Next</a>
            <?php else: ?>
                <a class="disabled">&#8592; Next</a>
            <?php endif; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>">Previous &#8594;</a>
            <?php else: ?>
                <a class="disabled">Previous &#8594;</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
