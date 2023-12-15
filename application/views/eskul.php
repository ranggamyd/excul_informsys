<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Data Ekstrakulikuler</h1>
  <hr>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <?php if ($this->session->userdata('login_as') != 'siswa') : ?>
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_eskul"><i class="fas fa-plus-circle mr-2"></i>Tambah Eskul</button>
      <?php endif ?>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th class="text-center">No.</th>
              <th>Nama Ekstrakulikuler</th>
              <th>Ketua</th>
              <th>Pembina</th>
              <th>Kesiswaan</th>
              <th style="text-align:center;">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($eskul as $item) { ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class=""><?= $item['nama_eskul'] ?></td>
                <td class=""><?= $this->db->get_where('tbl_siswa', ['id_siswa' => $item['id_ketua']])->row('nama'); ?></td>
                <td class=""><?= $this->db->get_where('tbl_guru', ['id_guru' => $item['id_pembina']])->row('nama'); ?></td>
                <td class=""><?= $this->db->get_where('tbl_guru', ['id_guru' => $item['id_kesiswaan']])->row('nama'); ?></td>
                <td class="text-center">
                  <?php if ($this->session->userdata('login_as') != 'admin') { ?>
                    <?php
                    $pendaftar = $this->db->get_where('tbl_pendaftaran', ['id_siswa' => $this->session->userdata('id_siswa'), 'id_eskul' => $item['id_eskul']])->row();
                    $able_join = 0;
                    if ($pendaftar && ($pendaftar->status != 'diterima')) $able_join = 1;
                    ?>
                    <button class="btn btn-primary" <?= $able_join ? '' : 'disabled' ?> data-toggle="modal" data-target="#join_eskul-<?= $item['id_eskul'] ?>" data-toggle="tooltip" data-placement="right" title="Klik untuk bergabung"><i class="fa-fw fas fa-door-open mr-2"></i>Gabung</button>
                  <?php
                  }
                  ?>
                  <?php if ($this->session->userdata('login_as') != 'siswa') : ?>
                    <div class="btn-group" role="group" aria-label="Opsi">
                      <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_eskul-<?= $item['id_eskul'] ?>" data-toggle="tooltip" data-placement="right" title="Edit Eskul"><i class="fa fa-fw fa-edit"></i></a>
                      <a href="<?= base_url('eskul/hapus/' . $item['id_eskul']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Eskul ?')" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus Eskul"><i class="fas fa-trash-alt"></i></a>
                    </div>
                  <?php endif ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal tambah eskul -->
<div class="modal fade" id="tambah_eskul" tabindex="-1" role="dialog" aria-labelledby="tambah_eskulLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambah_eskulLabel">Tambah Eskul</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('eskul/tambah') ?>" method="post">
        <div class="modal-body">
          <label for="nama_eskul">Nama Ekstrakulikuler :</label>
          <input type="text" name="nama_eskul" value="<?= set_value('nama_eskul') ?>" class="form-control mb-3 <?= form_error('nama_eskul') ? 'is-invalid' : '' ?>" id="nama_eskul" required>
          <div id='nama_eskul' class='invalid-feedback'>
            <?= form_error('nama_eskul') ?>
          </div>
          <label for="id_ketua">Ketua :</label>
          <select name="id_ketua" id="id_ketua" class="form-control mb-3 <?= form_error('id_ketua') ? 'is-invalid' : '' ?>" required>
            <option value="" selected disabled></option>
            <?php foreach ($siswa as $item) { ?>
              <option value="<?= $item['id_siswa'] ?>" <?= set_select('id_ketua', $item['id_siswa']); ?>><?= $item['nama'] ?></option>
            <?php } ?>
          </select>
          <div id='id_ketua' class='invalid-feedback'>
            <?= form_error('id_ketua') ?>
          </div>
          <div class="row">
            <div class="col">
              <label for="id_pembina">Pembina :</label>
              <select name="id_pembina" id="id_pembina" class="form-control mb-3 <?= form_error('id_pembina') ? 'is-invalid' : '' ?>" required>
                <option value="" selected disabled></option>
                <?php foreach ($guru as $item) { ?>
                  <option value="<?= $item['id_guru'] ?>" <?= set_select('id_pembina', $item['id_guru']); ?>><?= $item['nama'] ?></option>
                <?php } ?>
              </select>
              <div id='id_pembina' class='invalid-feedback'>
                <?= form_error('id_pembina') ?>
              </div>
            </div>
            <div class="col">
              <label for="id_kesiswaan">Kesiswaan :</label>
              <select name="id_kesiswaan" id="id_kesiswaan" class="form-control mb-3 <?= form_error('id_kesiswaan') ? 'is-invalid' : '' ?>" required>
                <option value="" selected disabled></option>
                <?php foreach ($guru as $item) { ?>
                  <option value="<?= $item['id_guru'] ?>" <?= set_select('id_kesiswaan', $item['id_guru']); ?>><?= $item['nama'] ?></option>
                <?php } ?>
              </select>
              <div id='id_kesiswaan' class='invalid-feedback'>
                <?= form_error('id_kesiswaan') ?>
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

<?php foreach ($eskul as $item) { ?>
  <!-- Modal Edit Eskul -->
  <div class="modal fade" id="edit_eskul-<?= $item['id_eskul'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_eskul-<?= $item['id_eskul'] ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit_eskul-<?= $item['id_eskul'] ?>Label">Perbarui Eskul</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('eskul/ubah') ?>" method="post">
          <input type="hidden" name="id_eskul" value="<?= $item['id_eskul'] ?>">
          <div class="modal-body">
            <label for="nama_eskul">Nama Ekstrakulikuler :</label>
            <input type="text" name="nama_eskul" value="<?= set_value('nama_eskul', $item['nama_eskul']) ?>" class="form-control mb-3 <?= form_error('nama_eskul') ? 'is-invalid' : '' ?>" id="nama_eskul" required>
            <div id='nama_eskul' class='invalid-feedback'>
              <?= form_error('nama_eskul') ?>
            </div>
            <label for="id_ketua">Ketua :</label>
            <select name="id_ketua" id="id_ketua" class="form-control mb-3 <?= form_error('id_ketua') ? 'is-invalid' : '' ?>" required>
              <option value="" selected disabled></option>
              <?php foreach ($siswa as $i) { ?>
                <option value="<?= $i['id_siswa'] ?>" <?= set_select('id_ketua', $i['id_siswa'], $item['id_ketua'] == $i['id_siswa'] ? TRUE : FALSE); ?>><?= $i['nama'] ?></option>
              <?php } ?>
            </select>
            <div id='id_ketua' class='invalid-feedback'>
              <?= form_error('id_ketua') ?>
            </div>
            <div class="row">
              <div class="col">
                <label for="id_pembina">Pembina :</label>
                <select name="id_pembina" id="id_pembina" class="form-control mb-3 <?= form_error('id_pembina') ? 'is-invalid' : '' ?>" required>
                  <option value="" selected disabled></option>
                  <?php foreach ($guru as $i) { ?>
                    <option value="<?= $i['id_guru'] ?>" <?= set_select('id_pembina', $i['id_guru'], $item['id_pembina'] == $i['id_guru'] ? TRUE : FALSE); ?>><?= $i['nama'] ?></option>
                  <?php } ?>
                </select>
                <div id='id_pembina' class='invalid-feedback'>
                  <?= form_error('id_pembina') ?>
                </div>
              </div>
              <div class="col">
                <label for="id_kesiswaan">Kesiswaan :</label>
                <select name="id_kesiswaan" id="id_kesiswaan" class="form-control mb-3 <?= form_error('id_kesiswaan') ? 'is-invalid' : '' ?>" required>
                  <option value="" selected disabled></option>
                  <?php foreach ($guru as $i) { ?>
                    <option value="<?= $i['id_guru'] ?>" <?= set_select('id_kesiswaan', $i['id_guru'], $item['id_kesiswaan'] == $i['id_guru'] ? TRUE : FALSE); ?>><?= $i['nama'] ?></option>
                  <?php } ?>
                </select>
                <div id='id_kesiswaan' class='invalid-feedback'>
                  <?= form_error('id_kesiswaan') ?>
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

  <!-- Modal Join Eskul -->
  <div class="modal fade" id="join_eskul-<?= $item['id_eskul'] ?>" tabindex="-1" role="dialog" aria-labelledby="join_eskul-<?= $item['id_eskul'] ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="join_eskul-<?= $item['id_eskul'] ?>Label"><?= $item['nama_eskul'] ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('eskul/join') ?>" method="post">
          <input type="hidden" name="id_eskul" value="<?= $item['id_eskul'] ?>">
          <input type="hidden" name="id_siswa" value="<?= $this->session->userdata('id_siswa') ?>">
          <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">
          <div class="modal-body">
            <h6 class="text-center">Apakah anda yakin ingin bergabung dengan Ekstrakulikuler <strong><?= $item['nama_eskul'] ?></strong>?</h6>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Tutup</button>
            <input type="submit" value="Gabung Sekarang" class="btn btn-success">
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>

</div>