<?php
$pageTitle = $pageTitle ?? 'Aplikasi CRUD';
$activePage = $activePage ?? '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?> | CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #f4f7fb;
        }

        .navbar-brand {
            letter-spacing: .02em;
        }

        .page-content {
            max-width: 1080px;
        }

        .content-card {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 .5rem 1.5rem rgba(28, 39, 60, .08);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container page-content">
        <a class="navbar-brand fw-semibold" href="index.php">CRUD Data</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Buka navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavigation">
            <div class="navbar-nav ms-auto">
                <a class="nav-link<?php echo $activePage === 'form' ? ' active' : ''; ?>" href="index.php">Formulir</a>
                <a class="nav-link<?php echo $activePage === 'data' ? ' active' : ''; ?>" href="data.php">Data</a>
            </div>
        </div>
    </div>
</nav>
<main class="container page-content py-5">
