<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Nilai</h1>
    <hr>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php if ($this->session->userdata('login_as') != 'siswa') : ?>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_nilai"><i class="fas fa-plus-circle mr-2"></i>Tambah Nilai</button>
            <?php endif ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="nilaiTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Siswa</th>
                            <th>Nama Ekstrakurikuler</th>
                            <th>Skor</th>
                            <?php if ($this->session->userdata('login_as') != 'siswa') : ?>
                                <th>Opsi</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($nilai as $item) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class=""><?= $item['nama'] ?></td>
                                <td class=""><?= $item['nama_eskul'] ?></td>
                                <td class="text-center"><?= $item['skor'] ?></td>
                                <?php if ($this->session->userdata('login_as') != 'siswa') : ?>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Opsi">
                                            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_nilai-<?= $item['id_nilai'] ?>" data-toggle="tooltip" data-placement="right" title="Edit Nilai"><i class="fa fa-fw fa-edit"></i></a>
                                            <a href="<?= base_url('nilai/hapus/' . $item['id_nilai']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Nilai ?')" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus Nilai"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal tambah nilai -->
<div class="modal fade" id="tambah_nilai" tabindex="-1" role="dialog" aria-labelledby="tambah_nilaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_nilaiLabel">Tambah Nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('nilai/tambah') ?>" method="post">
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
                    <label for="skor">Skor :</label>
                    <input type="text" name="skor" value="<?= set_value('skor') ?>" class="form-control mb-3 <?= form_error('skor') ? 'is-invalid' : '' ?>" id="skor" required>
                    <div id='skor' class='invalid-feedback'>
                        <?= form_error('skor') ?>
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

<?php foreach ($nilai as $item) { ?>
    <!-- Modal Edit Nilai -->
    <div class="modal fade" id="edit_nilai-<?= $item['id_nilai'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_nilai-<?= $item['id_nilai'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_nilai-<?= $item['id_nilai'] ?>Label">Perbarui Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('nilai/ubah') ?>" method="post">
                    <input type="hidden" name="id_nilai" value="<?= $item['id_nilai'] ?>">
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
                        <label for="skor">Skor :</label>
                        <input type="text" name="skor" value="<?= set_value('skor', $item['skor']) ?>" class="form-control mb-3 <?= form_error('skor') ? 'is-invalid' : '' ?>" id="skor" required>
                        <div id='skor' class='invalid-feedback'>
                            <?= form_error('skor') ?>
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