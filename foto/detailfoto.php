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
    $id_foto = $_GET['id_foto'];
    $query = "select
                a.*,
                b.*,
                c.*,
                CASE 
                    WHEN EXISTS (
                        SELECT 1 
                        FROM like_foto AS d 
                        WHERE d.id_foto = a.id_foto 
                        AND d.id_user = " . $_SESSION['id_user'] . "  -- Check if the session user has liked the photo
                    ) THEN 1 
                    ELSE 0 
                END AS is_like
            from
                foto as a
            join album as b on
                b.id_album = a.id_album
            join user as c on
                c.id_user = b.id_user
            where
                a.id_foto = $id_foto";
    $sql = mysqli_query($koneksi, $query);
    $foto = mysqli_fetch_assoc($sql);
    ?>

    <div class="card container mt-4" style="min-height: 450px">
        <div class="container my-4">
            <!-- Photo Title -->
            <div class="container text-center">
                <h3 class="text-center">
                    <?= $foto['judul_foto'] ?>
                </h3>
                <small>
                    Foto dari album
                    <a
                        href="<?= $base_url ?>album/detail.php?id_album=<?= $foto['id_album'] ?>"><?= $foto['nama_album'] ?></a>
                    yang dibuat oleh
                    <a
                        href="<?= $base_url ?>album/album.php?id_user=<?= $foto['id_user'] ?>"><?= $foto['nama_lengkap'] ?></a>
                </small>
                <br>
                <small>
                    Di upload pada tanggal <?= date('d M Y', strtotime($foto['tanggal_unggah'])) ?>
                </small>
            </div>

            <!-- Main Image Container -->
            <div class="main-image-container my-3" onclick="openLightbox('lightbox-<?= $foto['id_foto'] ?>');">
                <img src="<?= htmlspecialchars($base_url . $foto['lokasi_file']) ?>" alt="<?= $foto['judul_foto'] ?>"
                    class="main-image">
            </div>

            <!-- Lightbox Container for Full-Size Image View -->
            <div id="lightbox-<?= $foto['id_foto'] ?>" class="lightbox"
                onclick="closeLightbox('lightbox-<?= $foto['id_foto'] ?>');">
                <img id="lightbox-image" src="<?= htmlspecialchars($base_url . $foto['lokasi_file']) ?>"
                    alt="Full Size Image">
            </div>


            <!-- Description -->
            <div class="mt-2">
                <b>Deksripsi</b>
                <p>
                    <?= $foto['deskripsi_foto'] ?>
                </p>
            </div>

            <!-- Like and Comment Buttons -->
            <div class="d-flex justify-content-between p-3">
                <!-- Like button with count -->
                <div class="input-group" style="width: auto;">
                    <a href="<?= $base_url ?>foto/like.php" class="btn btn-primary"
                        data-id_foto="<?= $foto['id_foto'] ?>" data-target="#like-count-<?= $foto['id_foto'] ?>"
                        id="like-btn" type="submit" name="like" onclick="like(event, this)">
                        <i class="fa-solid fa-heart <?= ($foto['is_like']) ? 'text-danger' : '' ?>"
                            id="like-icon-<?= $foto['id_foto'] ?>"></i> Like
                    </a>
                    <span class="input-group-text" id="like-count-<?= $foto['id_foto'] ?>">
                        <?php
                        $jumlah_like = mysqli_query($koneksi, "SELECT * FROM like_foto WHERE id_foto = '$id_foto'");
                        echo mysqli_num_rows($jumlah_like);
                        ?>
                    </span>
                </div>

                <!-- Comment button with count -->
                <div class="input-group" style="width: auto;">
                    <button class="btn btn-success" id="comment-btn"><i class="fa-solid fa-comment"></i>
                        Comment</button>
                    <span class="input-group-text" id="comment-count">
                        <?php
                        $jumlah_komen = mysqli_query($koneksi, "SELECT * FROM komentar_foto WHERE id_foto = '$id_foto'");
                        echo mysqli_num_rows($jumlah_komen);
                        ?>
                    </span>
                </div>
            </div>

            <!-- Comment textarea -->
            <div class="mt-2">
                <form action="komentar.php" method="POST">
                    <input type="hidden" name="id_foto" value="<?= $foto['id_foto'] ?>">
                    <textarea class="form-control" rows="3" name="isi_komentar" placeholder="Tambah Komentar"
                        required></textarea>
                    <div class="mt-1 text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Kirim Komentar</button>
                    </div>
                </form>
            </div>

            <!-- Additional Content (Comment Section) -->
            <div class="border comment-section mt-3 p-3" style="height: auto;">
                <?php
                $sql_komen = mysqli_query($koneksi, "SELECT * FROM komentar_foto INNER JOIN user ON komentar_foto.id_user = user.id_user WHERE komentar_foto.id_foto = '$id_foto'");
                while ($komen = mysqli_fetch_assoc($sql_komen)) {
                    ?>
                    <!-- Comment 3 -->
                    <div class="comment d-flex justify-content-between">
                        <div class="col-md-10 d-flex">
                            <div class="comment-avatar">
                                <img src="<?= $base_url ?>assets/avatar.png" alt="Avatar" class="rounded-circle"
                                    style="width: 40px; height: 40px;">
                            </div>
                            <div class="comment-content ms-3">
                                <h6 class="mb-1"><?= $komen['nama_lengkap'] ?><small class="text-muted">
                                        <?= $komen['tanggal_komentar'] ?></small></h6>
                                <p class="mb-0"><?= $komen['isi_komentar'] ?></p>
                            </div>
                        </div>
                        <div class="col-md-2 text-end">
                            <?php if ($_SESSION['id_user'] == $komen['id_user'] || $_SESSION['level'] == 'admin') { ?>
                                <a href="<?= $base_url ?>foto/hapus_komentar.php?id_foto=<?= $foto['id_foto'] ?>&id_komentar=<?= $komen['id_komentar'] ?>"
                                    onclick="return confirm('Anda yakin ingin menghapus komentar ini?')">
                                    <i class="fa-solid fa-trash"></i> </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
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
</script>

</html>