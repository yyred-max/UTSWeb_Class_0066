<?php
require_once 'config.php';
if (!isLoggedIn()) redirect('login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Admin Lentera Aksara</span>
            <div>
                <span lass="text-white me-3">Halo, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card-shadow">
            <div class="card-body text-center py-5">
                <h2>Selamat Datang di Dashboard Admin</h2>
                <p class="text-muted">Anda berhasil login sebagai <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
                <hr>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="buku/buku.php" class="btn btn-primary btn-lg">Kelola Buku</a>
                    <a href="../Index.php" class="btn btn-success btn-lg" target="_blank">Lihat Website</a>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>