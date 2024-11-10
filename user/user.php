<?php
session_start();
include '../koneksi.php';
if ($_SESSION['status'] != 'login') {
    header("location: auth/login.php?msg=belum_Login");
}
if ($_SESSION['level'] != 'admin') {
    header("location: ../home.php");
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

    <div class="container mt-5 ">
        <h1 class="text-center">Data User</h1>
        <!-- Button trigger modal -->
        <div class="text-end">
            <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#modal_tambah">
                <i class="fa-solid fa-plus"></i> Tambah
            </button>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Level</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id_user = $_SESSION['id_user'];
                $sql = mysqli_query($koneksi, "SELECT * FROM user");
                // $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
                while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                        <td><?= $data['id_user'] ?></td>
                        <td><?= $data['username'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['nama_lengkap'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td><?= $data['level'] ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#edit<?= $data['id_user'] ?>">
                                <i class="fa-solid fa-pen"></i> Edit</button>
                            <!-- modal edit -->
                            <?php include "../user/edit.php" ?>

                            <a href="<?= $base_url ?>user/hapus.php?id_user=<?= $data['id_user'] ?>" class="btn btn-danger"
                                onclick="return confirm('Anda yakin ingin menghapus user?')"><i
                                    class="fa-solid fa-trash"></i> Delete</a>
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
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Level</label>
                            <select name="level" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
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
</body>
<?php include '../assets/layout/script.php' ?>

</html>