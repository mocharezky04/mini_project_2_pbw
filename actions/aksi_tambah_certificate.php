<?php
require __DIR__ . '/../config/koneksi.php';

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');

$image_path = '';
$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'images';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['image_file']['tmp_name'];
    $originalName = $_FILES['image_file']['name'] ?? '';
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    if (in_array($ext, $allowed, true)) {
        $safeName = 'cert_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $destPath = $uploadDir . DIRECTORY_SEPARATOR . $safeName;
        if (move_uploaded_file($tmpName, $destPath)) {
            $image_path = 'images/' . $safeName;
        }
    }
}

if ($title !== '' && $description !== '' && $image_path !== '') {
    $stmt = mysqli_prepare($conn, "INSERT INTO certificates (title, description, image_path) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $title, $description, $image_path);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../admin.php?status=cert_added");
    exit;
}

header("Location: ../admin.php?status=cert_failed");
exit;

