<div class="card p-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Data Berita</h4>
        <a href="berita.php?action=tambah" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Berita
        </a>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal DESC");
        while ($data = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['judul'] ?></td>
            <td><?= $data['tanggal'] ?></td>
            <td>
                <a href="berita.php?action=edit&id=<?= $data['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="berita.php?action=hapus&id=<?= $data['id'] ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin ingin menghapus?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>