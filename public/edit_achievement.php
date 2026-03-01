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
   HANDLE FORM SUBMISSION (UPDATE)
=========================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $achievement_id = $_POST['achievement_id'] ?? null;
    $category_id = $_POST['category_id'] ?? null;
    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $date_received = $_POST['date_received'] ?? null;

    if ($achievement_id && $category_id && $title && $date_received) {

        $stmt = $conn->prepare("
            UPDATE achievements
            SET category_id = ?, title = ?, description = ?, date_received = ?
            WHERE achievement_id = ? AND student_id = ?
        ");

        $stmt->bind_param(
            "isssii",
            $category_id,
            $title,
            $description,
            $date_received,
            $achievement_id,
            $student_id
        );

        if (!$stmt->execute()) {
            die("Update failed: " . $stmt->error);
        }

        $stmt->close();

        header("Location: /achievement-tracker/public/dashboard.php");
        exit;
    } else {
        $error = "Please fill in all required fields.";
    }
}


/* ===========================
   LOAD EXISTING ACHIEVEMENT
=========================== */

$achievement_id = $_GET['id'] ?? null;

$stmt = $conn->prepare("
    SELECT *
    FROM achievements
    WHERE achievement_id = ? AND student_id = ?
");

$stmt->bind_param("ii", $achievement_id, $student_id);
$stmt->execute();
$result = $stmt->get_result();

$achievement = $result->fetch_assoc();

if (!$achievement) {
    die("Achievement not found or access denied.");
}

$stmt->close();


/* ===========================
   LOAD CATEGORIES
=========================== */

$stmt = $conn->prepare("SELECT category_id, name FROM achievement_categories ORDER BY name ASC");
$stmt->execute();
$result = $stmt->get_result();

$categories = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

$stmt->close();


require __DIR__ . '/../views/edit_achievement.php';
?>