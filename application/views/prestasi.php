<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Prestasi Eskul</h1>
    <hr>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_prestasi"><i class="fas fa-plus-circle mr-2"></i>Tambah Prestasi</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Siswa</th>
                            <th>Nama Ekstrakurikuler</th>
                            <th>Foto</th>
                            <th>Deskripsi</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($prestasi as $item) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class=""><?= $item['nama'] ?></td>
                                <td class=""><?= $item['nama_eskul'] ?></td>
                                <td class="text-center">
                                    <a class="imgPopup" href="<?= base_url() . 'assets/img/prestasi/' . $item['foto']; ?>">
                                        <img src="<?= base_url() . 'assets/img/prestasi/' . $item['foto']; ?>" class="rounded" width="50" height="50" alt="Avatar" style="object-fit: cover;">
                                    </a>
                                </td>
                                <td class=""><?= $item['deskripsi']; ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Opsi">
                                        <a href="<?= base_url('prestasi/detail/' . $item['id_prestasi']) ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Detail Prestasi"><i class="fas fa-eye"></i></a>
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_prestasi-<?= $item['id_prestasi'] ?>" data-toggle="tooltip" data-placement="right" title="Edit Prestasi"><i class="fa fa-fw fa-edit"></i></a>
                                        <a href="<?= base_url('prestasi/hapus/' . $item['id_prestasi']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Prestasi ?')" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus Prestasi"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal tambah prestasi -->
<div class="modal fade" id="tambah_prestasi" tabindex="-1" role="dialog" aria-labelledby="tambah_prestasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_prestasiLabel">Tambah Prestasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('prestasi/tambah') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label for="id_siswa">Nama Siswa :</label>
                    <select name="id_siswa" id="id_siswa" class="form-control mb-3 <?= form_error('id_siswa') ? 'is-invalid' : '' ?>" required>
                        <option value="" selected disabled></option>
                        <?php foreach ($siswa as $item) { ?>
                            <option value="<?= $item['id_siswa'] ?>" <?= set_select('id_siswa', $item['id_siswa']); ?>><?= $item['nama'] ?></option>
                        <?php } ?>
                    </select>
                    <div id='id_siswa' class='invalid-feedback'>
                        <?= form_error('id_siswa') ?>
                    </div>
                    <label for="id_eskul">Nama Ekstrakurikuler :</label>
                    <select name="id_eskul" id="id_eskul" class="form-control mb-3 <?= form_error('id_eskul') ? 'is-invalid' : '' ?>" required>
                        <option value="" selected disabled></option>
                        <?php foreach ($eskul as $item) { ?>
                            <option value="<?= $item['id_eskul'] ?>" <?= set_select('id_eskul', $item['id_eskul']); ?>><?= $item['nama_eskul'] ?></option>
                        <?php } ?>
                    </select>
                    <div id='id_eskul' class='invalid-feedback'>
                        <?= form_error('id_eskul') ?>
                    </div>
                    <label for="foto">Foto :</label>
                    <input type="file" name="foto" value="<?= set_value('foto') ?>" class="form-control-file mb-3 <?= form_error('foto') ? 'is-invalid' : '' ?>" id="foto" required>
                    <div id='foto' class='invalid-feedback'>
                        <?= form_error('foto') ?>
                    </div>
                    <label for="deskripsi">Deskripsi :</label>
                    <textarea name="deskripsi" class="form-control mb-3 <?= form_error('deskripsi') ? 'is-invalid' : '' ?>" id="deskripsi" required><?= set_value('deskripsi') ?></textarea>
                    <div id='deskripsi' class='invalid-feedback'>
                        <?= form_error('deskripsi') ?>
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

<?php foreach ($prestasi as $item) { ?>
    <!-- Modal Edit Prestasi -->
    <div class="modal fade" id="edit_prestasi-<?= $item['id_prestasi'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_prestasi-<?= $item['id_prestasi'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_prestasi-<?= $item['id_prestasi'] ?>Label">Perbarui Prestasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('prestasi/ubah') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_prestasi" value="<?= $item['id_prestasi'] ?>">
                    <input type="hidden" name="foto_lama" value="<?= $item['foto'] ?>">
                    <div class="modal-body">
                        <label for="id_siswa">Nama Siswa :</label>
                        <select name="id_siswa" id="id_siswa" class="form-control mb-3 <?= form_error('id_siswa') ? 'is-invalid' : '' ?>" required>
                            <option value="" selected disabled></option>
                            <?php foreach ($siswa as $i) { ?>
                                <option value="<?= $i['id_siswa'] ?>" <?= set_select('id_siswa', $i['id_siswa'], $i['id_siswa'] == $item['id_siswa'] ? TRUE : FALSE); ?>><?= $i['nama'] ?></option>
                            <?php } ?>
                        </select>
                        <div id='id_siswa' class='invalid-feedback'>
                            <?= form_error('id_siswa') ?>
                        </div>
                        <label for="id_eskul">Nama Ekstrakurikuler :</label>
                        <select name="id_eskul" id="id_eskul" class="form-control mb-3 <?= form_error('id_eskul') ? 'is-invalid' : '' ?>" required>
                            <option value="" selected disabled></option>
                            <?php foreach ($eskul as $i) { ?>
                                <option value="<?= $i['id_eskul'] ?>" <?= set_select('id_eskul', $i['id_eskul'], $i['id_eskul'] == $item['id_eskul'] ? TRUE : FALSE); ?>><?= $i['nama_eskul'] ?></option>
                            <?php } ?>
                        </select>
                        <div id='id_eskul' class='invalid-feedback'>
                            <?= form_error('id_eskul') ?>
                        </div>
                        <label for="foto">Foto :</label>
                        <input type="file" name="foto" value="<?= set_value('foto', $item['foto']) ?>" class="form-control-file mb-3 <?= form_error('foto') ? 'is-invalid' : '' ?>" id="foto">
                        <div id='foto' class='invalid-feedback'>
                            <?= form_error('foto') ?>
                        </div>
                        <label for="deskripsi">Deskripsi :</label>
                        <textarea name="deskripsi" class="form-control mb-3 <?= form_error('deskripsi') ? 'is-invalid' : '' ?>" id="deskripsi" required><?= set_value('deskripsi', $item['deskripsi']) ?></textarea>
                        <div id='deskripsi' class='invalid-feedback'>
                            <?= form_error('deskripsi') ?>
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