<?php 
	include '../koneksi.php';
	session_start();

	$judul_foto = $_POST['judul_foto'];
	$deskripsi_foto = $_POST['deskripsi_foto'];
	$id_album = $_POST['id_album'];
	$tanggal_unggah = date('Y-m-d');
	$id_user = $_SESSION['id_user'];

	$rand = rand();
	$ekstensi =  array('png','jpg','jpeg','gif');
	$filename = $_FILES['lokasi_file']['name'];
	$ukuran = $_FILES['lokasi_file']['size'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	try {
		// Untuk mengecek apakah judul foto sudah ada dalam album ini 
		$sql_check = mysqli_query($koneksi, "SELECT * FROM foto WHERE judul_foto = '$judul_foto' AND id_album = '$id_album'");

		if (mysqli_num_rows($sql_check) > 0) {
			throw new Exception("Foto dengan judul '$judul_foto' sudah ada dalam album ini!");
		}

		if(!in_array($ext,$ekstensi) ) {
			throw new Exception("Tipe file tidak sesuai");
		}else{
			if($ukuran < 5242880){ // 5MB
				$lokasi_file = 'assets/img/'.$rand.'_'.$filename;
				move_uploaded_file($_FILES['lokasi_file']['tmp_name'], '../'.$lokasi_file);
				$query = mysqli_query($koneksi, "INSERT INTO foto(judul_foto, deskripsi_foto, tanggal_unggah, lokasi_file, id_album, id_user) VALUES ('$judul_foto', '$deskripsi_foto', '$tanggal_unggah','$lokasi_file', '$id_album', '$id_user')");
				if ($query) {
					header("location:../album/detail.php?id_album=$id_album");
				}
			}else{
				throw new Exception("Ukuran file terlalu besar");
			}
		}
	} catch (\Exception $e) {
		echo "Error: ". $e->getMessage();
	}