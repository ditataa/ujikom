<?php
session_start();
include 'koneksi.php';
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

    <?php include 'assets/layout/css.php' ?>

</head>

<body>
    <?php include "assets/layout/header.php" ?>

    <div class="card container mt-4">
        <div class="container">
            <div class="row">

                <?php
                $q = "select
                    a.*,
                    b.*,
                    c.*,
                    COUNT(distinct d.id_like) as jml_like,
                    COUNT(distinct e.id_komentar) as jml_komentar,
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
                join
                    album as b on
                    b.id_album = a.id_album
                join
                    user as c on
                    c.id_user = b.id_user
                left join
                    like_foto as d on
                    d.id_foto = a.id_foto
                left join
                    komentar_foto as e on
                    e.id_foto = a.id_foto
                group by
                    a.id_foto
                order by
                    a.tanggal_unggah desc";
                $sql = mysqli_query($koneksi, $q);
                while ($foto = mysqli_fetch_array($sql)) {
                    ?>
                    <div class="col-md-3 p-2">
                        <div class="card mt-4">
                            <!-- Caption above the image -->
                            <div class="image-caption">
                                <?= htmlspecialchars($foto['judul_foto']) ?> - <?= htmlspecialchars($foto['nama_album']) ?>
                            </div>

                            <!-- Hover container wraps both image and buttons -->
                            <div class="image-hover-container">
                                <!-- Image with hover effect -->
                                <img src="<?= htmlspecialchars($base_url . $foto['lokasi_file']) ?>" class="card-img-top"
                                    alt="<?= htmlspecialchars($foto['judul_foto']) ?>">

                                <!-- Lightbox Container for Full-Size Image View -->
                                <div id="lightbox-<?= $foto['id_foto'] ?>" class="lightbox"
                                    onclick="closeLightbox('lightbox-<?= $foto['id_foto'] ?>');">
                                    <img id="lightbox-image" src="<?= htmlspecialchars($base_url . $foto['lokasi_file']) ?>"
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
                            <!-- Like and Comment buttons -->
                            <div class="d-flex justify-content-between p-3">
                                <!-- Like button group on the left -->
                                <div class="input-group" style="width: auto;">
                                    <!-- <button class="btn btn-primary" id="like-btn"><i class="fa-solid fa-heart <?= $foto['is_like'] ? 'text-danger' : '' ?>"></i></button> -->
                                    <a href="<?= $base_url ?>foto/like.php" class="btn btn-primary"
                                        data-id_foto="<?= $foto['id_foto'] ?>"
                                        data-target="#like-count-<?= $foto['id_foto'] ?>" id="like-btn" type="submit"
                                        name="like" onclick="like(event, this)">
                                        <i class="fa-solid fa-heart <?= ($foto['is_like']) ? 'text-danger' : '' ?>"
                                            id="like-icon-<?= $foto['id_foto'] ?>"></i>
                                    </a>
                                    <span class="input-group-text"
                                        id="like-count-<?= $foto['id_foto'] ?>"><?= $foto['jml_like'] ?></span>
                                </div>

                                <!-- Comment button group on the right -->
                                <div class="input-group" style="width: auto;">
                                    <span class="input-group-text" id="comment-count"><?= $foto['jml_komentar'] ?>
                                    </span>
                                    <a href="<?= $base_url ?>foto/detailfoto.php?id_foto=<?= $foto['id_foto'] ?>"
                                        class="btn btn-success" id="comment-btn"><i class="fa-solid fa-comment"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
<?php include 'assets/layout/script.php' ?>
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
    });
</script>

</html>