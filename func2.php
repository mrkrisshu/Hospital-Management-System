<?php
session_start();
$con = new mysqli("localhost", "root", "zappeysfc", "myhmsdb");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Patient Registration
if (isset($_POST['patsub1'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password === $cpassword) {
        $stmt = $con->prepare("INSERT INTO patreg (fname, lname, gender, email, contact, password, cpassword) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $fname, $lname, $gender, $email, $contact, $password, $cpassword);

        if ($stmt->execute()) {
            $_SESSION['username'] = "$fname $lname";
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['gender'] = $gender;
            $_SESSION['contact'] = $contact;
            $_SESSION['email'] = $email;

            // Get inserted patient ID
            $pid = $stmt->insert_id;
            $_SESSION['pid'] = $pid;

            header("Location: admin-panel.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        header("Location: error1.php");
        exit();
    }
}

// Update payment status
if (isset($_POST['update_data'])) {
    $contact = $_POST['contact'];
    $status = $_POST['status'];

    $stmt = $con->prepare("UPDATE appointmenttb SET payment = ? WHERE contact = ?");
    $stmt->bind_param("ss", $status, $contact);

    if ($stmt->execute()) {
        header("Location: updated.php");
        exit();
    } else {
        echo "Error updating payment status: " . $stmt->error;
    }

    $stmt->close();
}

// Add doctor
if (isset($_POST['doc_sub'])) {
    $name = $_POST['name'];
    $stmt = $con->prepare("INSERT INTO doctb (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        header("Location: adddoc.php");
        exit();
    } else {
        echo "Error adding doctor: " . $stmt->error;
    }

    $stmt->close();
}

// Doctor dropdown
function display_docs()
{
    global $con;
    $query = "SELECT * FROM doctb";
    $result = $con->query($query);

    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
    }
}
?>
