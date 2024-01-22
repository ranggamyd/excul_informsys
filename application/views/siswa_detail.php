<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Detail Siswa</h1>
  <hr>

  <div class="row">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body text-center">
          <a class="imgPopup" href="<?= base_url() . 'assets/img/siswa/' . $siswa->foto; ?>">
            <img src="<?= base_url() . 'assets/img/siswa/' . $siswa->foto; ?>" class="rounded-circle" width="200" height="200" alt="Avatar" style="object-fit: cover;">
          </a>
        </div>
        <a href="<?= base_url() . 'assets/img/kartu_anggota/' . $siswa->kartu_anggota . '.pdf'; ?>" class="pdfPopup btn btn-primary mx-5"><i class="fa-fw far fa-id-card mr-2"></i> Kartu Anggota</a>
        <!-- <a href="<?= base_url('users/kartu_anggota/' . $siswa->id_siswa) ?>" target="_blank" class="btn btn-primary mx-5"><i class="fa-fw far fa-id-card mr-2"></i> Kartu Anggota</a> -->
        <hr>
        <h4 class="text-center"><?= $siswa->nis ?></h4>
        <p class="text-center mb-4"><?= $siswa->nama ?></p>
      </div>
      <div class="card shadow mt-3">
        <?php 
        $this->db->join('tbl_eskul', 'tbl_eskul.id_eskul = tbl_pendaftaran.id_eskul', 'left');
        $eskul = $this->db->get_where('tbl_pendaftaran', ['id_siswa' => $siswa->id_siswa])->result_array(); 
        ?>
        <div class="card-body">
          <h4 class="bg-light px-3 font-weight-bold">Ekstrakulikuler yang diikuti</h4>
          <div class="table-responsive">
            <table class="table border-bottom">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Ekstrakulikuler</th>
                  <th>Tanggal Daftar</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($eskul as $item) :
                ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $item['nama_eskul'] ?></td>
                    <td><?= $item['tanggal'] ?></td>
                    <td><?= $item['status'] ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <button type="button" onclick="history.back()" class="btn btn-success mt-3"><i class="fa-fw fas fa-arrow-left mr-2"></i> Kembali</button>
    </div>
    <div class="col-md-8">
      <div class="card shadow mb-3">
        <div class="card-body">
          <h4 class="bg-light px-3 font-weight-bold">Informasi Lengkap</h4>
          <div class="table-responsive">
            <table class="table border-bottom">
              <tr>
                <th scope="row" style="width: 200px;">Nomor Induk Siswa</th>
                <td style="width: 20px;">:</td>
                <td><?= $siswa->nis; ?></td>
              </tr>
              <tr>
                <th scope="row">Nama Lengkap</th>
                <td>:</td>
                <td><?= $siswa->nama; ?></td>
              </tr>
              <tr>
                <th scope="row">Kelas</th>
                <td>:</td>
                <td><?= $siswa->kelas; ?></td>
              </tr>
              <tr>
                <th scope="row">Jurusan</th>
                <td>:</td>
                <td><?= $siswa->jurusan; ?></td>
              </tr>
              <tr>
                <th scope="row">Jenis Kelamin</th>
                <td>:</td>
                <td><?= $siswa->jk; ?></td>
              </tr>
              <tr>
                <th scope="row">TTL</th>
                <td>:</td>
                <td><?= $siswa->tempat_lahir && $siswa->tanggal_lahir ? $siswa->tempat_lahir . ', ' . date('d-m-Y', strtotime($siswa->tanggal_lahir)) : '' ?></td>
              </tr>
              <tr>
                <th scope="row">Agama</th>
                <td>:</td>
                <td><?= $siswa->agama; ?></td>
              </tr>
              <tr>
                <th scope="row">No. HP Orang Tua</th>
                <td>:</td>
                <td><?= $siswa->no_hp; ?></td>
              </tr>
              <tr>
                <th scope="row">Alamat</th>
                <td>:</td>
                <td><?= $siswa->alamat; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>