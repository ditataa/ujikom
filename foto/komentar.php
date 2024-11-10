<?php 
include '../koneksi.php';
session_start();

$id_foto = $_POST['id_foto'];
$id_user = $_SESSION['id_user'];
$isi_komentar = $_POST['isi_komentar'];
$tanggal_komentar = date('Y-m-d');

$sql = mysqli_query($koneksi, "INSERT INTO komentar_foto(id_foto, id_user, isi_komentar, tanggal_komentar) VALUES ('$id_foto', '$id_user', '$isi_komentar', '$tanggal_komentar')");

header("location:../foto/detailfoto.php?id_foto=$id_foto");
?>