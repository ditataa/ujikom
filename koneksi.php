<?php 
// session_start();
$base_url   = 'http://dita.test/'; // Ini untuk laragon
// $base_url   = 'http://localhost/dita/'; // Ini untuk xampp
$koneksi    = mysqli_connect("localhost", "root", "", "ujikom_galeri");

function debug($data) {
    echo "<pre>";print_r($data);die;
}
?>