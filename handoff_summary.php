<?php
$conn = new mysqli("localhost", "root", "zappeysfc", "myhmsdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM rounds_log ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rounds Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f7;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            margin: auto;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background: #3498db;
            color: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }
        .print-btn {
            margin-top: 25px;
            background: #2ecc71;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            cursor: pointer;
        }
        .print-btn:hover {
            background: #27ae60;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🩺 Full Rounds Summary</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Vitals</th>
                <th>Symptoms</th>
                <th>Tasks</th>
                <th>Prescriptions</th>
                <th>Date & Time</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo nl2br(htmlspecialchars($row['vitals'])); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($row['symptoms'])); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($row['tasks'])); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($row['prescriptions'])); ?></td>
                    <td><?php echo date('M d, Y h:i A', strtotime($row['created_at'])); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <button class="print-btn" onclick="window.print()">🖨️ Print / Save PDF</button>
    <?php else: ?>
        <p>No rounds recorded yet.</p>
    <?php endif; ?>

</div>

</body>
</html>
