<?php 
include '../koneksi.php';
session_start();

$id_user = $_GET['id_user'];

$sql = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id_user'");

header("location: user.php");
?>