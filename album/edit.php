<!-- Modal -->
<div class="modal fade" id="edit<?= $data['id_album'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $base_url ?>album/update.php" method="POST">
                    <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                    <input type="hidden" name="id_album" value="<?= $data['id_album'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Nama Album</label>
                        <input type="text" class="form-control" name="nama_album" value="<?= $data['nama_album'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deksripsi</label>
                        <input type="text" class="form-control" name="deskripsi" value="<?= $data['deskripsi'] ?>" required>
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