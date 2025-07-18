<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Service Statistics</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h1 { color: #104481; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #104481; color: #fff; }
        a { text-decoration: none; color: #104481; font-weight: bold; }
        .section { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; }
        .table-container { width: 60%; }
        .chart-container { width: 450px; height: 450px; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h1>Service Request Statistics</h1>

<?php
// --- TYPE OF SERVICE ---
$sql = "SELECT type_of_service, COUNT(*) as count FROM requests GROUP BY type_of_service";
$result = $conn->query($sql);

$type_labels = [];
$type_data = [];

echo "<div class='section'>";
echo "<div class='table-container'>";
echo "<h2>Type of Service</h2>";
echo "<table><tr><th>Type of Service</th><th>Count</th></tr>";

while($row = $result->fetch_assoc()) {
    $type_labels[] = $row['type_of_service'];
    $type_data[] = $row['count'];
    echo "<tr><td>" . $row['type_of_service'] . "</td><td>" . $row['count'] . "</td></tr>";
}
echo "</table>";
echo "</div>";

echo "<div class='chart-container'><canvas id='typeChart'></canvas></div>";
echo "</div>";

// --- ICT TECHNICAL ASSISTANCE ---
$sql = "SELECT TRIM(SUBSTRING_INDEX(service_details, '|', 1)) AS main_service, COUNT(*) AS count 
        FROM requests 
        WHERE type_of_service = 'ICT' 
        GROUP BY main_service";
$result = $conn->query($sql);

$ict_labels = [];
$ict_data = [];

echo "<div class='section'>";
echo "<div class='table-container'>";
echo "<h2>ICT Technical Assistance Breakdown</h2>";
echo "<table><tr><th>ICT Service</th><th>Count</th></tr>";

while($row = $result->fetch_assoc()) {
    $ict_labels[] = $row['main_service'];
    $ict_data[] = $row['count'];
    echo "<tr><td>" . $row['main_service'] . "</td><td>" . $row['count'] . "</td></tr>";
}
echo "</table>";
echo "</div>";

echo "<div class='chart-container'><canvas id='ictChart'></canvas></div>";
echo "</div>";

// --- EMAIL CREATION ---
$sql = "SELECT TRIM(SUBSTRING_INDEX(service_details, '|', 1)) AS main_service, COUNT(*) AS count 
        FROM requests 
        WHERE type_of_service = 'Email Creation' 
        GROUP BY main_service";
$result = $conn->query($sql);

$email_create_labels = [];
$email_create_data = [];

echo "<div class='section'>";
echo "<div class='table-container'>";
echo "<h2>DepED Email Creation Breakdown</h2>";
echo "<table><tr><th>Email Provider</th><th>Count</th></tr>";

while($row = $result->fetch_assoc()) {
    $email_create_labels[] = $row['main_service'];
    $email_create_data[] = $row['count'];
    echo "<tr><td>" . $row['main_service'] . "</td><td>" . $row['count'] . "</td></tr>";
}
echo "</table>";
echo "</div>";

echo "<div class='chart-container'><canvas id='emailCreationChart'></canvas></div>";
echo "</div>";

// --- EMAIL RESET ---
$sql = "SELECT TRIM(SUBSTRING_INDEX(service_details, '|', 1)) AS main_service, COUNT(*) AS count 
        FROM requests 
        WHERE type_of_service = 'Email Reset' 
        GROUP BY main_service";
$result = $conn->query($sql);

$email_reset_labels = [];
$email_reset_data = [];

echo "<div class='section'>";
echo "<div class='table-container'>";
echo "<h2>DepED Email Reset Breakdown</h2>";
echo "<table><tr><th>Account Type</th><th>Count</th></tr>";

while($row = $result->fetch_assoc()) {
    $email_reset_labels[] = $row['main_service'];
    $email_reset_data[] = $row['count'];
    echo "<tr><td>" . $row['main_service'] . "</td><td>" . $row['count'] . "</td></tr>";
}
echo "</table>";
echo "</div>";

echo "<div class='chart-container'><canvas id='emailResetChart'></canvas></div>";
echo "</div>";

$conn->close();
?>

<script>
// Reusable chart function
function createPieChart(canvasId, labels, data, title) {
    new Chart(document.getElementById(canvasId), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: [
                    '#104481', '#206F3C', '#F39C12', '#E74C3C', '#8E44AD', '#1ABC9C', '#2C3E50'
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                title: { display: true, text: title },
                legend: { position: 'bottom' }
            }
        }
    });
}

// Initialize charts
createPieChart('typeChart', <?php echo json_encode($type_labels); ?>, <?php echo json_encode($type_data); ?>, 'Service Types');
createPieChart('ictChart', <?php echo json_encode($ict_labels); ?>, <?php echo json_encode($ict_data); ?>, 'ICT Technical Assistance');
createPieChart('emailCreationChart', <?php echo json_encode($email_create_labels); ?>, <?php echo json_encode($email_create_data); ?>, 'Email Creation');
createPieChart('emailResetChart', <?php echo json_encode($email_reset_labels); ?>, <?php echo json_encode($email_reset_data); ?>, 'Email Reset');

</script>

<a href="admin.php">← Back to Admin Dashboard</a>

</body>
</html>
