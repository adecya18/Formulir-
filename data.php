<?php
include "koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM data");
if (!$query) {
    http_response_code(500);
    exit("Gagal mengambil data: " . htmlspecialchars(mysqli_error($koneksi), ENT_QUOTES, 'UTF-8'));
}
$pageTitle = 'Daftar Data';
$activePage = 'data';
include '_header.php';
?>

<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
    <div>
        <h1 class="h3 mb-1">Daftar Data</h1>
        <p class="text-secondary mb-0">Kelola data pendaftar yang tersimpan.</p>
    </div>
    <a href="index.php" class="btn btn-primary">Tambah Data</a>
</div>
<div class="card content-card">
    <div class="card-body p-0">
        <?php if (mysqli_num_rows($query) === 0) { ?>
            <div class="p-4">
                <div class="alert alert-info mb-0">Belum ada data. Silakan tambahkan data baru.</div>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Handphone</th>
                            <th class="pe-4" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $nomor = 1;
                    $escape = static function ($value) {
                        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
                    };
                    while ($baris = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td class="ps-4"><?php echo $nomor++; ?></td>
                            <td class="fw-medium"><?php echo $escape($baris['nama']); ?></td>
                            <td><?php echo $escape($baris['email']); ?></td>
                            <td><?php echo $escape($baris['handphone']); ?></td>
                            <td class="pe-4">
                                <div class="d-flex gap-2">
                                    <a class="btn btn-sm btn-outline-primary" href="edit.php?no=<?php echo rawurlencode((string) $baris['no']); ?>">Edit</a>
                                    <a class="btn btn-sm btn-outline-danger" href="hapus.php?no=<?php echo rawurlencode((string) $baris['no']); ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>
<?php include '_footer.php'; ?>