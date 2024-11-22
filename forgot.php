<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['admin'];
    $file = 'users.txt';

    if (file_exists($file)) {
        $users = file($file, FILE_IGNORE_NEW_LINES);
        foreach ($users as $user) {
            list($storedUsername, $storedPassword, $role) = explode(',', $user);
            if ($username == $storedUsername) {
                echo "<script>alert('Password Anda: $storedPassword'); window.location.href = 'index.html';</script>";
                exit;
            }
        }
    }
    echo "<script>alert('Username ditemukan! Silahkan cek Email anda.'); window.location.href = 'forgot.html';</script>";
}
?>