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
    <?php
    $id_album = $_GET['id_album'];
    $sql_album = mysqli_query($koneksi, "SELECT * FROM album join user on user.id_user = album.id_user WHERE id_album='$id_album'");
    $album = mysqli_fetch_assoc($sql_album);

    $sql_foto = mysqli_query($koneksi, "SELECT * FROM foto join album on album.id_album = foto.id_album WHERE foto.id_album='$id_album'");
    ?>
    <?php include "../assets/layout/header.php" ?>

    <div class="card container mt-4" style="min-height: 450px">
        <div class="container mt-4">
            <div class="row d-flex justify-content-center text-center">
                <h1>Album <?= $album['nama_album'] ?></h1>
                <small>Dibuat oleh: <?= $album['nama_lengkap'] ?></small>
            </div>
        </div>

        <div class="container mt-4">
            <!-- Button trigger modal -->
            <div class="text-end">
                <?php if ($album['id_user'] == $_SESSION['id_user']) { ?>
                    <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#modal_tambah">
                        <i class="fa-solid fa-plus"></i> Tambah
                    </button>
                <?php } ?>
            </div>

            <div class="container">
                <div class="row">
                    <?php while ($foto = mysqli_fetch_assoc($sql_foto)) { ?>
                        <div class="col-md-3 p-2">
                            <div class="card">
                                <!-- Caption above the image -->
                                <div class="image-caption">
                                    <?= htmlspecialchars($foto['judul_foto']) ?>
                                </div>

                                <!-- Hover container wraps both image and buttons -->
                                <div class="image-hover-container">
                                    <!-- Image with hover effect -->
                                    <img src="<?= htmlspecialchars($base_url . $foto['lokasi_file']) ?>"
                                        class="card-img-top" alt="<?= htmlspecialchars($foto['judul_foto']) ?>">

                                    <!-- Lightbox Container for Full-Size Image View -->
                                    <div id="lightbox-<?= $foto['id_foto'] ?>" class="lightbox"
                                        onclick="closeLightbox('lightbox-<?= $foto['id_foto'] ?>');">
                                        <img id="lightbox-image"
                                            src="<?= htmlspecialchars($base_url . $foto['lokasi_file']) ?>"
                                            alt="Full Size Image">
                                    </div>

                                    <!-- Hover Buttons (Initially hidden) -->
                                    <div class="hover-buttons text-center">
                                        <button href="#" class="btn btn-light me-2"
                                            onclick="openLightbox('lightbox-<?= $foto['id_foto'] ?>');">View</button>
                                        <a href="<?= $base_url ?>foto/detailfoto.php?id_foto=<?= $foto['id_foto'] ?>"
                                            class="btn btn-light">Detail</a>
                                    </div>
                                </div>

                                <!-- Edit and Delete buttons -->
                                <?php if ($_SESSION['id_user'] == $foto['id_user'] || $_SESSION['level'] == 'admin') { ?>
                                    <div class="d-flex justify-content-between p-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#edit<?= $foto['id_foto'] ?>">
                                            <i class="fa-solid fa-pen"></i> Edit</button>
                                        <!-- modal edit -->
                                        <?php include "../foto/edit.php" ?>

                                        <a href="<?= $base_url ?>foto/hapus.php?id_foto=<?= $foto['id_foto'] ?>&id_album=<?= $id_album ?>"
                                            class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus foto?')">
                                            <i class="fa-solid fa-trash"></i> Delete</a>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Foto -->
    <div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="modal_tambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_tambahLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="<?= $base_url ?>foto/tambah.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="id_album" value="<?= $id_album ?>">
                            <label class="form-label">Judul Foto</label>
                            <input type="text" class="form-control" name="judul_foto" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deksripsi Foto</label>
                            <input type="text" class="form-control" name="deskripsi_foto" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi File</label>
                            <input type="file" class="form-control" name="lokasi_file" required>
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
<script>
    function openLightbox(target) {
        document.getElementById(target).style.display = 'flex';
    }

    function closeLightbox(target) {
        document.getElementById(target).style.display = 'none';
    }
    $(document).ready(function () {
        // Like button functionality
        $('#like-btn').on('click', function () {
            $.ajax({
                url: 'like.php',
                type: 'POST',
                data: {
                    userid: 1,
                    imageid: 'b11'
                },
                success: function (response) {
                    $('#like-count').text(response.likeCount);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        // Comment button functionality (Example)
        $('#comment-btn').on('click', function () {
            alert('Comment button clicked');
        });
    });
</script>

</html>