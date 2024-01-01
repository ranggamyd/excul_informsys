<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Data Guru</h1>
  <hr>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_guru"><i class="fas fa-plus-circle mr-2"></i>Tambah Guru</button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="text-center">
            <tr>
              <th class="text-center">No.</th>
              <th>NIP</th>
              <th>Nama Guru</th>
              <th>Jenis Kelamin</th>
              <th>Username</th>
              <th>Role</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($guru as $item) : ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td class="text-center"><?= $item['nip']; ?></td>
                <td class=""><?= $item['nama'] ?></td>
                <td class="text-center"><?= $item['jk'] ?></td>
                <td class="text-center"><?= $this->db->get_where('users', ['id_admin' => $item['id_guru']])->row('username'); ?></td>
                <td class="text-center"><?= $item['role'] ?></td>
                <td class="text-center">
                  <div class="btn-group" role="group" aria-label="Opsi">
                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_guru-<?= $item['id_guru'] ?>" data-toggle="tooltip" data-placement="right" title="Edit Guru"><i class="fa fa-fw fa-edit"></i></a>
                    <a href="<?= base_url('guru/hapus/' . $item['id_guru']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Guru ?')" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus Guru"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal tambah guru -->
<div class="modal fade" id="tambah_guru" tabindex="-1" role="dialog" aria-labelledby="tambah_guruLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambah_guruLabel">Tambah Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('guru/tambah') ?>" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <label for="nip">NIP :</label>
              <input type="text" name="nip" value="<?= set_value('nip') ?>" class="form-control mb-3 <?= form_error('nip') ? 'is-invalid' : '' ?>" id="nip" required>
              <div id='nip' class='invalid-feedback'>
                <?= form_error('nip') ?>
              </div>
              <label for="nama">Nama Guru :</label>
              <input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control mb-3 <?= form_error('nama') ? 'is-invalid' : '' ?>" id="nama" required>
              <div id='nama' class='invalid-feedback'>
                <?= form_error('nama') ?>
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
            </div>
            <div class="col">
              <label for="username">Username :</label>
              <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control mb-3 <?= form_error('username') ? 'is-invalid' : '' ?>" id="username" required>
              <div id='username' class='invalid-feedback'>
                <?= form_error('username') ?>
              </div>
              <label for="password">Password :</label><small class="float-right">(Default password sama dengan NIS)</small>
              <input type="password" name="password" value="<?= set_value('password') ?>" class="form-control mb-3 <?= form_error('password') ? 'is-invalid' : '' ?>" id="password">
              <div id='password' class='invalid-feedback'>
                <?= form_error('password') ?>
              </div>
              <label for="role">Role :</label>
              <select name="role" id="role" class="form-control mb-3 <?= form_error('role') ? 'is-invalid' : '' ?>" required>
                <option value="" selected disabled></option>
                <option value="admin" <?= set_select('role', 'admin'); ?>>admin</option>
                <option value="pembina" <?= set_select('role', 'pembina'); ?>>pembina</option>
                <option value="wakasek" <?= set_select('role', 'wakasek'); ?>>wakasek kesiswaan</option>
              </select>
              <div id='role' class='invalid-feedback'>
                <?= form_error('role') ?>
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

<?php foreach ($guru as $item) { ?>
  <!-- Modal Edit Guru -->
  <div class="modal fade" id="edit_guru-<?= $item['id_guru'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_guru-<?= $item['id_guru'] ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit_guru-<?= $item['id_guru'] ?>Label">Perbarui Guru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('guru/ubah') ?>" method="post">
          <input type="hidden" name="id_guru" value="<?= $item['id_guru'] ?>">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <label for="nip">NIP :</label>
                <input type="text" name="nip" value="<?= set_value('nip', $item['nip']) ?>" class="form-control mb-3 <?= form_error('nip') ? 'is-invalid' : '' ?>" id="nip" required>
                <div id='nip' class='invalid-feedback'>
                  <?= form_error('nip') ?>
                </div>
                <label for="nama">Nama Guru :</label>
                <input type="text" name="nama" value="<?= set_value('nama', $item['nama']) ?>" class="form-control mb-3 <?= form_error('nama') ? 'is-invalid' : '' ?>" id="nama" required>
                <div id='nama' class='invalid-feedback'>
                  <?= form_error('nama') ?>
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
              </div>
              <div class="col">
                <label for="username">Username :</label>
                <input type="text" name="username" value="<?= set_value('username', $item['username']) ?>" class="form-control mb-3 <?= form_error('username') ? 'is-invalid' : '' ?>" id="username" required>
                <div id='username' class='invalid-feedback'>
                  <?= form_error('username') ?>
                </div>
                <label for="password">Password :</label><small class="text-muted float-right">(Kosongkan jika tidak ada perubahan)</small>
                <input type="password" name="password" value="" class="form-control mb-3 <?= form_error('password') ? 'is-invalid' : '' ?>" id="password">
                <div id='password' class='invalid-feedback'>
                  <?= form_error('password') ?>
                </div>
                <label for="role">Role :</label>
                <select name="role" id="role" class="form-control mb-3 <?= form_error('role') ? 'is-invalid' : '' ?>" required>
                  <option value="" selected disabled></option>
                  <option value="admin" <?= set_select('role', 'admin', $item['role'] == 'admin' ? TRUE : FALSE); ?>>admin</option>
                  <option value="pembina" <?= set_select('role', 'pembina', $item['role'] == 'pembina' ? TRUE : FALSE); ?>>pembina</option>
                  <option value="wakasek" <?= set_select('role', 'wakasek', $item['role'] == 'wakasek' ? TRUE : FALSE); ?>>wakasek kesiswaan</option>
                </select>
                <div id='role' class='invalid-feedback'>
                  <?= form_error('role') ?>
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
  $("#nip").keyup(function(e) {
    $("#username").val($(this).val());
  });
</script>