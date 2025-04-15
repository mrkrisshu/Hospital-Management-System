<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "zappeysfc";
$database = "myhmsdb";

$con = new mysqli($host, $user, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $symptom = $_POST['symptom'];
    $severity = $_POST['severity'];
    $notes = $_POST['notes'];
    $date = date("Y-m-d");

    $stmt = $con->prepare("INSERT INTO symptoms_log (patient_id, symptom, severity, notes, log_date) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("issss", $patient_id, $symptom, $severity, $notes, $date);
        if ($stmt->execute()) {
            $message = "<p class='success'>✅ Symptom logged successfully.</p>";
        } else {
            $message = "<p class='error'>❌ Error logging symptom: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        $message = "<p class='error'>❌ Database error: " . $con->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Log Symptoms</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f1f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 500px;
            margin: 60px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #444;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            margin-top: 25px;
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Log Patient Symptoms</h2>
        <?php echo $message; ?>
        <form method="POST" action="">
            <label>Patient ID:</label>
            <input type="number" name="patient_id" required>

            <label>Symptom:</label>
            <input type="text" name="symptom" required>

            <label>Severity:</label>
            <select name="severity" required>
                <option value="Mild">Mild</option>
                <option value="Moderate">Moderate</option>
                <option value="Severe">Severe</option>
            </select>

            <label>Notes:</label>
            <textarea name="notes" rows="4" placeholder="Additional notes..."></textarea>

            <input type="submit" value="Log Symptom">
        </form>
    </div>
</body>
</html>
