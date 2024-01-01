<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Data Pendaftar</h1>
  <hr>

  <div class="card shadow mb-4">
    <?php if ($this->session->userdata('level') == 'Administrator') : ?>
      <div class="card-header py-3">
        <!-- <a href="<?= base_url('pengajuan/tambah_ajuan') ?>" class="btn btn-sm btn-primary" id="#myBtn"><i class="fas fa-plus-circle mr-2"></i>Ajukan Permohonan Baru</a> -->
      </div>
    <?php endif ?>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th class="text-center">No.</th>
              <th>Nama Pendaftar</th>
              <th>NIS</th>
              <th>Jenis Ekstrakurikuler</th>
              <th>Tanggal Daftar</th>
              <th>Status</th>
              <th style="text-align:center;">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($pendaftar as $item) { ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class=""><?= $item['nama'] ?></td>
                <td class="text-center"><?= $item['nis'] ?></td>
                <td class=""><?= $item['nama_eskul'] ?></td>
                <td class="text-center"><?= date('d M Y', strtotime($item['tanggal'])) ?></td>
                <td class="text-center"><?= $item['status'] ?></td>
                <td class="text-center">
                  <div class="btn-group" role="group" aria-label="Opsi">
                    <a href="<?= base_url('pendaftar/terima/') . $item['id_pendaftaran'] ?>" class="btn btn-success <?= $item['status'] == 'diterima' ? 'disabled' : '' ?>" onclick="return confirm('Apakah anda yakin?')"><i class="fa-fw far fa-check-circle mr-2"></i>Terima</a>
                    <a href="<?= base_url('pendaftar/tolak/') . $item['id_pendaftaran'] ?>" class="btn btn-danger <?= $item['status'] == 'ditolak' ? 'disabled' : '' ?>" onclick="return confirm('Apakah anda yakin?')"><i class="fa-fw far fa-times-circle mr-2"></i>Tolak</a>
                  </div>
                  <div class="btn-group" role="group" aria-label="Opsi">
                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_pendaftar-<?= $item['id_pendaftaran'] ?>" data-toggle="tooltip" data-placement="right" title="Edit pendaftar"><i class="fa fa-fw fa-edit"></i></a>
                    <a href="<?= base_url('pendaftar/hapus/' . $item['id_pendaftaran']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus pendaftar ?')" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus pendaftar"><i class="fas fa-trash-alt"></i></a>
                  </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>

<?php foreach ($pendaftar as $item) { ?>
  <!-- Modal Edit pendaftar -->
  <div class="modal fade" id="edit_pendaftar-<?= $item['id_pendaftaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_pendaftar-<?= $item['id_pendaftaran'] ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit_pendaftar-<?= $item['id_pendaftaran'] ?>Label">Perbarui pendaftar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('pendaftar/ubah') ?>" method="post">
          <input type="hidden" name="id_pendaftaran" value="<?= $item['id_pendaftaran'] ?>">
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
            <label for="tanggal">Tanggal Waktu :</label>
            <input type="date" name="tanggal" value="<?= set_value('tanggal', $item['tanggal']) ?>" class="form-control mb-3 <?= form_error('tanggal') ? 'is-invalid' : '' ?>" id="tanggal" required>
            <div id='tanggal' class='invalid-feedback'>
              <?= form_error('tanggal') ?>
            </div>
            <label for="status">Status :</label><br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="status" value="diterima" <?= set_radio('status', 'diterima', $item['status'] == 'diterima' ? TRUE : FALSE) ?>>Terima
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="status" value="ditolak" <?= set_radio('status', 'ditolak', $item['status'] == 'ditolak' ? TRUE : FALSE) ?>>Tolak
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="status" value="menunggu" <?= set_radio('status', 'menunggu', $item['status'] == 'menunggu' ? TRUE : FALSE) ?> required>Menunggu
              </label>
            </div>
            <div id='status' class='invalid-feedback'>
              <?= form_error('status') ?>
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