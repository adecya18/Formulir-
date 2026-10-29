<?php
include "koneksi.php";

$no = filter_input(INPUT_GET, 'no', FILTER_VALIDATE_INT);
if ($no === false || $no === null) {
    http_response_code(400);
    exit('Nomor data tidak valid.');
}

$stmt = mysqli_prepare($koneksi, "SELECT no, nama, email, handphone FROM data WHERE no = ?");
if (!$stmt) {
    http_response_code(500);
    exit("Gagal menyiapkan data: " . htmlspecialchars(mysqli_error($koneksi), ENT_QUOTES, 'UTF-8'));
}
mysqli_stmt_bind_param($stmt, "i", $no);
if (!mysqli_stmt_execute($stmt)) {
    http_response_code(500);
    exit("Gagal mengambil data: " . htmlspecialchars(mysqli_stmt_error($stmt), ENT_QUOTES, 'UTF-8'));
}
$result = mysqli_stmt_get_result($stmt);
$baris = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$baris) {
    http_response_code(404);
    exit('Data tidak ditemukan.');
}

$pageTitle = 'Edit Data';
$activePage = 'data';
include '_header.php';
$escape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card content-card">
            <div class="card-body p-4 p-md-5">
                <div class="mb-4">
                    <h1 class="h3 mb-2">Edit Data</h1>
                    <p class="text-secondary mb-0">Perbarui informasi pendaftar di bawah ini.</p>
                </div>
                <form action="update.php" method="POST">
                    <input type="hidden" name="no" value="<?php echo $escape($baris['no']); ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $escape($baris['nama']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $escape($baris['email']); ?>" required>
                    </div>
                    <div class="mb-4">
                        <label for="hp" class="form-label">Nomor handphone</label>
                        <input type="tel" class="form-control" id="handphone" name="handphone" value="<?php echo $escape($baris['handphone']); ?>" required>
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        <a href="data.php" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php'; ?>