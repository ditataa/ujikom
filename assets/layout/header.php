<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Navbar brand (Website name on the right) -->
        <a href="<?php echo $base_url  ?>home.php" class="navbar-brand ms-auto"><i class="fa-solid fa-image"></i> Gallery</a>

        <!-- Navbar items -->
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url  ?>home.php">Home</a>
                </li>
                <?php if ($_SESSION['level'] == 'admin') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url  ?>user/user.php">User</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url  ?>album/album.php?id_user=<?= $_SESSION['id_user'] ?>">My Album</a>
                </li>
                <!-- User dropdown menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hello, <?= $_SESSION['nama_lengkap'] ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="<?php echo $base_url  ?>profile/profile.php?id_user=<?= $_SESSION['id_user'] ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="<?php echo $base_url  ?>auth/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
