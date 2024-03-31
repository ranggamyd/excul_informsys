<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
    </div>

    <!-- Content Row -->
    <h1 class="h3 mb-1 font-weight-bold text-center text-gray-800">Daftar Pengumuman</h1>
    <h1 class="h5 mb-0 text-center text-gray-800">Berikut ini pengumuman terkait ekstrakurikuler di SMK Manbaul Ulum Cirebon</h1>
    <p class="text-center text-gray-800">Jl. Nyi Ageng Serang No.07, Cikeduk, Kec. Depok, Kabupaten Cirebon, Jawa Barat 45652</p>
    <hr class="w-25">

    <div class="row mt-5">
        <?php foreach ($pengumuman as $key => $p) { ?>
            <div class="col-8 offset-2 mb-4">
                <div id="accordion">
                    <div class="card shadow">
                        <div class="card-header" id="heading-<?= $p['id_pengumuman'] ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" data-toggle="collapse" data-target="#collapse-<?= $p['id_pengumuman'] ?>" aria-expanded="<?= $key === 0 ? 'true' : 'false' ?>" aria-controls="collapse-<?= $p['id_pengumuman'] ?>">
                                    <?= $p['judul'] ?>
                                    <small class="text-muted float-right"><?= date('d M Y - H:i', strtotime($p['tanggal'])) ?></small>
                                </button>
                            </h5>
                        </div>

                        <div id="collapse-<?= $p['id_pengumuman'] ?>" class="collapse <?= $key === 0 ? 'show' : '' ?>" aria-labelledby="heading-<?= $p['id_pengumuman'] ?>" data-parent="#accordion">
                            <div class="card-body">
                                <p class="card-text"><?= $p['isi_pengumuman'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->