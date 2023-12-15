<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Pengumuman</h1>
    <hr>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_pengumuman"><i class="fas fa-plus-circle mr-2"></i>Tambah Pengumuman</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Judul Pengumuman</th>
                            <th>Isi Pengumuman</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pengumuman as $item) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class=""><?= $item['judul'] ?></td>
                                <td class=""><?= $item['isi_pengumuman'] ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Opsi">
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_pengumuman-<?= $item['id_pengumuman'] ?>" data-toggle="tooltip" data-placement="right" title="Edit Pengumuman"><i class="fa fa-fw fa-edit"></i></a>
                                        <a href="<?= base_url('pengumuman/hapus/' . $item['id_pengumuman']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Pengumuman ?')" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus Pengumuman"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal tambah pengumuman -->
<div class="modal fade" id="tambah_pengumuman" tabindex="-1" role="dialog" aria-labelledby="tambah_pengumumanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_pengumumanLabel">Tambah Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pengumuman/tambah') ?>" method="post">
                <div class="modal-body">
                    <label for="judul">Judul Pengumuman :</label>
                    <input type="text" name="judul" value="<?= set_value('judul') ?>" class="form-control mb-3 <?= form_error('judul') ? 'is-invalid' : '' ?>" id="judul" required>
                    <div id='judul' class='invalid-feedback'>
                        <?= form_error('judul') ?>
                    </div>
                    <label for="isi_pengumuman">Isi Pengumuman :</label>
                    <textarea name="isi_pengumuman" class="form-control mb-3 <?= form_error('isi_pengumuman') ? 'is-invalid' : '' ?>" id="isi_pengumuman" required><?= set_value('isi_pengumuman') ?></textarea>
                    <div id='isi_pengumuman' class='invalid-feedback'>
                        <?= form_error('isi_pengumuman') ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                    <input type="submit" value="Simpan" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($pengumuman as $item) { ?>
    <!-- Modal Edit Pengumuman -->
    <div class="modal fade" id="edit_pengumuman-<?= $item['id_pengumuman'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_pengumuman-<?= $item['id_pengumuman'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_pengumuman-<?= $item['id_pengumuman'] ?>Label">Perbarui Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('pengumuman/ubah') ?>" method="post">
                    <input type="hidden" name="id_pengumuman" value="<?= $item['id_pengumuman'] ?>">
                    <div class="modal-body">
                        <label for="judul">Judul Pengumuman :</label>
                        <input type="text" name="judul" value="<?= set_value('judul', $item['judul']) ?>" class="form-control mb-3 <?= form_error('judul') ? 'is-invalid' : '' ?>" id="judul" required>
                        <div id='judul' class='invalid-feedback'>
                            <?= form_error('judul') ?>
                        </div>
                        <label for="isi_pengumuman">Isi Pengumuman :</label>
                        <textarea name="isi_pengumuman" class="form-control mb-3 <?= form_error('isi_pengumuman') ? 'is-invalid' : '' ?>" id="isi_pengumuman" required><?= set_value('isi_pengumuman', $item['isi_pengumuman']) ?></textarea>
                        <div id='isi_pengumuman' class='invalid-feedback'>
                            <?= form_error('isi_pengumuman') ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Tutup</button>
                        <input type="submit" value="Simpan Perubahan" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

</div>