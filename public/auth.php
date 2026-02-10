<?php
session_start();

require __DIR__ . '/../config/database.php';

$error = null;

/* =====================
   HANDLE SIGN UP
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signUp'])) {

    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $password   = $_POST['password'];

    if (!$first_name || !$last_name || !$email || !$password) {
        $error = "All fields are required.";
    } else {
        // hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // check if email already exists
        $stmt = $conn->prepare("SELECT student_id FROM student WHERE email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email already exists.";
        } else {
            // create student
            $stmt = $conn->prepare(
                "INSERT INTO student (first_name, last_name, email, password_hash)
                 VALUES (?, ?, ?, ?)"
            );
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashedPassword);

            if ($stmt->execute()) {
                $_SESSION['student_id'] = $conn->insert_id;
                header("Location: /achievement-tracker/public/dashboard.php");
                exit;
            } else {
                $error = "Something went wrong. Try again.";
            }
        }
    }
}

/* =====================
   HANDLE LOGIN
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signIn'])) {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (!$email || !$password) {
        $error = "Email and password are required.";
    } else {
        $stmt = $conn->prepare("SELECT student_id, password_hash FROM student WHERE email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $student = $result->fetch_assoc();

            if (password_verify($password, $student['password_hash'])) {
                $_SESSION['student_id'] = $student['student_id'];
                header("Location: /achievement-tracker/public/dashboard.php");
                exit;
            }
        }

        $error = "Invalid email or password.";
    }
}

/* =====================
   LOAD VIEW
===================== */
require __DIR__ . '/../src/views/auth.php';