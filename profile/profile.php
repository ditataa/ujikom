<?php
session_start();
include '../koneksi.php';
if ($_SESSION['status'] != 'login') {
    header("location: auth/login.php?msg=belum_Login");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujikom</title>

    <?php include '../assets/layout/css.php' ?>
</head>

<body>
    <?php include "../assets/layout/header.php" ?>
    <?php
    $id_user = $_SESSION['id_user'];
    $sql_user = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'");
    $user = mysqli_fetch_assoc($sql_user);
    ?>

    <div class="card container mt-4" style="min-height: 500px">
        <div class="row mt-4 d-flex justify-content-center text-center">
            <h1>Profile <?= $user['nama_lengkap'] ?></h1>
        </div>
        <div class="container mt-2">
            <!-- Button trigger modal -->
            <div class="d-flex justify-content-end">
                <?php if ($_SESSION['id_user'] == $user['id_user']) { ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#edit<?= $user['id_user'] ?>">
                        <i class="fa-solid fa-pen"></i> Edit
                    </button>
                    <!-- modal edit -->
                    <?php include "../profile/edit.php"; ?>
                <?php } ?>
            </div>

            <div class="table-responsiv">
                <table class="table table-white table-hover">
                    <tr>
                        <th style="width:30%;" class="py-3">Username</th>
                        <td class="py-3 text-muted"><?= $user['username'] ?></td>
                    </tr>
                    <tr>
                        <th style="width:30%;" class="py-3">Password</th>
                        <td class="py-3 text-muted"><?= $user['password'] ?></td>
                    </tr>
                    <tr>
                        <th style="width:30%;" class="py-3">Email</th>
                        <td class="py-3 text-muted"><?= $user['email'] ?></td>
                    </tr>
                    <tr>
                        <th style="width:30%;" class="py-3">Nama Lengkap</th>
                        <td class="py-3 text-muted"><?= $user['nama_lengkap'] ?></td>
                    </tr>
                    <tr>
                        <th style="width:30%;" class="py-3">Alamat</th>
                        <td class="py-3 text-muted"><?= $user['alamat'] ?></td>
                    </tr>
                    <tr>
                        <th style="width:30%" class="py-3">Status</th>
                        <td class="py-3 text-muted"><?= $user['level'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
<?php include '../assets/layout/script.php' ?>

</html>