<?php
$conn = new mysqli("localhost", "root", "zappeysfc", "myhmsdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM rounds_log ORDER BY created_at DESC";
$result = $conn->query($sql);

// Keywords for smart alerts
$criticalSymptoms = ['chest pain', 'shortness of breath', 'high fever', 'severe headache'];
$suspectedADRs = ['rash', 'nausea', 'vomiting', 'swelling', 'dizziness', 'blurred vision'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Smart Alerts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            text-align: center;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            vertical-align: top;
            text-align: left;
        }
        th {
            background: #007BFF;
            color: white;
        }
        .alert-critical {
            background-color: #ffe0e0;
            border-left: 5px solid red;
        }
        .alert-adr {
            background-color: #fff4e5;
            border-left: 5px solid orange;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🧠 Smart Alerts — Critical Symptoms & Suspected ADRs</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Symptoms</th>
                <th>Prescriptions</th>
                <th>Detected Alert</th>
                <th>Date & Time</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()):
                $symptoms = strtolower($row['symptoms']);
                $prescriptions = strtolower($row['prescriptions']);
                $alertType = '';

                foreach ($criticalSymptoms as $crit) {
                    if (strpos($symptoms, $crit) !== false) {
                        $alertType = 'Critical Symptom Detected: ' . ucwords($crit);
                        break;
                    }
                }

                if ($alertType == '') {
                    foreach ($suspectedADRs as $adr) {
                        if (strpos($symptoms, $adr) !== false || strpos($prescriptions, $adr) !== false) {
                            $alertType = 'Suspected ADR: ' . ucwords($adr);
                            break;
                        }
                    }
                }

                $rowClass = '';
                if (str_contains($alertType, 'Critical')) $rowClass = 'alert-critical';
                elseif (str_contains($alertType, 'ADR')) $rowClass = 'alert-adr';
            ?>
                <tr class="<?php echo $rowClass; ?>">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['symptoms']); ?></td>
                    <td><?php echo htmlspecialchars($row['prescriptions']); ?></td>
                    <td><?php echo $alertType ?: '—'; ?></td>
                    <td><?php echo date('M d, Y h:i A', strtotime($row['created_at'])); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No entries found in the rounds log.</p>
    <?php endif; ?>
</div>

</body>
</html>
