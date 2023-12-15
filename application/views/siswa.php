<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Data Siswa</h1>
  <hr>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_siswa"><i class="fas fa-plus-circle mr-2"></i>Tambah Siswa</button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="text-center">
            <tr>
              <th class="text-center">No.</th>
              <th>Foto</th>
              <th>NIS</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <th>Jurusan</th>
              <th>QR Code</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($siswa as $item) : ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td class="text-center">
                  <a class="imgPopup" href="<?= base_url() . 'assets/img/siswa/' . $item['foto']; ?>">
                    <img src="<?= base_url() . 'assets/img/siswa/' . $item['foto']; ?>" class="rounded-circle" width="50" height="50" alt="Avatar" style="object-fit: cover;">
                  </a>
                </td>
                <td class="text-center"><?= $item['nis']; ?></td>
                <td class=""><?= $item['nama'] ?></td>
                <td class="text-center"><?= $item['kelas'] ?></td>
                <td class="text-center"><?= $item['jurusan'] ?></td>
                <td class="text-center"><img src="<?= base_url() . 'assets/img/siswa/qr/' . $item['qr_code']; ?>" width="50" height="50" alt="QR Code"></td>
                <td class="text-center">
                  <div class="btn-group" role="group" aria-label="Opsi">
                    <a href="<?= base_url('siswa/detail/' . $item['id_siswa']) ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_siswa-<?= $item['id_siswa'] ?>" data-toggle="tooltip" data-placement="right" title="Edit Siswa"><i class="fa fa-fw fa-edit"></i></a>
                    <a href="<?= base_url('siswa/hapus/' . $item['id_siswa']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Siswa ?')" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus Siswa"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal tambah siswa -->
<div class="modal fade" id="tambah_siswa" tabindex="-1" role="dialog" aria-labelledby="tambah_siswaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambah_siswaLabel">Tambah Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('siswa/tambah') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <label for="nis">NIS :</label>
              <input type="text" name="nis" value="<?= set_value('nis') ?>" class="form-control mb-3 <?= form_error('nis') ? 'is-invalid' : '' ?>" id="nis" required>
              <div id='nis' class='invalid-feedback'>
                <?= form_error('nis') ?>
              </div>
              <label for="nama">Nama Siswa :</label>
              <input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control mb-3 <?= form_error('nama') ? 'is-invalid' : '' ?>" id="nama" required>
              <div id='nama' class='invalid-feedback'>
                <?= form_error('nama') ?>
              </div>
              <div class="row">
                <div class="col">
                  <label for="kelas">Kelas :</label>
                  <input type="number" min="10" max="12" name="kelas" value="<?= set_value('kelas') ?>" class="form-control mb-3 <?= form_error('kelas') ? 'is-invalid' : '' ?>" id="kelas" required>
                  <div id='kelas' class='invalid-feedback'>
                    <?= form_error('kelas') ?>
                  </div>
                </div>
                <div class="col">
                  <label for="jurusan">Jurusan :</label>
                  <select name="jurusan" id="jurusan" class="form-control mb-3 <?= form_error('jurusan') ? 'is-invalid' : '' ?>" required>
                    <option value="" selected disabled></option>
                    <option value="bdp" <?= set_select('jurusan', 'bdp'); ?>>bdp</option>
                    <option value="otkp" <?= set_select('jurusan', 'otkp'); ?>>otkp</option>
                    <option value="fkk" <?= set_select('jurusan', 'fkk'); ?>>fkk</option>
                    <option value="mm" <?= set_select('jurusan', 'mm'); ?>>mm</option>
                    <option value="tkj" <?= set_select('jurusan', 'tkj'); ?>>tkj</option>
                    <option value="dkv" <?= set_select('jurusan', 'dkv'); ?>>dkv</option>
                    <option value="tb" <?= set_select('jurusan', 'tb'); ?>>tb</option>
                  </select>
                  <div id='jurusan' class='invalid-feedback'>
                    <?= form_error('jurusan') ?>
                  </div>
                </div>
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
              <label for="no_hp">No. HP Orang Tua:</label>
              <input type="text" name="no_hp" value="<?= set_value('no_hp') ?>" class="form-control mb-3 <?= form_error('no_hp') ? 'is-invalid' : '' ?>" id="no_hp">
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
              <label for="password">Password :</label><small class="float-right">(Default password sama dengan NIS)</small>
              <input type="text" name="password" value="<?= set_value('password') ?>" class="form-control mb-3 <?= form_error('password') ? 'is-invalid' : '' ?>" id="password">
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

