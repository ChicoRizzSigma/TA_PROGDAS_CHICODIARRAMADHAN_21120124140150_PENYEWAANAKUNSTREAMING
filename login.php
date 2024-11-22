<?php
session_start();

$users = [
    'admin' => ['password' => 'admin123', 'role' => 'admin'],
    'buyer' => ['password' => 'buyer123', 'role' => 'buyer']
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($users[$username]) && $users[$username]['password'] == $password) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];

        if ($_SESSION['role'] == 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: buyer.php');
        }
        exit;
    } else {
        echo "<script>alert('Username atau password salah'); window.location.href = 'index.html';</script>";
    }
}
?>