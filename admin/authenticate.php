<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hash password dengan MD5 (sesuai contoh dosen)
    $hashed_password = md5($password);

    // Cek username di database
    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Bandingkan hash MD5
        if ($hashed_password === $row['password']) {
            // Login berhasil
            session_start();
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        }
    }

    // Jika username tidak ditemukan atau password salah
    header("Location: login.php?error=1");
    exit;
} else {
    // Jika bukan method POST, redirect ke login
    header("Location: login.php");
    exit;
}
?>