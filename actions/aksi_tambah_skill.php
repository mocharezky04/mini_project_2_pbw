<?php
require __DIR__ . '/../config/koneksi.php';

$skill_name = trim($_POST['skill_name'] ?? '');
$percentage = (int)($_POST['percentage'] ?? 0);
$color_class = trim($_POST['color_class'] ?? 'bg-primary');

if ($skill_name !== '' && $percentage >= 0 && $percentage <= 100) {
    $stmt = mysqli_prepare($conn, "INSERT INTO skills (skill_name, percentage, color_class) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sis", $skill_name, $percentage, $color_class);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../admin.php?status=skill_added");
    exit;
}

header("Location: ../admin.php?status=skill_failed");
exit;

