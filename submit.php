<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metode permintaan tidak diizinkan.');
}

$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$handphone = trim($_POST['handphone'] ?? '');
if ($nama === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $handphone === '') {
    http_response_code(400);
    exit('Nama, email yang valid, dan nomor handphone wajib diisi.');
}

$stmt = mysqli_prepare($koneksi, "INSERT INTO data (nama, email, handphone) VALUES (?, ?, ?)");
if (!$stmt) {
    http_response_code(500);
    exit("Gagal menyiapkan penyimpanan: " . htmlspecialchars(mysqli_error($koneksi), ENT_QUOTES, 'UTF-8'));
}
mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $handphone);
if (!mysqli_stmt_execute($stmt)) {
    http_response_code(500);
    exit("Gagal menyimpan data: " . htmlspecialchars(mysqli_stmt_error($stmt), ENT_QUOTES, 'UTF-8'));
}

mysqli_stmt_close($stmt);
header("Location: data.php");
exit;
