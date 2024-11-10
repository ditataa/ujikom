<!-- Modal -->
<div class="modal fade" id="edit<?= $user['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $base_url ?>profile/update.php" method="POST">
                    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $user['username'] ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" name="password" value="<?= $user['password'] ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" value="<?= $user['nama_lengkap'] ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?= $user['alamat'] ?>" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
            </div>
            </form>
        </div>
    </div>
</div>