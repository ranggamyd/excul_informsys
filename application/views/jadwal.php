<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Jadwal Kegiatan</h1>
  <hr>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <?php if ($this->session->userdata('login_as') != 'siswa') : ?>
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_jadwal"><i class="fas fa-plus-circle mr-2"></i>Tambah Jadwal</button>
      <?php endif ?>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="jadwalTable" width="100%" cellspacing="0">
          <thead class="text-center">
            <tr>
              <th class="text-center">No.</th>
              <th>Nama Ekstrakulikuler</th>
              <th>Tanggal</th>
              <th>Waktu</th>
              <th>Tempat</th>
              <th>Periode</th>
              <?php if ($this->session->userdata('login_as') != 'siswa') : ?>
                <th>Opsi</th>
              <?php endif ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($jadwal as $item) : ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td class=""><?= $item['nama_eskul'] ?></td>
                <td class="text-center"><?= date('d M Y', strtotime($item['tanggal'])) ?></td>
                <td class="text-center"><?= $item['jam_mulai'] ?> - <?= $item['jam_selesai'] ?></td>
                <td class=""><?= $item['tempat'] ?></td>
                <td class=""><?= $item['periode'] ?></td>
                <?php if ($this->session->userdata('login_as') != 'siswa') : ?>
                  <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Opsi">
                      <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit_jadwal-<?= $item['id_jadwal'] ?>" data-toggle="tooltip" data-placement="right" title="Edit Jadwal"><i class="fa fa-fw fa-edit"></i></a>
                      <a href="<?= base_url('jadwal/hapus/' . $item['id_jadwal']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Jadwal ?')" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus Jadwal"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal tambah jadwal -->
<div class="modal fade" id="tambah_jadwal" tabindex="-1" role="dialog" aria-labelledby="tambah_jadwalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambah_jadwalLabel">Tambah Jadwal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('jadwal/tambah') ?>" method="post">
        <div class="modal-body">
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
          <label for="tanggal">Tanggal :</label>
          <input type="date" name="tanggal" value="<?= set_value('tanggal') ?>" class="form-control mb-3 <?= form_error('tanggal') ? 'is-invalid' : '' ?>" id="tanggal" required>
          <div id='tanggal' class='invalid-feedback'>
            <?= form_error('tanggal') ?>
          </div>
          <div class="row">
            <div class="col">
              <label for="jam_mulai">Jam Mulai :</label>
              <input type="time" name="jam_mulai" value="<?= set_value('jam_mulai') ?>" class="form-control mb-3 <?= form_error('jam_mulai') ? 'is-invalid' : '' ?>" id="jam_mulai" required>
              <div id='jam_mulai' class='invalid-feedback'>
                <?= form_error('jam_mulai') ?>
              </div>
            </div>
            <div class="col">
              <label for="jam_selesai">Jam Selesai :</label>
              <input type="time" name="jam_selesai" value="<?= set_value('jam_selesai') ?>" class="form-control mb-3 <?= form_error('jam_selesai') ? 'is-invalid' : '' ?>" id="jam_selesai" required>
              <div id='jam_selesai' class='invalid-feedback'>
                <?= form_error('jam_selesai') ?>
              </div>
            </div>
          </div>
          <label for="tempat">Tempat :</label>
          <input type="text" name="tempat" value="<?= set_value('tempat') ?>" class="form-control mb-3 <?= form_error('tempat') ? 'is-invalid' : '' ?>" id="tempat" required>
          <div id='tempat' class='invalid-feedback'>
            <?= form_error('tempat') ?>
          </div>
          <label for="periode">Periode :</label>
          <input type="text" name="periode" value="<?= set_value('periode') ?>" class="form-control mb-3 <?= form_error('periode') ? 'is-invalid' : '' ?>" id="periode" required>
          <div id='periode' class='invalid-feedback'>
            <?= form_error('periode') ?>
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

<?php foreach ($jadwal as $item) { ?>
  <!-- Modal Edit Jadwal -->
  <div class="modal fade" id="edit_jadwal-<?= $item['id_jadwal'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_jadwal-<?= $item['id_jadwal'] ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit_jadwal-<?= $item['id_jadwal'] ?>Label">Perbarui Jadwal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('jadwal/ubah') ?>" method="post">
          <input type="hidden" name="id_jadwal" value="<?= $item['id_jadwal'] ?>">
          <div class="modal-body">
            <label for="id_eskul">Jenis Ekstrakurikuler :</label>
            <select name="id_eskul" id="id_eskul" class="form-control mb-3 <?= form_error('id_eskul') ? 'is-invalid' : '' ?>" required>
              <option value="" selected disabled></option>
              <?php foreach ($eskul as $i) { ?>
                <option value="<?= $i['id_eskul'] ?>" <?= set_select('id_eskul', $i['id_eskul'], $i['id_eskul'] == $item['id_eskul'] ? TRUE : FALSE); ?>><?= $i['nama_eskul'] ?></option>
              <?php } ?>
            </select>
            <div id='id_eskul' class='invalid-feedback'>
              <?= form_error('id_eskul') ?>
            </div>
            <label for="tanggal">Tanggal :</label>
            <input type="date" name="tanggal" value="<?= set_value('tanggal', $item['tanggal']) ?>" class="form-control mb-3 <?= form_error('tanggal') ? 'is-invalid' : '' ?>" id="tanggal" required>
            <div id='tanggal' class='invalid-feedback'>
              <?= form_error('tanggal') ?>
            </div>
            <div class="row">
              <div class="col">
                <label for="jam_mulai">Jam Mulai :</label>
                <input type="time" name="jam_mulai" value="<?= set_value('jam_mulai', $item['jam_mulai']) ?>" class="form-control mb-3 <?= form_error('jam_mulai') ? 'is-invalid' : '' ?>" id="jam_mulai" required>
                <div id='jam_mulai' class='invalid-feedback'>
                  <?= form_error('jam_mulai') ?>
                </div>
              </div>
              <div class="col">
                <label for="jam_selesai">Jam Selesai :</label>
                <input type="time" name="jam_selesai" value="<?= set_value('jam_selesai', $item['jam_selesai']) ?>" class="form-control mb-3 <?= form_error('jam_selesai') ? 'is-invalid' : '' ?>" id="jam_selesai" required>
                <div id='jam_selesai' class='invalid-feedback'>
                  <?= form_error('jam_selesai') ?>
                </div>
              </div>
            </div>
            <label for="tempat">Tempat :</label>
            <input type="text" name="tempat" value="<?= set_value('tempat', $item['tempat']) ?>" class="form-control mb-3 <?= form_error('tempat') ? 'is-invalid' : '' ?>" id="tempat" required>
            <div id='tempat' class='invalid-feedback'>
              <?= form_error('tempat') ?>
            </div>
            <label for="periode">Periode :</label>
            <input type="text" name="periode" value="<?= set_value('periode', $item['periode']) ?>" class="form-control mb-3 <?= form_error('periode') ? 'is-invalid' : '' ?>" id="periode" required>
            <div id='periode' class='invalid-feedback'>
              <?= form_error('periode') ?>
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