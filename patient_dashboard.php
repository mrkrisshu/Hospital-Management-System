<?php
$conn = new mysqli("localhost", "root", "zappeysfc", "myhmsdb");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$patient_id = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $symptoms = $_POST['symptoms'];
    $medications = $_POST['medications'];
    $stmt = $conn->prepare("INSERT INTO daily_logs (patient_id, symptoms, medications) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $patient_id, $symptoms, $medications);
    $stmt->execute();
}

$logs = $conn->query("SELECT * FROM daily_logs WHERE patient_id = $patient_id ORDER BY created_at ASC");

$symptom_data = [];
$date_labels = [];
$adr_alerts = [];
$adr_trend_counts = [];

$adr_rules = [
    'paracetamol' => ['rash', 'nausea'],
    'aspirin' => ['bleeding', 'ulcer'],
    'ibuprofen' => ['stomach pain', 'dizziness'],
    'amoxicillin' => ['diarrhea', 'rash']
];

while ($row = $logs->fetch_assoc()) {
    $date = date('Y-m-d', strtotime($row['created_at']));
    $date_labels[] = $date;
    $symptom_count = count(explode(",", $row['symptoms']));
    $symptom_data[] = $symptom_count;

    $symptoms = array_map('trim', explode(",", strtolower($row['symptoms'])));
    $medications = array_map('trim', explode(",", strtolower($row['medications'])));

    foreach ($medications as $med) {
        if (isset($adr_rules[$med])) {
            foreach ($adr_rules[$med] as $side_effect) {
                if (in_array($side_effect, $symptoms)) {
                    $adr_alerts[] = "⚠️ ADR detected: '$side_effect' due to '$med' on $date";
                    $adr_trend_counts[$side_effect][$date] = isset($adr_trend_counts[$side_effect][$date]) ? $adr_trend_counts[$side_effect][$date] + 1 : 1;
                }
            }
        }
    }
}

$date_labels = array_values(array_unique($date_labels));
$adr_datasets = [];

foreach ($adr_trend_counts as $effect => $daywise) {
    $data = [];
    foreach ($date_labels as $d) {
        $data[] = $daywise[$d] ?? 0;
    }
    $adr_datasets[] = [
        'label' => ucfirst($effect),
        'data' => $data,
        'borderColor' => '#' . substr(md5($effect), 0, 6),
        'fill' => false,
        'tension' => 0.3
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Smart Care Assistant - Patient Panel</title>
    <style>
        body { font-family: Arial; background: #eef2f3; margin: 0; padding: 20px; }
        .container { background: white; padding: 30px; max-width: 1000px; margin: auto; border-radius: 12px; box-shadow: 0 3px 15px rgba(0,0,0,0.1); }
        h2, h3 { color: #2c3e50; text-align: center; }
        textarea, button { width: 100%; padding: 10px; margin-bottom: 20px; border-radius: 6px; border: 1px solid #ccc; }
        button { background: #3498db; color: white; cursor: pointer; }
        button:hover { background: #2980b9; }
        .alert { background: #ffe6e6; border-left: 6px solid red; padding: 10px; margin: 15px 0; border-radius: 6px; }
        canvas { margin-top: 30px; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">
    <h2>🩺 Daily Symptom & Medication Log</h2>
    <form method="POST">
        <label>Symptoms (comma separated):</label>
        <textarea name="symptoms" required></textarea>
        <label>Medications (comma separated):</label>
        <textarea name="medications" required></textarea>
        <button type="submit">Submit</button>
    </form>

    <h3>📊 Symptom Trends Over Time</h3>
    <canvas id="symptomChart" height="100"></canvas>

    <?php if (!empty($adr_alerts)): ?>
        <h3>🚨 ADR Alerts</h3>
        <?php foreach ($adr_alerts as $alert): ?>
            <div class="alert"><?php echo htmlspecialchars($alert); ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($adr_datasets)): ?>
        <h3>📈 ADR Trend Chart</h3>
        <canvas id="adrChart" height="100"></canvas>
    <?php endif; ?>
</div>

<script>
const ctx1 = document.getElementById('symptomChart').getContext('2d');
new Chart(ctx1, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($date_labels); ?>,
        datasets: [{
            label: 'Symptoms Count',
            data: <?php echo json_encode($symptom_data); ?>,
            borderColor: '#2ecc71',
            backgroundColor: 'rgba(46, 204, 113, 0.2)',
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});

<?php if (!empty($adr_datasets)): ?>
const ctx2 = document.getElementById('adrChart').getContext('2d');
new Chart(ctx2, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($date_labels); ?>,
        datasets: <?php echo json_encode($adr_datasets); ?>
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } },
        scales: { y: { beginAtZero: true } }
    }
});
<?php endif; ?>
</script>

</body>
</html>
