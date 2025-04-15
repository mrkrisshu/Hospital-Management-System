<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vitals = $_POST['vitals'];
    $symptoms = $_POST['symptoms'];
    $tasks = $_POST['tasks'];
    $prescriptions = $_POST['prescriptions'];

    $conn = new mysqli("localhost", "root", "zappeysfc", "myhmsdb");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    // Create table if not exists
    $conn->query("CREATE TABLE IF NOT EXISTS rounds_log (
        id INT AUTO_INCREMENT PRIMARY KEY,
        vitals TEXT,
        symptoms TEXT,
        tasks TEXT,
        prescriptions TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $stmt = $conn->prepare("INSERT INTO rounds_log (vitals, symptoms, tasks, prescriptions) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $vitals, $symptoms, $tasks, $prescriptions);

    $msg = $stmt->execute() ? "✅ Round entry saved successfully." : "❌ Error: " . $stmt->error;

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Rounds Entry</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f8; padding: 30px; }
        .container { max-width: 700px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); }
        h2 { color: #333; margin-bottom: 20px; }
        textarea { width: 100%; height: 100px; font-size: 15px; padding: 10px; margin-bottom: 12px; border-radius: 8px; border: 1px solid #ccc; resize: vertical; }
        button, input[type=submit] {
            padding: 10px 14px;
            background: #3498db;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 5px;
            margin-bottom: 20px;
        }
        button:hover, input[type=submit]:hover { background: #2980b9; }
        label { font-weight: bold; display: block; margin-top: 15px; }
        .message { font-weight: bold; color: green; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Doctor Rounds Entry</h2>
    <?php if (isset($msg)) echo "<div class='message'>$msg</div>"; ?>

    <form method="post">
        <label for="vitals">Vitals:</label>
        <textarea name="vitals" id="vitals" placeholder="e.g., BP: 120/80, Temp: 98.6..."></textarea>
        <button type="button" onclick="startDictation('vitals')">🎤 Speak</button>

        <label for="symptoms">Symptoms:</label>
        <textarea name="symptoms" id="symptoms" placeholder="e.g., Headache, nausea, weakness..."></textarea>
        <button type="button" onclick="startDictation('symptoms')">🎤 Speak</button>

        <label for="tasks">Tasks / Actions:</label>
        <textarea name="tasks" id="tasks" placeholder="e.g., Blood test, MRI scan, monitor sugar levels..."></textarea>
        <button type="button" onclick="startDictation('tasks')">🎤 Speak</button>

        <label for="prescriptions">Prescriptions:</label>
        <textarea name="prescriptions" id="prescriptions" placeholder="e.g., Paracetamol 500mg twice daily..."></textarea>
        <button type="button" onclick="startDictation('prescriptions')">🎤 Speak</button>

        <input type="submit" value="Save Round Entry">
    </form>
</div>

<script>
function startDictation(id) {
    if (!('webkitSpeechRecognition' in window)) {
        alert("⚠️ Speech recognition not supported. Please use Google Chrome.");
        return;
    }

    try {
        const recognition = new webkitSpeechRecognition();
        recognition.lang = 'en-US';
        recognition.continuous = false;
        recognition.interimResults = false;

        recognition.onresult = function(event) {
            const result = event.results[0][0].transcript;
            document.getElementById(id).value += result + " ";
        };

        recognition.onerror = function(event) {
            console.error("Speech Recognition Error:", event.error);
            if (event.error === 'network') {
                alert("⚠️ Network error: Please check your internet connection and use Chrome.");
            } else if (event.error === 'not-allowed') {
                alert("❌ Microphone access denied. Please allow mic permission from browser settings.");
            } else {
                alert("⚠️ Error: " + event.error);
            }
        };

        recognition.start();
    } catch (e) {
        console.error("Speech API error:", e);
        alert("❌ Speech Recognition not supported or blocked.");
    }
}
</script>

</body>
</html>
