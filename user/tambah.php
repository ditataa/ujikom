<?php 
include '../koneksi.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$nama_lengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];
$level = $_POST['level'];

$sql_check = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' OR email = '$email'");

if (mysqli_num_rows($sql_check) > 0) {
    // Jika ada yang sama, tampilkan pesan error
    echo "<script>alert('Username atau email sudah ada'); window.history.back();</script>";
} else {
$sql = mysqli_query($koneksi, "INSERT INTO user(username, password, email, nama_lengkap, alamat, level) VALUES ('$username', '$password', '$email', '$nama_lengkap', '$alamat', '$level')");

header("location: user.php");
}
?>