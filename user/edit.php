<!-- Modal -->
<div class="modal fade" id="edit<?= $data['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $base_url ?>user/update.php" method="POST">
                    <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $data['username'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" name="password" value="<?= $data['password'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" value="<?= $data['nama_lengkap'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?= $data['alamat'] ?>" required>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
            </div>
            </form>
        </div>
    </div>
</div>