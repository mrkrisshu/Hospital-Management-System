<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vitals = $_POST['vitals'];
    $symptoms = $_POST['symptoms'];
    $tasks = $_POST['tasks'];
    $prescriptions = $_POST['prescriptions'];

    $conn = new mysqli("localhost", "root", "", "myhmsdb");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $stmt = $conn->prepare("INSERT INTO rounds_log (vitals, symptoms, tasks, prescriptions) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $vitals, $symptoms, $tasks, $prescriptions);
    
    $success = false;
    if ($stmt->execute()) $success = true;

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Rounds Entry</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f9ff;
            padding: 30px;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: #ffffff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        label {
            font-weight: bold;
            color: #34495e;
            display: block;
            margin-top: 15px;
        }
        textarea {
            width: 100%;
            height: 80px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            resize: vertical;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        button, input[type="submit"] {
            background-color: #3498db;
            border: none;
            padding: 8px 15px;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }
        button:hover, input[type="submit"]:hover {
            background-color: #2980b9;
        }
        .msg {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 16px;
        }
        .msg.success {
            color: green;
        }
        .msg.error {
            color: red;
        }
    </style>
    <script>
        function startDictation(id) {
            const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'en-US';
            recognition.onresult = function(event) {
                document.getElementById(id).value += event.results[0][0].transcript + " ";
            };
            recognition.start();
        }

        function insertTemplate(id, text) {
            document.getElementById(id).value += text + "\n";
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Doctor Rounds - Quick Entry</h2>

        <?php if (isset($success) && $success): ?>
            <div class="msg success">✅ Entry saved successfully.</div>
        <?php elseif (isset($success)): ?>
            <div class="msg error">❌ Failed to save entry.</div>
        <?php endif; ?>

        <form method="post" action="">
            <label>Vitals:</label>
            <textarea name="vitals" id="vitals"></textarea>
            <div class="button-group">
                <button type="button" onclick="startDictation('vitals')">🎤 Speak</button>
                <button type="button" onclick="insertTemplate('vitals', 'BP: 120/80, HR: 72')">🧾 Normal Vitals</button>
            </div>

            <label>Symptoms:</label>
            <textarea name="symptoms" id="symptoms"></textarea>
            <div class="button-group">
                <button type="button" onclick="startDictation('symptoms')">🎤 Speak</button>
                <button type="button" onclick="insertTemplate('symptoms', 'Fever, Cough, Fatigue')">🧾 Common Cold</button>
            </div>

            <label>Tasks:</label>
            <textarea name="tasks" id="tasks"></textarea>
            <div class="button-group">
                <button type="button" onclick="startDictation('tasks')">🎤 Speak</button>
                <button type="button" onclick="insertTemplate('tasks', 'Order CBC and Chest X-ray')">🧾 Basic Tests</button>
            </div>

            <label>Prescriptions:</label>
            <textarea name="prescriptions" id="prescriptions"></textarea>
            <div class="button-group">
                <button type="button" onclick="startDictation('prescriptions')">🎤 Speak</button>
                <button type="button" onclick="insertTemplate('prescriptions', 'Paracetamol 500mg TID x 3 days')">🧾 Fever Rx</button>
            </div>

            <input type="submit" value="Save Entry">
        </form>
    </div>
</body>
</html>
