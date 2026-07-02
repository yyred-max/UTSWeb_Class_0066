<?php
require_once '../config.php';
if (!isLoggedIn()) redirect('../login.php');

$result = $conn->query("SELECT * FROM buku ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Daftar Buku</h2>
    <a href="tambah_buku.php" class="btn btn-primary mb-3">Tambah Buku</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['judul']) ?></td>
                <td><?= htmlspecialchars($row['penulis']) ?></td>
                <td><?= $row['kategori'] ?></td>
                <td>
                    <?php if($row['gambar']): ?>
                        <img src="../uploads/<?= $row['gambar'] ?>" width="50" height="50" class="img-thumbnail">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit_buku.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_buku.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>