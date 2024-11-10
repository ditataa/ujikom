<?php 
include '../koneksi.php';
session_start();

$id_album = $_GET['id_album'];
$id_user = $_GET['id_user'];

$sql = mysqli_query($koneksi, "DELETE FROM album WHERE id_album='$id_album'");

header("location: album.php?id_user=$id_user");
?>