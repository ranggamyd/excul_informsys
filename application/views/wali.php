<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Wali</h1>
    <hr>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_wali"><i class="fas fa-plus-circle mr-2"></i>Tambah Wali</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Foto</th>
                            <th>Nama Wali</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>No. HP</th>
                            <th>TTL</th>
                            <th>Alamat</th>
                            <th>Agama</th>
                            <th>Username</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($wali as $item) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center">
                                    <a class="imgPopup" href="<?= base_url() . 'assets/img/wali/' . $item['foto']; ?>">
                                        <img src="<?= base_url() . 'assets/img/wali/' . $item['foto']; ?>" class="rounded-circle" width="50" height="50" alt="Avatar" style="object-fit: cover;">
                                    </a>
                                </td>
                                <td class=""><?= $item['nama'] ?></td>
                                <td class=""><?= $item['nama'] ?></td>
                                <td class="text-center"><?= $item['jk'] ?></td>
                                <td class="text-center"><?= $item['no_hp'] ?></td>
                                <td class="text-center"><?= $item['tempat_lahir'] ?>, <?= date('d M Y', strtotime($item['tanggal_lahir'])) ?></td>
                                <td class="text-center"><?= $item['alamat'] ?></td>
                                <td class="text-center"><?= $item['agama'] ?></td>
                                <td class="text-center"><?= $item['username'] ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Opsi">
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_wali-<?= $item['id_wali'] ?>" data-toggle="tooltip" data-placement="right" title="Edit Wali"><i class="fa fa-fw fa-edit"></i></a>
                                        <a href="<?= base_url('wali/hapus/' . $item['id_wali']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Wali ?')" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus Wali"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal tambah wali -->
