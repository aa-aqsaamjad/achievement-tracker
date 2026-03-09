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


/* ===========================
    HANDLE FORM SUBMISSION
=========================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $category_id = $_POST['category_id'] ?? null;
    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $date_received = $_POST['date_received'] ?? null;

    $evidence_path = null;


    /* ===========================
        HANDLE FILE UPLOAD
    =========================== */

    if (!empty($_FILES['evidence']['name'])) {

        $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];

        if (in_array($_FILES['evidence']['type'], $allowed_types)) {

            $upload_dir = __DIR__ . '/../public/uploads/';

            // create unique filename
            $filename = time() . "_" . basename($_FILES['evidence']['name']);
            $target_path = $upload_dir . $filename;

            if (move_uploaded_file($_FILES['evidence']['tmp_name'], $target_path)) {
                $evidence_path = "uploads/" . $filename;
            }

        } else {
            $error = "Invalid file type. Only JPG, PNG, and PDF allowed.";
        }
    }


    /* ===========================
        INSERT ACHIEVEMENT
    =========================== */

    if ($category_id && $title && $date_received) {

        $stmt = $conn->prepare("
            INSERT INTO achievements 
            (student_id, category_id, title, description, date_received, evidence_file)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "iissss",
            $_SESSION['student_id'],
            $category_id,
            $title,
            $description,
            $date_received,
            $evidence_path
        );

        $stmt->execute();
        $stmt->close();

        header("Location: /achievement-tracker/public/dashboard.php");
        exit;

    } else {
        $error = "Please fill in all required fields.";
    }
}

require __DIR__ . '/../views/add_achievement.php';

?>