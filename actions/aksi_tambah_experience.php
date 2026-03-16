<?php
require __DIR__ . '/../config/koneksi.php';

$content = trim($_POST['content'] ?? '');
if ($content !== '') {
    $stmt = mysqli_prepare($conn, "INSERT INTO experience (content) VALUES (?)");
    mysqli_stmt_bind_param($stmt, "s", $content);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../admin.php?status=exp_added");
    exit;
}

header("Location: ../admin.php?status=exp_failed");
exit;

