<?php
require_once '../config.php';
if (!isLoggedIn()) redirect('../login.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $stmt = $conn->prepare("SELECT gambar FROM buku WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row && $row['gambar']) {
        $file = '../uploads/' . $row['gambar'];
        if (file_exists($file)) unlink($file);
    }

    $stmt = $conn->prepare("DELETE FROM buku WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: buku.php?msg=deleted");
exit;
?>