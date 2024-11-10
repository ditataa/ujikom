<?php 
include '../koneksi.php';
session_start();

$id_user = $_POST['id_user'];
$id_album = $_POST['id_album'];
$nama_album = $_POST['nama_album'];
$deskripsi = $_POST['deskripsi'];

    // $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);

// debug($cek_user);
$sql = mysqli_query($koneksi, "UPDATE album SET nama_album = '$nama_album', deskripsi = '$deskripsi' WHERE id_album = '$id_album'");

header("location: album.php?id_user=$id_user");
?>