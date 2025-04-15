<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "zappeysfc", "myhmsdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Adjust this depending on your column name (log_date or created_at)
$sql = "SELECT DATE(created_at) as log_day, symptoms FROM daily_logs ORDER BY log_day ASC";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$symptomCounts = [];

while ($row = $result->fetch_assoc()) {
    $date = $row['log_day'];
    $symptomList = array_filter(array_map('trim', explode(",", $row['symptoms'])));
    $count = count($symptomList);

    if (!isset($symptomCounts[$date])) {
        $symptomCounts[$date] = 0;
    }
    $symptomCounts[$date] += $count;
}

$labels = json_encode(array_keys($symptomCounts));
$data = json_encode(array_values($symptomCounts));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Symptom Trends</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f3f6;
            padding: 40px;
        }
        .chart-container {
            width: 90%;
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
    </style>
</head>
<body>

<div class="chart-container">
    <h2>📈 Symptom Trends</h2>
    <canvas id="symptomChart"></canvas>
</div>

<script>
    const ctx = document.getElementById('symptomChart').getContext('2d');
    const symptomChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo $labels; ?>,
            datasets: [{
                label: 'Number of Symptoms Logged',
                data: <?php echo $data; ?>,
                backgroundColor: 'rgba(52, 152, 219, 0.2)',
                borderColor: 'rgba(41, 128, 185, 1)',
                borderWidth: 2,
                tension: 0.4,
                pointRadius: 4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Symptom Count'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                }
            }
        }
    });
</script>

</body>
</html>
