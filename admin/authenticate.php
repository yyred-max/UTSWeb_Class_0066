<?php
require_once 'config.php';

if ($_SERVER['REQUIRED_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['admin-id'] = $row['id'];
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        }
    }
    header("Location: login.php?error=1");
    exit;
} else {
    header ("Location: login.php");
}
?>