<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    exit('Metode permintaan tidak diizinkan.');
}

$no = filter_input(INPUT_GET, 'no', FILTER_VALIDATE_INT);
if ($no === false || $no === null) {
    http_response_code(400);
    exit('Nomor data tidak valid.');
}

$stmt = mysqli_prepare($koneksi, "DELETE FROM data WHERE no = ?");
if (!$stmt) {
    http_response_code(500);
    exit("Gagal menyiapkan penghapusan: " . htmlspecialchars(mysqli_error($koneksi), ENT_QUOTES, 'UTF-8'));
}
mysqli_stmt_bind_param($stmt, "i", $no);
if (!mysqli_stmt_execute($stmt)) {
    http_response_code(500);
    exit("Gagal menghapus data: " . htmlspecialchars(mysqli_stmt_error($stmt), ENT_QUOTES, 'UTF-8'));
}

mysqli_stmt_close($stmt);
header("Location: data.php");
exit;
?>