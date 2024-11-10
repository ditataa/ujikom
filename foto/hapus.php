<?php 
include '../koneksi.php';
session_start();

$id_foto = $_GET['id_foto'];
$id_album = $_GET['id_album'];

$sql = mysqli_query($koneksi, "DELETE FROM foto WHERE id_foto='$id_foto'");

header("location:../album/detail.php?id_album=$id_album");