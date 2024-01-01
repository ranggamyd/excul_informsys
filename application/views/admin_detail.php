<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Profil Saya</h1>
  <hr>

  <div class="row">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body text-center">
          <a class="imgPopup" href="<?= base_url() . 'assets/img/default.jpg'; ?>">
            <img src="<?= base_url() . 'assets/img/default.jpg'; ?>" class="rounded-circle" width="200" height="200" alt="Avatar" style="object-fit: cover;">
          </a>
        </div>
        <hr>
        <h4 class="text-center"><?= $guru->nip ?></h4>
        <p class="text-center mb-4"><?= $guru->nama ?></p>
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
                <th scope="row" style="width: 200px;">Nomor Induk Pegawai</th>
                <td style="width: 20px;">:</td>
                <td><?= $guru->nip; ?></td>
              </tr>
              <tr>
                <th scope="row">Nama Lengkap</th>
                <td>:</td>
                <td><?= $guru->nama; ?></td>
              </tr>
              <tr>
                <th scope="row">Jenis Kelamin</th>
                <td>:</td>
                <td><?= $guru->jk; ?></td>
              </tr>
              <tr>
                <th scope="row">Role</th>
                <td>:</td>
                <td><?= $guru->role; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>