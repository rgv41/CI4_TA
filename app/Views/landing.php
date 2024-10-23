<!-- Content Landing Start -->
<?= $this->include('auth/header-landing') ?>

<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle text-center">
                    <img src="<?= base_url('img/photos/image.png') ?>" style="max-width: 150px; max-height: 150px; margin-bottom: 20px;">
                    <h1 class="h2">Selamat Datang di Sistem Manajemen Karyawan</h1>
                    <p class="lead mt-4">
                        Aplikasi ini membantu Anda mengelola kinerja dan sistem keputusan karyawan berdasarkan data Objectives and Key Results menggunakan algoritma K-Means.
                    </p>
                    <div class="mt-5">
                        <a href="<?= base_url('/login') ?>" class="btn btn-lg btn-primary" style="background-color: #182C61;">Masuk</a>
                        <!-- <a href="<?= base_url('/register') ?>" class="btn btn-lg btn-secondary">Buat Akun</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->include('auth/footer-landing') ?>
<!-- Content Landing End -->