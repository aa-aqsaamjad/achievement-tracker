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


/* ===========================
   GET CATEGORIES FOR DROPDOWN
=========================== */
$stmt = $conn->prepare("SELECT category_id, name FROM achievement_categories ORDER BY name ASC");
$stmt->execute();
$result = $stmt->get_result();

$categories = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

$stmt->close();


require __DIR__ . '/../views/add_achievement.php';
?>