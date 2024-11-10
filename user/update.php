<?php 
include '../koneksi.php';
session_start();

$id_user = $_POST['id_user'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$nama_lengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];
$level = $_POST['level'];
    // $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);

// debug($cek_user);
$sql = mysqli_query($koneksi, "UPDATE user SET username = '$username', password = '$password', email = '$email', nama_lengkap = '$nama_lengkap', alamat = '$alamat', level = '$level' WHERE id_user = '$id_user'");

header("location: user.php");
?>