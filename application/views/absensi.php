<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Absensi</h1>
    <hr>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php if ($this->session->userdata('login_as') != 'siswa') : ?>
                <a href="<?= base_url('absensi/tambah_absensi') ?>" class="btn btn-sm btn-primary"><i class="fas fa-camera mr-2"></i>Scan/Tambah Absensi</a>
            <?php endif ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Waktu</th>
                            <!-- <th>Foto</th> -->
                            <th>Keterangan</th>
                            <?php if ($this->session->userdata('login_as') != 'siswa') : ?>
                                <th>Opsi</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($absensi as $item) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class=""><?= $item['nama'] ?></td>
                                <td class="text-center"><?= date('d M Y H:i', strtotime($item['tanggal_waktu'])) ?></td>
                                <!-- <td class="text-center">
                                    <a class="imgPopup" href="<?= base_url() . 'assets/img/absensi/' . $item['foto']; ?>">
                                        <img src="<?= base_url() . 'assets/img/absensi/' . $item['foto']; ?>" class="rounded" width="50" height="50" alt="Avatar" style="object-fit: cover;">
                                    </a>
                                </td> -->
                                <td class=""><?= $item['keterangan'] ?></td>

                                <?php if ($this->session->userdata('login_as') != 'siswa') : ?>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Opsi">
                                            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_absensi-<?= $item['id_absensi'] ?>" data-toggle="tooltip" data-placement="right" title="Edit Absensi"><i class="fa fa-fw fa-edit"></i></a>
                                            <a href="<?= base_url('absensi/hapus/' . $item['id_absensi']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Absensi ?')" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus Absensi"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal tambah absensi -->
<div class="modal fade" id="tambah_absensi" tabindex="-1" role="dialog" aria-labelledby="tambah_absensiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_absensiLabel">Tambah Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('absensi/tambah') ?>" method="post" enctype="multipart/form-data">
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
                    <label for="tanggal_waktu">Tanggal Waktu :</label>
                    <input type="datetime-local" name="tanggal_waktu" value="<?= set_value('tanggal_waktu') ?>" class="form-control mb-3 <?= form_error('tanggal_waktu') ? 'is-invalid' : '' ?>" id="tanggal_waktu" required>
                    <div id='tanggal_waktu' class='invalid-feedback'>
                        <?= form_error('tanggal_waktu') ?>
                    </div>
                    <label for="foto">Foto :</label>
                    <input type="file" name="foto" value="<?= set_value('foto') ?>" class="form-control-file mb-3 <?= form_error('foto') ? 'is-invalid' : '' ?>" id="foto" required>
                    <div id='foto' class='invalid-feedback'>
                        <?= form_error('foto') ?>
                    </div>
                    <label for="keterangan">Keterangan :</label>
                    <textarea name="keterangan" class="form-control mb-3 <?= form_error('keterangan') ? 'is-invalid' : '' ?>" id="keterangan"><?= set_value('keterangan') ?></textarea>
                    <div id='keterangan' class='invalid-feedback'>
                        <?= form_error('keterangan') ?>
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

<?php foreach ($absensi as $item) { ?>
    <!-- Modal Edit Absensi -->
    <div class="modal fade" id="edit_absensi-<?= $item['id_absensi'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_absensi-<?= $item['id_absensi'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_absensi-<?= $item['id_absensi'] ?>Label">Perbarui Absensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('absensi/ubah') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_absensi" value="<?= $item['id_absensi'] ?>">
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
                        <label for="tanggal_waktu">Tanggal Waktu :</label>
                        <input type="datetime-local" name="tanggal_waktu" value="<?= set_value('tanggal_waktu', $item['tanggal_waktu']) ?>" class="form-control mb-3 <?= form_error('tanggal_waktu') ? 'is-invalid' : '' ?>" id="tanggal_waktu" required>
                        <div id='tanggal_waktu' class='invalid-feedback'>
                            <?= form_error('tanggal_waktu') ?>
                        </div>
                        <!-- <label for="foto">Foto :</label>
                        <input type="file" name="foto" value="<?= set_value('foto', $item['foto']) ?>" class="form-control-file mb-3 <?= form_error('foto') ? 'is-invalid' : '' ?>" id="foto">
                        <div id='foto' class='invalid-feedback'>
                            <?= form_error('foto') ?>
                        </div> -->
                        <label for="keterangan">Keterangan :</label>
                        <textarea name="keterangan" class="form-control mb-3 <?= form_error('keterangan') ? 'is-invalid' : '' ?>" id="keterangan"><?= set_value('keterangan', $item['keterangan']) ?></textarea>
                        <div id='keterangan' class='invalid-feedback'>
                            <?= form_error('keterangan') ?>
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