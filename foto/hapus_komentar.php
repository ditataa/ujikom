<?php 
include '../koneksi.php';
session_start();

$id_foto = $_GET['id_foto'];
$id_komentar = $_GET['id_komentar'];

$sql = mysqli_query($koneksi, "DELETE FROM komentar_foto WHERE id_komentar='$id_komentar' AND id_foto='$id_foto'");

header("location:../foto/detailfoto.php?id_foto=$id_foto");
