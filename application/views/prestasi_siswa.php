<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
    </div>

    <!-- Content Row -->
    <h1 class="h3 mb-1 font-weight-bold text-center text-gray-800">Prestasi Ekstrakulikuler</h1>
    <h1 class="h5 mb-0 text-center text-gray-800">Berikut adalah prestasi ekstrakulikuler yang diperoleh di SMK Manbaul Ulum Cirebon</h1>
    <p class="text-center text-gray-800">Jl. Nyi Ageng Serang No.07, Cikeduk, Kec. Depok, Kabupaten Cirebon, Jawa Barat 45652</p>
    <hr class="w-25">

    <div class="row mt-5">
        <?php
        foreach ($eskul as $item) {
            $this->db->select('tbl_siswa.nama');
            $this->db->select('tbl_prestasi.*');
            $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_prestasi.id_siswa', 'left');
            $prestasi = $this->db->get_where('tbl_prestasi', ['id_eskul' => $item['id_eskul']])->result_array();
        ?>
            <div class="col-12">
                <div class="card border-left-primary">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-center text-uppercase">Ekstrakulikuler <?= $item['nama_eskul'] ?></h5>
                    </div>
                    <div class="card-body px-md-5">
                        <div class="row">
                            <?php foreach ($prestasi as $p) { ?>
                                <div class="col-md-4 mx-auto">
                                    <div class="card">
                                        <img class="card-img-top" src="<?= base_url('assets/img/prestasi/') . $p['foto'] ?>" style="width:100%; height: 200px; object-fit:cover;">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <h4 class="card-title"><?= $p['nama'] ?></h4>
                                                <p class="card-text"><?= $p['deskripsi'] ?></p>
                                                <a target="_blank" rel="nofollow" href="<?= base_url('prestasi/detail/') . $p['id_prestasi'] ?>">Lihat detail →</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->