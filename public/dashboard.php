<?php
session_start();

require __DIR__ . '/../config/database.php';

/* ===========================
   BLOCK UNAUTHORIZED ACCESS
=========================== */
if (!isset($_SESSION['student_id'])) {
    header("Location: /achievement-tracker/public/auth.php");
    exit;
}

$student_id = $_SESSION['student_id'];


/* ===========================
   GET FIRST NAME (for greeting)
=========================== */
$stmt = $conn->prepare("SELECT first_name FROM students WHERE student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$first_name = 'User';

if ($row = $result->fetch_assoc()) {
    $first_name = $row['first_name'];
}

$stmt->close();

/* ===========================
   GET ACHIEVEMENTS (for display)
=========================== */
$stmt = $conn->prepare("SELECT 
                            a.achievement_id,
                            a.title,
                            a.description,
                            a.date_received,
                            c.name AS category_name
                        FROM achievements a
                        LEFT JOIN achievement_categories c
                            ON a.category_id = c.category_id
                        WHERE a.student_id = ?
                        ORDER BY a.date_received DESC
");

$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$achievements = [];

while ($row = $result->fetch_assoc()) {
    $achievements[] = $row;
}

$stmt->close();

require __DIR__ . '/../views/dashboard.php';