<div class="modal fade" id="tambah_wali" tabindex="-1" role="dialog" aria-labelledby="tambah_waliLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_waliLabel">Tambah Wali</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('wali/tambah') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="nama">Nama Wali :</label>
                            <input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control mb-3 <?= form_error('nama') ? 'is-invalid' : '' ?>" id="nama" required>
                            <div id='nama' class='invalid-feedback'>
                                <?= form_error('nama') ?>
                            </div>
                            <label for="id_siswa">Siswa :</label>
                            <select name="id_siswa" id="id_siswa" class="form-control mb-3 <?= form_error('id_siswa') ? 'is-invalid' : '' ?>" required>
                                <option hidden></option>
                                <?php foreach ($siswa as $item) : ?>
                                    <option value="<?= $item['id_siswa'] ?>" <?= set_select('id_siswa', $item['id_siswa']); ?>><?= $item['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div id='id_siswa' class='invalid-feedback'>
                                <?= form_error('id_siswa') ?>
                            </div>
                            <label for="jk">Jenis Kelamin :</label>
                            <select name="jk" id="jk" class="form-control mb-3 <?= form_error('jk') ? 'is-invalid' : '' ?>">
                                <option value="" selected disabled></option>
                                <option value="laki-laki" <?= set_select('jk', 'laki-laki'); ?>>laki-laki</option>
                                <option value="perempuan" <?= set_select('jk', 'perempuan'); ?>>perempuan</option>
                            </select>
                            <div id='jk' class='invalid-feedback'>
                                <?= form_error('jk') ?>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="tempat_lahir">Tempat Lahir :</label>
                                    <input type="text" name="tempat_lahir" value="<?= set_value('tempat_lahir') ?>" class="form-control mb-3 <?= form_error('tempat_lahir') ? 'is-invalid' : '' ?>" id="tempat_lahir">
                                    <div id='tempat_lahir' class='invalid-feedback'>
                                        <?= form_error('tempat_lahir') ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="tanggal_lahir">Tanggal Lahir :</label>
                                    <input type="date" name="tanggal_lahir" value="<?= set_value('tanggal_lahir') ?>" class="form-control mb-3 <?= form_error('tanggal_lahir') ? 'is-invalid' : '' ?>" id="tanggal_lahir">
                                    <div id='tanggal_lahir' class='invalid-feedback'>
                                        <?= form_error('tanggal_lahir') ?>
                                    </div>
                                </div>
                            </div>
                            <label for="agama">Agama :</label>
                            <input type="text" name="agama" value="<?= set_value('agama') ?>" class="form-control mb-3 <?= form_error('agama') ? 'is-invalid' : '' ?>" id="agama">
                            <div id='agama' class='invalid-feedback'>
                                <?= form_error('agama') ?>
                            </div>
                            <label for="no_hp">No. HP :</label>
                            <input type="text" name="no_hp" value="<?= set_value('no_hp') ?>" class="form-control mb-3 <?= form_error('no_hp') ? 'is-invalid' : '' ?>" id="no_hp" required>
                            <div id='no_hp' class='invalid-feedback'>
                                <?= form_error('no_hp') ?>
                            </div>
                            <label for="alamat">Alamat :</label>
                            <textarea name="alamat" class="form-control mb-3 <?= form_error('alamat') ? 'is-invalid' : '' ?>" id="alamat"><?= set_value('alamat') ?></textarea>
                            <div id='alamat' class='invalid-feedback'>
                                <?= form_error('alamat') ?>
                            </div>
                        </div>
                        <div class="col">
                            <label for="username">Username :</label>
                            <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control mb-3 <?= form_error('username') ? 'is-invalid' : '' ?>" id="username" required>
                            <div id='username' class='invalid-feedback'>
                                <?= form_error('username') ?>
                            </div>
                            <label for="password">Password :</label>
                            <input type="text" name="password" value="<?= set_value('password') ?>" class="form-control mb-3 <?= form_error('password') ? 'is-invalid' : '' ?>" id="password" required>
                            <div id='password' class='invalid-feedback'>
                                <?= form_error('password') ?>
                            </div>
                            <label for="foto">Foto :</label>
                            <input type="file" name="foto" class="form-control-file mb-3 <?= form_error('foto') ? 'is-invalid' : '' ?>" id="foto">
                            <div id='foto' class='invalid-feedback'>
                                <?= form_error('foto') ?>
                            </div>
                        </div>
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

<?php foreach ($wali as $item) { ?>
    <!-- Modal Edit Wali -->
    <div class="modal fade" id="edit_wali-<?= $item['id_wali'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_wali-<?= $item['id_wali'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_wali-<?= $item['id_wali'] ?>Label">Perbarui Wali</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('wali/ubah') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_wali" value="<?= $item['id_wali'] ?>">
                    <input type="hidden" name="foto_lama" value="<?= $item['foto'] ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="nama">Nama Wali :</label>
                                <input type="text" name="nama" value="<?= set_value('nama', $item['nama']) ?>" class="form-control mb-3 <?= form_error('nama') ? 'is-invalid' : '' ?>" id="nama" required>
                                <div id='nama' class='invalid-feedback'>
                                    <?= form_error('nama') ?>
                                </div>
                                <label for="id_siswa">Siswa :</label>
                                <select name="id_siswa" id="id_siswa" class="form-control mb-3 <?= form_error('id_siswa') ? 'is-invalid' : '' ?>" required>
                                    <option hidden></option>
                                    <?php foreach ($siswa as $item) : ?>
                                        <option value="<?= $item['id_siswa'] ?>" <?= set_select('id_siswa', $item['id_siswa']); ?>><?= $item['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div id='id_siswa' class='invalid-feedback'>
                                    <?= form_error('id_siswa') ?>
                                </div>
                                <label for="jk">Jenis Kelamin :</label>
                                <select name="jk" id="jk" class="form-control mb-3 <?= form_error('jk') ? 'is-invalid' : '' ?>">
                                    <option value="" selected disabled></option>
                                    <option value="laki-laki" <?= set_select('jk', 'laki-laki', $item['jk'] == 'laki-laki' ? TRUE : FALSE) ?>>laki-laki</option>
                                    <option value="perempuan" <?= set_select('jk', 'perempuan', $item['jk'] == 'perempuan' ? TRUE : FALSE) ?>>perempuan</option>
                                </select>
                                <div id='jk' class='invalid-feedback'>
                                    <?= form_error('jk') ?>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="tempat_lahir">Tempat Lahir :</label>
                                        <input type="text" name="tempat_lahir" value="<?= set_value('tempat_lahir', $item['tempat_lahir']) ?>" class="form-control mb-3 <?= form_error('tempat_lahir') ? 'is-invalid' : '' ?>" id="tempat_lahir">
                                        <div id='tempat_lahir' class='invalid-feedback'>
                                            <?= form_error('tempat_lahir') ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="tanggal_lahir">Tanggal Lahir :</label>
                                        <input type="date" name="tanggal_lahir" value="<?= set_value('tanggal_lahir', $item['tanggal_lahir']) ?>" class="form-control mb-3 <?= form_error('tanggal_lahir') ? 'is-invalid' : '' ?>" id="tanggal_lahir">
                                        <div id='tanggal_lahir' class='invalid-feedback'>
                                            <?= form_error('tanggal_lahir') ?>
                                        </div>
                                    </div>
                                </div>
                                <label for="agama">Agama :</label>
                                <input type="text" name="agama" value="<?= set_value('agama', $item['agama']) ?>" class="form-control mb-3 <?= form_error('agama') ? 'is-invalid' : '' ?>" id="agama">
                                <div id='agama' class='invalid-feedback'>
                                    <?= form_error('agama') ?>
                                </div>
                                <label for="no_hp">No. HP :</label>
                                <input type="text" name="no_hp" value="<?= set_value('no_hp', $item['no_hp']) ?>" class="form-control mb-3 <?= form_error('no_hp') ? 'is-invalid' : '' ?>" id="no_hp" required>
                                <div id='no_hp' class='invalid-feedback'>
                                    <?= form_error('no_hp') ?>
                                </div>
                                <label for="alamat">Alamat :</label>
                                <textarea name="alamat" class="form-control mb-3 <?= form_error('alamat') ? 'is-invalid' : '' ?>" id="alamat"><?= set_value('alamat', $item['alamat']) ?></textarea>
                                <div id='alamat' class='invalid-feedback'>
                                    <?= form_error('alamat') ?>
                                </div>
                            </div>
                            <div class="col">
                                <label for="username">Username :</label>
                                <input type="text" name="username" value="<?= set_value('username', $item['username']) ?>" class="form-control mb-3 <?= form_error('username') ? 'is-invalid' : '' ?>" id="username" required>
                                <div id='username' class='invalid-feedback'>
                                    <?= form_error('username') ?>
                                </div>
                                <label for="password">Password :</label><small class="text-muted float-right">(Kosongkan jika tidak ada perubahan)</small>
                                <input type="text" name="password" value="" class="form-control mb-3 <?= form_error('password') ? 'is-invalid' : '' ?>" id="password">
                                <div id='password' class='invalid-feedback'>
                                    <?= form_error('password') ?>
                                </div>
                                <label for="foto">Foto :</label>
                                <input type="file" name="foto" value="<?= set_value('foto', $item['foto']) ?>" class="form-control-file mb-3 <?= form_error('foto') ? 'is-invalid' : '' ?>" id="foto">
                                <div id='foto' class='invalid-feedback'>
                                    <?= form_error('foto') ?>
                                </div>
                            </div>
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

<script>
    $("#nis").keyup(function(e) {
        $("#username").val($(this).val());
    });
</script>