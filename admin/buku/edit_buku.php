<?php
require_once '../config.php';
if (!isLoggedIn()) redirect('../login.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: buku.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM buku WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$buku = $result->fetch_assoc();
if (!$buku) {
    header("Location: buku.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'] ?? '';
    $penulis = $_POST['penulis'] ?? '';
    $tahun = $_POST['tahun_terbit'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $kategori = $_POST['kategori'] ?? 'lainnya';
    $gambar = $buku['gambar'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['gambar']['tmp_name'];
        $nama = basename($_FILES['gambar']['name']);
        $ext = strtolower(pathinfo($nama, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $allowed)) {
            $namaBaru = time() . '_' . uniqid() . '.' . $ext;
            $target = '../uploads/' . $namaBaru;
            if (move_uploaded_file($tmp, $target)) {
                if ($gambar && file_exists('../uploads/'.$gambar)) {
                    unlink('../uploads/'.$gambar);
                }
                $gambar = $namaBaru;
            }
        }
    }

    $stmt = $conn->prepare("UPDATE buku SET judul=?, penulis=?, tahun_terbit=?, deskripsi=?, kategori=?, gambar=? WHERE id=?");
    $stmt->bind_param("ssisssi", $judul, $penulis, $tahun, $deskripsi, $kategori, $gambar, $id);
    if ($stmt->execute()) {
        header("Location: buku.php?msg=updated");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4" style="max-width:600px;">
    <h2>Edit Buku</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($buku['judul']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Penulis</label>
            <input type="text" name="penulis" class="form-control" value="<?= htmlspecialchars($buku['penulis']) ?>">
        </div>
        <div class="mb-3">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" value="<?= $buku['tahun_terbit'] ?>">
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4"><?= htmlspecialchars($buku['deskripsi']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori" class="form-select">
                <option value="filsafat" <?= $buku['kategori']=='filsafat'?'selected':'' ?>>Filsafat</option>
                <option value="novel" <?= $buku['kategori']=='novel'?'selected':'' ?>>Novel</option>
                <option value="lainnya" <?= $buku['kategori']=='lainnya'?'selected':'' ?>>Lainnya</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <?php if($buku['gambar']): ?>
                <div><img src="../uploads/<?= $buku['gambar'] ?>" width="100" class="img-thumbnail"></div>
            <?php endif; ?>
            <input type="file" name="gambar" class="form-control" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="buku.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>