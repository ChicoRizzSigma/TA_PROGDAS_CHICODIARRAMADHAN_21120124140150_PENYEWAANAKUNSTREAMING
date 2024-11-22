<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    //Ini bagian buat validasiny
    if (!empty($username) && !empty($password)) {
        $file = 'users.txt';
        $data = $username . ',' . $password . ',' . $role . "\n";
        file_put_contents($file, $data, FILE_APPEND);
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href = 'index.html';</script>";
    } else {
        echo "<script>alert('Lengkapi semua data.'); window.location.href = 'register.html';</script>";
    }
}
?>