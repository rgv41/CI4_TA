<!-- Content Login Start -->
<?= $this->include('auth/header-login') ?>

<main class="d-flex w-100">
	<div class="container d-flex flex-column">
		<div class="row vh-100">
			<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
				<div class="d-table-cell align-middle">

					<div class="text-center mt-4">
						<h1 class="h2">Selamat Datang!</h1>
						<img src="<?= base_url('img/photos/image.png') ?>" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
						<p class="lead">
							Sistem Manajemen Karyawan
						</p>
					</div>

					<div class="card">
						<div class="card-body">
							<div class="m-sm-3">
								<form action="<?= site_url('auth/attemptLogin'); ?>" method="post">
									<div class="mb-3">
										<label class="form-label">Username</label>
										<input class="form-control form-control-lg" type="text" id="username" name="username" placeholder="Masukkan Username" />
									</div>
									<div class="mb-3">
										<label class="form-label">Password</label>
										<input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Masukkan Password" />
									</div>
									<div class="d-grid gap-2 mt-5">
										<button type="submit" class="btn btn-lg btn-primary" style="background-color: #182C61;">Masuk</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="text-center mb-3">
						Belum Punya Akun? <a href="<?= base_url('/register') ?>"><b>Buat Akun</b></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?= $this->include('auth/footer-login') ?>
<!-- Content Login End -->