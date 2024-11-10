<!-- Modal -->
<div class="modal fade" id="edit<?= $foto['id_foto'] ?>" tabindex="-1" aria-labelledby="modal_tambahLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $base_url ?>foto/update.php" method="POST">
                    <input type="hidden" name="id_album" value="<?= $foto['id_album'] ?>">
                    <input type="hidden" name="id_foto" value="<?= $foto['id_foto'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Judul Foto</label>
                        <input type="text" class="form-control" name="judul_foto" value="<?= $foto['judul_foto'] ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deksripsi Foto</label>
                        <input type="text" class="form-control" name="deskripsi_foto" value="<?= $foto['deskripsi_foto'] ?>" required>
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