<div class="container">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <img src="<?= base_url('assets/img/logo_smk_mu.png') ?>" alt="MU Logo" class="w-100 h-100 p-5">
                        </div>
                        <div class="col-lg-6 d-flex align-items-center w-100">
                            <div class="p-5 flex-grow-1">
                                <div class="text-center">
                                    <h1 class="h3 text-gray-900 mb-1">Selamat Datang !</h1>
                                    <p class="h6 text-gray-900 mb-4">Di Sistem Informasi Ekstrakurikuler SMK Manbaul Ulum Cirebon</p>
                                </div>
                                <form action="<?= base_url('auth/login') ?>" method="POST" class="user">
                                    <div class="form-group">
                                        <input type="text" name="credential" value="<?= set_value('credential') ?>" class="form-control form-control-user <?= form_error('credential') ? 'is-invalid' : '' ?>" id="credential" placeholder="Masukkan Username" required>
                                        <div id="credential" class="invalid-feedback">
                                            <?= form_error('credential') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user <?= form_error('password') ? 'is-invalid' : '' ?>" id="password" placeholder="Masukkan Password" required>
                                        <div id="password" class="invalid-feedback">
                                            <?= form_error('password') ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                                    <!-- <hr> -->
                                </form>
                                <span class="float-right mt-2">Lupa Password? <a class="btn btn-link text-success" href="https://wa.me/089661499402"><i class="fab fa-whatsapp mr-2"></i>Hubungi Admin</a></span>
                                <!-- <a class="small float-right" href="<?= base_url('auth/register') ?>">Belum punya akun?</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>