<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Rekap Data Laporan</h1>
    <hr>

    <div class="card shadow mb-4">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="recap-list" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#eskul" role="tab" aria-controls="eskul" aria-selected="true">Ekstrakurikuler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#guru" role="tab" aria-controls="guru" aria-selected="false">Guru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#siswa" role="tab" aria-controls="siswa" aria-selected="false">Siswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#jadwal" role="tab" aria-controls="jadwal" aria-selected="false">Jadwal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#absensi" role="tab" aria-controls="absensi" aria-selected="false">Absensi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#prestasi" role="tab" aria-controls="prestasi" aria-selected="false">Prestasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#nilai" role="tab" aria-controls="nilai" aria-selected="false">Nilai</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h4 class="card-title">Rekap Data Laporan</h4>
            <h6 class="card-subtitle mb-2">Berikut ini merupakan rekap data ekstrakurikuler yang terdapat di SMK Manbaul Ulum Cirebon</h6>

            <div class="tab-content mt-3">
                <div class="tab-pane active" id="eskul" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="eskulTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center">No.</th>
                                    <th>Nama Ekstrakurikuler</th>
                                    <th>Ketua</th>
                                    <th>Pembina</th>
                                    <th>Kesiswaan</th>
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
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="guru" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="guruTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>NIP</th>
                                    <th>Nama Guru</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Username</th>
                                    <th>Role</th>
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
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="siswa" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="siswaTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Foto</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>QR Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($siswa as $item) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td class="text-center">
                                            <a class="imgPopup" href="<?= base_url() . 'assets/img/siswa/' . $item['foto']; ?>">
                                                <img src="<?= base_url() . 'assets/img/siswa/' . $item['foto']; ?>" class="rounded-circle" width="50" height="50" alt="Avatar" style="object-fit: cover;">
                                            </a>
                                        </td>
                                        <td class="text-center"><?= $item['nis']; ?></td>
                                        <td class=""><?= $item['nama'] ?></td>
                                        <td class="text-center"><?= $item['kelas'] ?></td>
                                        <td class="text-center"><?= $item['jurusan'] ?></td>
                                        <td class="text-center"><img src="<?= base_url() . 'assets/img/siswa/qr/' . $item['qr_code']; ?>" width="50" height="50" alt="QR Code"></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="jadwal" role="tabpanel">
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
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="absensi" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="absensiTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Waktu</th>
                                    <!-- <th>Foto</th> -->
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($absensi as $item) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td class=""><?= $item['nama'] ?></td>
                                        <td class="text-center"><?= date('d M Y H:i', strtotime($item['tanggal_waktu'])) ?></td>
                                        <!-- <td class="text-center">
                                    <a class="imgPopup" href="<?= base_url() . 'assets/img/absensi/' . $item['foto']; ?>">
                                        <img src="<?= base_url() . 'assets/img/absensi/' . $item['foto']; ?>" class="rounded" width="50" height="50" alt="Avatar" style="object-fit: cover;">
                                    </a>
                                </td> -->
                                        <td class=""><?= $item['keterangan'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="prestasi" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="prestasiTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Siswa</th>
                                    <th>Nama Ekstrakurikuler</th>
                                    <th>Foto</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($prestasi as $item) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td class=""><?= $item['nama'] ?></td>
                                        <td class=""><?= $item['nama_eskul'] ?></td>
                                        <td class="text-center">
                                            <a class="imgPopup" href="<?= base_url() . 'assets/img/prestasi/' . $item['foto']; ?>">
                                                <img src="<?= base_url() . 'assets/img/prestasi/' . $item['foto']; ?>" class="rounded" width="50" height="50" alt="Avatar" style="object-fit: cover;">
                                            </a>
                                        </td>
                                        <td class=""><?= $item['deskripsi']; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="nilai" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="nilaiTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Siswa</th>
                                    <th>Nama Ekstrakurikuler</th>
                                    <th>Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($nilai as $item) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td class=""><?= $item['nama'] ?></td>
                                        <td class=""><?= $item['nama_eskul'] ?></td>
                                        <td class="text-center"><?= $item['skor'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>