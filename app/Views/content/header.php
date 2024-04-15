	<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

			  	<?php
				// Periksa apakah user ID tersedia di sesi
				$userId = session('id_user') ?? null;

				if ($userId) {
					// Periksa apakah model user ada dan dapat digunakan
					if (class_exists('\App\Models\UserModel')) {
						$userModel = new \App\Models\UserModel();

						// Periksa apakah userRole dapat diambil dari model
						if (method_exists($userModel, 'getUserById')) {
							$userRole = $userModel->getUserById($userId);
						} else {
							$userRole['id_role'] = 0; // Jika method tidak ada, atur ke Guest
						}
					} else {
						$userRole['id_role'] = 0; // Jika model tidak ada, atur ke Guest
					}
				} else {
					$userRole['id_role'] = 0; // Jika user ID tidak tersedia di sesi, atur ke Guest
				}
				?>
				
				<!-- Jika userRole adalah 1 (Admin) -->
				<?php if ($userRole['id_role'] == 1) : ?>
				<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
					<img src="<?= base_url('img/avatars/avatar.jpg') ?>" class="avatar img-fluid rounded-circle me-1" alt="Admin" /> <span class="text-dark">Admin</span>
				</a>
				<!-- Jika userRole adalah 2 (Karyawan) -->
			  	<?php elseif ($userRole['id_role'] == 2) : ?>
				<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
					<img src="<?= base_url('img/avatars/avatar.jpg') ?>" class="avatar img-fluid rounded-circle me-1" alt="Karyawan" /> <span class="text-dark">Karyawan</span>
				</a>
				<?php else : ?>
                    <li class="sidebar-item">
                        <span class="sidebar-link">Anda tidak memiliki akses</span>
                    </li>
                <?php endif; ?>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?= site_url('auth/logout'); ?>">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>