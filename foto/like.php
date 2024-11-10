<?php
include '../koneksi.php';
session_start();
$id_foto = $_POST['id_foto'];
$id_user = $_SESSION['id_user'];
$tanggal_like = date('Y-m-d');

$check = mysqli_query($koneksi, "SELECT * FROM like_foto where id_foto=$id_foto and id_user=$id_user");
if(mysqli_num_rows($check) != 0){
    $unlike = mysqli_query($koneksi, "DELETE FROM like_foto where id_foto=$id_foto and id_user=$id_user");
    $res = ['q'=>$unlike,'is_like'=>false];
} else {
    $sql = mysqli_query($koneksi, "INSERT INTO like_foto (id_foto, id_user, tanggal_like) VALUES ('$id_foto', '$id_user', '$tanggal_like')");
    $res = ['q'=>$sql,'is_like'=>true];
}

if ($res['q']) {
    $jml_like = mysqli_query($koneksi, "SELECT * FROM like_foto where id_foto=$id_foto");
    $jml_like = mysqli_num_rows($jml_like);
    echo json_encode(['jml_like' => $jml_like, 'message' => 'OK', 'is_like' => $res['is_like']]);
}

// header("location:../foto/detailfoto.php?id_foto=$id_foto");
?>