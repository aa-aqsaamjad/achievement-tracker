<?php

session_start();
require __DIR__ . '/../config/database.php';

/* ===========================
    BLOCK UNAUTHORISED ACCESS
=========================== */
if (!isset($_SESSION['student_id'])) {
    header("Location: /achievement-tracker/public/auth.php");
    exit;
}

$student_id = $_SESSION['student_id'];

/* ===========================
   HANDLE DELETE
=========================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $achievement_id = $_POST['achievement_id'] ?? null;

    if ($achievement_id && is_numeric($achievement_id)) {

        $stmt = $conn->prepare("
            DELETE FROM achievements 
            WHERE achievement_id = ? 
            AND student_id = ?
        ");

        $stmt->bind_param("ii", $achievement_id, $student_id);

        if (!$stmt->execute()) {
            die("Delete failed: " . $stmt->error);
        }

        $stmt->close();
    }
}

header("Location: /achievement-tracker/public/dashboard.php");
exit;

?>