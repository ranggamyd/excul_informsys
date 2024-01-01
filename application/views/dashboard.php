<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
    </div>

    <!-- Content Row -->
    <h1 class="h3 mb-1 font-weight-bold text-center text-gray-800">SELAMAT DATANG</h1>
    <h1 class="h5 mb-0 text-center text-gray-800">Di Sistem Informasi Ekstrakurikuler SMK Manbaul Ulum Cirebon</h1>
    <p class="text-center text-gray-800">Jl. Nyi Ageng Serang No.07, Cikeduk, Kec. Depok, Kabupaten Cirebon, Jawa Barat 45652</p>

    <?php if ($this->session->userdata('login_as') == 'admin') { ?>
        <div class="row mt-5">
            <div class="col-md-3 mb-4">
                <div class="card border-left-primary shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Data Ekstrakurikuler</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_eskul ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card border-left-warning shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Data Siswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_siswa ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-signature fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card border-left-info shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Data Pembina</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_pembina ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-medal fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card border-left-success shadow h-100 py-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Data Ketua</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_ketua ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-friends fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <form action="<?= base_url('absensi/tambah') ?>" method="post" id="presenceForm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-md-3">
                                    <div id="reader" style="height: 100%;"></div>
                                </div>
                                <div class="col">
                                    <label for="id_siswa">Nama Siswa :</label>
                                    <select name="id_siswa" id="id_siswa" class="form-control mb-3 <?= form_error('id_siswa') ? 'is-invalid' : '' ?>" required>
                                        <option value="" selected disabled></option>
                                        <?php foreach ($siswa as $item) { ?>
                                            <option data-nis="<?= $item['nis'] ?>" value="<?= $item['id_siswa'] ?>" <?= set_select('id_siswa', $item['id_siswa']); ?>><?= $item['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div id='id_siswa' class='invalid-feedback'>
                                        <?= form_error('id_siswa') ?>
                                    </div>
                                    <label for="tanggal_waktu">Tanggal Waktu :</label>
                                    <input type="datetime-local" name="tanggal_waktu" value="<?= set_value('tanggal_waktu', date('Y-m-d H:i:s')) ?>" class="form-control mb-3 <?= form_error('tanggal_waktu') ? 'is-invalid' : '' ?>" id="tanggal_waktu" required>
                                    <div id='tanggal_waktu' class='invalid-feedback'>
                                        <?= form_error('tanggal_waktu') ?>
                                    </div>
                                    <!-- <label for="foto">Foto :</label>
                        <input type="file" name="foto" value="<?= set_value('foto') ?>" class="form-control-file mb-3 <?= form_error('foto') ? 'is-invalid' : '' ?>" id="foto" required>
                        <div id='foto' class='invalid-feedback'>
                            <?= form_error('foto') ?>
                        </div> -->
                                    <label for="keterangan">Keterangan :</label>
                                    <textarea name="keterangan" class="form-control mb-3 <?= form_error('keterangan') ? 'is-invalid' : '' ?>" id="keterangan"><?= set_value('keterangan') ?></textarea>
                                    <div id='keterangan' class='invalid-feedback'>
                                        <?= form_error('keterangan') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="card">Batal</button>
                            <input type="submit" value="Simpan" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if ($this->session->userdata('login_as') == 'siswa') { ?>
        <div class="row mt-5">
            <?php foreach ($pengumuman as $item) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-center"><?= $item['judul'] ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <!-- <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="..."> -->
                            </div>
                            <p><?= $item['isi_pengumuman'] ?></p>
                            <!-- <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                unDraw →</a> -->
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="<?= base_url('assets/vendor/html5-qrcode/html5-qrcode.min.js') ?>" type="text/javascript"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        $('#id_siswa option').each(function() {
            if ($(this).data('nis') == decodedText) {
                $('#id_siswa').val($(this).val());

                return false;
            }
        });
        $("#presenceForm").submit();
        html5QrcodeScanner.clear();
    }

    function onScanFailure(error) {
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        },
        false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>