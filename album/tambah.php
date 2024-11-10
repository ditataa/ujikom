<?php 
include '../koneksi.php';
session_start();

$nama_album = $_POST['nama_album'];
$deskripsi = $_POST['deskripsi'];
$tanggal_dibuat = date('Y-m-d');
$id_user = $_SESSION['id_user'];

$sql_check = mysqli_query($koneksi, "SELECT * FROM album WHERE nama_album = '$nama_album' AND id_user = '$id_user'");
if (mysqli_num_rows($sql_check) > 0) {
    echo "<script>alert('Album dengan nama \"$nama_album\" sudah ada'); window.location.href='album.php?id_user=$id_user';</script>";
} else {
$sql = mysqli_query($koneksi, "INSERT INTO album(nama_album, deskripsi, tanggal_dibuat, id_user) VALUES ('$nama_album', '$deskripsi', '$tanggal_dibuat', '$id_user')");

header("location: album.php?id_user=$id_user");
}
?>