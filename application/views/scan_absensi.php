<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Scan/Tambah Absensi</h1>
    <hr>

    <div class="card shadow mb-4">
        <form action="<?= base_url('absensi/tambah') ?>" method="post" id="presenceForm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
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