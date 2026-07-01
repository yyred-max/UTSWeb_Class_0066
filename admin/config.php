<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'lentera_aksara';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function redirect($url) {
    header("Location: $url");
    exit;
}
?>