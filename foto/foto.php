<?php
session_start();
include '../koneksi.php';
if ($_SESSION['status'] != 'login') {
  header("location: auth/login.php?msg=belum_Login");
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ujikom</title>
  <?php include '../assets/layout/css.php' ?>
</head>

<body>
  <?php include "../assets/layout/header.php" ?>
  <h1>Halaman Foto</h1>

  <form action="tambah.php" method="POST" enctype="multipart/form-data">
    <table>
      <tr>
        <td>Judul</td>
        <td><input type="text" name="judul_foto"></td>
      </tr>
      <tr>
        <td>Deksripsi Foto</td>
        <td><input type="text" name="deskripsi_foto"></td>
      </tr>
      <tr>
        <td>Lokasi File</td>
        <td><input type="file" name="lokasi_file"></td>
      </tr>
      <tr>
        <td>Album</td>
        <td>
          <select name="id_album">
            <?php
            $id_user = $_SESSION['id_user'];
            $sql = mysqli_query($koneksi, "SELECT * FROM album WHERE id_user = '$id_user'");
            while ($data = mysqli_fetch_array($sql)) {
              ?>
              <option value="<?= $data['id_album'] ?>"><?= $data['nama_album'] ?></option>
            <?php
            }
            ?>

          </select>
        </td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="tambah"></td>
      </tr>
    </table>
  </form>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Judul</th>
        <th scope="col">Deksripsi</th>
        <th scope="col">Tanggal Unggah</th>
        <th scope="col">Foto</th>
        <th scope="col">Album</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $id_user = $_SESSION['id_user'];
      $sql = mysqli_query($koneksi, "SELECT * FROM foto,album WHERE foto.id_user = '$id_user' and foto.id_album = album.id_album");
      // $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
      while ($data = mysqli_fetch_array($sql)) {
        ?>
        <tr>
          <td><?= $data['id_foto'] ?></td>
          <td><?= $data['judul_foto'] ?></td>
          <td><?= $data['deskripsi_foto'] ?></td>
          <td><?= $data['tanggal_unggah'] ?></td>
          <td><img width="200px" src="<?= $base_url . $data['lokasi_file'] ?>" alt="<?= $data['judul_foto'] ?>"></td>
          <td><?= $data['nama_album'] ?></td>
          <td>
            <a href="hapus.php?id_foto=<?= $data['id_foto'] ?>">Hapus</a> |
            <a href="edit.php?id_foto=<?= $data['id_foto'] ?>">Edit</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</body>

<?php include 'assets/layout/script.php' ?>

</html>