<?php foreach ($siswa as $item) { ?>
  <!-- Modal Edit Siswa -->
  <div class="modal fade" id="edit_siswa-<?= $item['id_siswa'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_siswa-<?= $item['id_siswa'] ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit_siswa-<?= $item['id_siswa'] ?>Label">Perbarui Siswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('siswa/ubah') ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_siswa" value="<?= $item['id_siswa'] ?>">
          <input type="hidden" name="foto_lama" value="<?= $item['foto'] ?>">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <label for="nis">NIS :</label>
                <input type="text" name="nis" value="<?= set_value('nis', $item['nis']) ?>" class="form-control mb-3 <?= form_error('nis') ? 'is-invalid' : '' ?>" id="nis" required>
                <div id='nis' class='invalid-feedback'>
                  <?= form_error('nis') ?>
                </div>
                <label for="nama">Nama Siswa :</label>
                <input type="text" name="nama" value="<?= set_value('nama', $item['nama']) ?>" class="form-control mb-3 <?= form_error('nama') ? 'is-invalid' : '' ?>" id="nama" required>
                <div id='nama' class='invalid-feedback'>
                  <?= form_error('nama') ?>
                </div>
                <div class="row">
                  <div class="col">
                    <label for="kelas">Kelas :</label>
                    <input type="number" min="10" max="12" name="kelas" value="<?= set_value('kelas', $item['kelas']) ?>" class="form-control mb-3 <?= form_error('kelas') ? 'is-invalid' : '' ?>" id="kelas" required>
                    <div id='kelas' class='invalid-feedback'>
                      <?= form_error('kelas') ?>
                    </div>
                  </div>
                  <div class="col">
                    <label for="jurusan">Jurusan :</label>
                    <select name="jurusan" id="jurusan" class="form-control mb-3 <?= form_error('jurusan') ? 'is-invalid' : '' ?>" required>
                      <option value="" selected disabled></option>
                      <option value="bdp" <?= set_select('jurusan', 'bdp', $item['jurusan'] == 'bdp' ? TRUE : FALSE); ?>>bdp</option>
                      <option value="otkp" <?= set_select('jurusan', 'otkp', $item['jurusan'] == 'otkp' ? TRUE : FALSE); ?>>otkp</option>
                      <option value="fkk" <?= set_select('jurusan', 'fkk', $item['jurusan'] == 'fkk' ? TRUE : FALSE); ?>>fkk</option>
                      <option value="mm" <?= set_select('jurusan', 'mm', $item['jurusan'] == 'mm' ? TRUE : FALSE); ?>>mm</option>
                      <option value="tkj" <?= set_select('jurusan', 'tkj', $item['jurusan'] == 'tkj' ? TRUE : FALSE); ?>>tkj</option>
                      <option value="dkv" <?= set_select('jurusan', 'dkv', $item['jurusan'] == 'dkv' ? TRUE : FALSE); ?>>dkv</option>
                      <option value="tb" <?= set_select('jurusan', 'tb', $item['jurusan'] == 'tb' ? TRUE : FALSE); ?>>tb</option>
                    </select>
                    <div id='jurusan' class='invalid-feedback'>
                      <?= form_error('jurusan') ?>
                    </div>
                  </div>
                </div>
                <label for="jk">Jenis Kelamin :</label>
                <select name="jk" id="jk" class="form-control mb-3 <?= form_error('jk') ? 'is-invalid' : '' ?>">
                  <option value="" selected disabled></option>
                  <option value="laki-laki" <?= set_select('jk', 'laki-laki', $item['jk'] == 'laki-laki' ? TRUE : FALSE); ?>>laki-laki</option>
                  <option value="perempuan" <?= set_select('jk', 'perempuan', $item['jk'] == 'perempuan' ? TRUE : FALSE); ?>>perempuan</option>
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
                <label for="no_hp">No. HP Orang Tua:</label>
                <input type="text" name="no_hp" value="<?= set_value('no_hp', $item['no_hp']) ?>" class="form-control mb-3 <?= form_error('no_hp') ? 'is-invalid' : '' ?>" id="no_hp">
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