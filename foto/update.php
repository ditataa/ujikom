<?php
include '../koneksi.php';
session_start();

$judul_foto = $_POST['judul_foto'];
$deskripsi_foto = $_POST['deskripsi_foto'];
$id_album = $_POST['id_album'];
$id_foto = $_POST['id_foto'];

// cek apa ada foto dengan nama yang sama dalam album yang sama
$sql_check = mysqli_query($koneksi, "SELECT * FROM foto WHERE judul_foto = '$judul_foto' AND id_album = '$id_album' AND id_foto != '$id_foto'");

if (mysqli_num_rows($sql_check) > 0) {
    echo "<script>alert('Foto dengan nama \"$judul_foto\" sudah ada di album ini.'); window.history.back();</script>";
} else {
    $sql = mysqli_query($koneksi, "UPDATE foto SET judul_foto = '$judul_foto', deskripsi_foto = '$deskripsi_foto', id_album = '$id_album' WHERE id_foto = '$id_foto'");
    
    header("location:../album/detail.php?id_album=$id_album");
}

?>