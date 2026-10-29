<?php
$pageTitle = 'Formulir Pendaftaran';
$activePage = 'form';
include '_header.php';
?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card content-card">
            <div class="card-body p-4 p-md-5">
                <div class="mb-4">
                    <h1 class="h3 mb-2">Formulir Pendaftaran</h1>
                    <p class="text-secondary mb-0">Silakan isi data berikut dengan benar.</p>
                </div>
                <form method="POST" action="submit.php">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" required>
                    </div>
                    <div class="mb-4">
                        <label for="hp" class="form-label">Nomor handphone</label>
                        <input type="tel" class="form-control" id="handphone" name="handphone" placeholder="Masukkan nomor handphone" required>
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
                        <a href="data.php" class="btn btn-outline-secondary">Lihat Data</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php'; ?>