<?php
require_once '../config.php';

if (!isLoggedIn()) {
    redirect('../login.php');
}

$upload_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $judul     = trim($_POST['judul'] ?? '');
    $penulis   = trim($_POST['penulis'] ?? '');
    $tahun     = intval($_POST['tahun_terbit'] ?? 0);
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $kategori  = trim($_POST['kategori'] ?? 'lainnya');
    $gambar    = '';

    // Folder uploads (root project)
    $uploadDir = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;

    // Jika folder belum ada maka buat otomatis
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] != UPLOAD_ERR_NO_FILE) {

        if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {

            $tmpName  = $_FILES['gambar']['tmp_name'];
            $fileName = $_FILES['gambar']['name'];
            $fileSize = $_FILES['gambar']['size'];

            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($ext, $allowed)) {

                $upload_error = "Format gambar harus JPG, JPEG, PNG, GIF atau WEBP.";

            } elseif ($fileSize > 2 * 1024 * 1024) {

                $upload_error = "Ukuran gambar maksimal 2 MB.";

            } elseif (!is_writable($uploadDir)) {

                $upload_error = "Folder uploads tidak memiliki izin tulis.";

            } else {

                $newName = uniqid('buku_', true) . '.' . $ext;
                $target = $uploadDir . $newName;

                if (move_uploaded_file($tmpName, $target)) {

                    $gambar = $newName;

                } else {

                    $upload_error = "Gagal mengupload gambar.";

                }
            }

        } else {

            $upload_error = "Terjadi kesalahan saat upload. Kode Error : " . $_FILES['gambar']['error'];

        }
    }

    if (empty($upload_error)) {

        $stmt = $conn->prepare("
            INSERT INTO buku
            (judul, penulis, tahun_terbit, deskripsi, kategori, gambar)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "ssisss",
            $judul,
            $penulis,
            $tahun,
            $deskripsi,
            $kategori,
            $gambar
        );

        if ($stmt->execute()) {

            header("Location: buku.php?msg=added");
            exit;

        } else {

            $upload_error = "Database Error : " . $stmt->error;

        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Tambah Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4" style="max-width:650px;">

    <h2 class="mb-4">Tambah Buku</h2>

    <?php if (!empty($upload_error)): ?>

        <div class="alert alert-danger">
            <?= htmlspecialchars($upload_error) ?>
        </div>

    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input
                type="text"
                name="judul"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input
                type="text"
                name="penulis"
                class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input
                type="number"
                name="tahun_terbit"
                class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea
                name="deskripsi"
                rows="4"
                class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>

            <select
                name="kategori"
                class="form-select">

                <option value="filsafat">Filsafat</option>
                <option value="novel">Novel</option>
                <option value="lainnya">Lainnya</option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">Gambar Buku</label>

            <input
                type="file"
                name="gambar"
                accept="image/*"
                class="form-control">

        </div>

        <button class="btn btn-success">
            Simpan
        </button>

        <a href="buku.php" class="btn btn-secondary">
            Batal
        </a>

    </form>

</div>

</body>
</html>