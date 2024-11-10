<?php
session_start();
include '../koneksi.php';
if ($_SESSION['status'] != 'login') {
  header("location: auth/login.php?msg=belum_Login");
}
$id_user = $_GET['id_user'] ?? $_SESSION['id_user'];
$nomor = 0;
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ujikom - Album</title>
  <?php include '../assets/layout/css.php' ?>
</head>

<body>
  <?php include "../assets/layout/header.php" ?>

  <?php
  $id_user = $_GET['id_user'];
  $sql_user = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'");
  $user = mysqli_fetch_assoc($sql_user);
  ?>

  <div class="card container mt-4" style="min-height: 450px">
    <div class="container mt-4">
      <div class="row d-flex justify-content-center text-center">
        <h1>Album Milik</h1>
        <h2><?= $user['nama_lengkap'] ?></h2>
      </div>
    </div>

    <div class="container mt-3">
      <!-- Button trigger modal -->
      <div class="text-end">
        <?php if ($id_user == $_SESSION['id_user']) { ?>
          <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#modal_tambah">
            <i class="fa-solid fa-plus"></i> Tambah
          </button>
        <?php } ?>
      </div>

      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Album</th>
            <th scope="col">Deksripsi</th>
            <th scope="col">Tanggal Dibuat</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = mysqli_query($koneksi, "SELECT * FROM album WHERE id_user = '$id_user'");
          // $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
          while ($data = mysqli_fetch_array($sql)) {
            ?>
            <?php $nomor++; ?>
            <tr>
              <td><?= $nomor ?></td>
              <td><?= $data['nama_album'] ?></td>
              <td><?= $data['deskripsi'] ?></td>
              <td><?= $data['tanggal_dibuat'] ?></td>
              <td>
                <a href="<?= $base_url ?>album/detail.php?id_album=<?= $data['id_album'] ?>" class="btn btn-success">
                  <i class="fa-solid fa-circle-info"></i> Detail
                </a>

                <?php if ($data['id_user'] == $_SESSION['id_user'] || $_SESSION['level'] == 'admin') { ?>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#edit<?= $data['id_album'] ?>">
                    <i class="fa-solid fa-pen"></i> Edit
                  </button>
                  <!-- modal edit -->
                  <?php include "../album/edit.php" ?>

                  <a href="<?= $base_url ?>album/hapus.php?id_album=<?= $data['id_album'] ?>&id_user=<?= $data['id_user'] ?>"
                    class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus album?')">
                    <i class="fa-solid fa-trash"></i> Delete
                  </a>
                <?php } ?>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>



    <!-- Modal Tambah -->
    <div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="modal_tambahLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modal_tambahLabel">Tambah Data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="tambah.php" method="POST">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nama Album</label>
                <input type="text" class="form-control" name="nama_album" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Deksripsi</label>
                <input type="text" class="form-control" name="deskripsi" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<?php include '../assets/layout/script.php' ?>

</html>