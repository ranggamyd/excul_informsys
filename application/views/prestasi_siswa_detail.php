<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <button type="button" onclick="history.back()" class="btn btn-success mt-3"><i class="fa-fw fas fa-arrow-left mr-2"></i> Kembali</button>
        <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
    </div>

    <!-- Content Row -->
    <h1 class="h3 mb-1 font-weight-bold text-center text-gray-800">Prestasi Ekstrakurikuler</h1>
    <h1 class="h5 mb-0 text-center text-gray-800">Berikut adalah prestasi ekstrakurikuler yang diperoleh di SMK Manbaul Ulum Cirebon</h1>
    <p class="text-center text-gray-800">Jl. Nyi Ageng Serang No.07, Cikeduk, Kec. Depok, Kabupaten Cirebon, Jawa Barat 45652</p>
    <hr class="w-25">

    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-left-primary">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-center text-uppercase">Ekstrakurikuler <?= $prestasi->nama_eskul ?></h5>
                </div>
                <div class="card-body px-md-5">
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url('assets/img/prestasi/') . $prestasi->foto ?>" style="width:100%; height: 500px; object-fit:cover;">
                        <div class="card-body">
                            <div class="text-center">
                                <h4 class="card-title"><?= $prestasi->nama ?></h4>
                                <p class="card-text"><?= $prestasi->deskripsi ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->