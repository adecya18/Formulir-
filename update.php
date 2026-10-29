<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metode permintaan tidak diizinkan.');
}

$no = filter_input(INPUT_POST, 'no', FILTER_VALIDATE_INT);
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$handphone = trim($_POST['handphone'] ?? '');
if ($no === false || $no === null || $nama === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $handphone === '') {
    http_response_code(400);
    exit('Data yang dikirim tidak valid atau belum lengkap.');
}

$stmt = mysqli_prepare($koneksi, "UPDATE data SET nama = ?, email = ?, handphone = ? WHERE no = ?");
if (!$stmt) {
    http_response_code(500);
    exit("Gagal menyiapkan pembaruan: " . htmlspecialchars(mysqli_error($koneksi), ENT_QUOTES, 'UTF-8'));
}
mysqli_stmt_bind_param($stmt, "sssi", $nama, $email, $handphone, $no);
if (!mysqli_stmt_execute($stmt)) {
    http_response_code(500);
    exit("Gagal memperbarui data: " . htmlspecialchars(mysqli_stmt_error($stmt), ENT_QUOTES, 'UTF-8'));
}

mysqli_stmt_close($stmt);
header("Location: data.php");
exit;
?>