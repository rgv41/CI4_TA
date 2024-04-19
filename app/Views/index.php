<?= $this->include('content/sidebar') ?>

			<?= $this->include('content/header') ?>

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
				<?php
					// Ambil data dari model User
					$userModel = new \App\Models\UserModel();
					$users = $userModel->getUserWithRoles();

					// Ambil data dari model Objective
					$objectiveModel = new \App\Models\ObjectiveModel();
					$objectives = $objectiveModel->getObjectWithRoles();

					// Ambil data dari model Key Result
					$keyResultModel = new \App\Models\KeyResultModel();
					$keyResults = $keyResultModel->getKeyResultWithAssign();
					?>

					<main class="content">
						<div class="container-fluid p-0">
							<h5 class="right-aligned" style="float: right">
								<a href="#">Home</a> / <a href="#">Admin</a> / Dashboard
							</h5>
							<h1 class="h3 mb-3"><b>Dashboard Admin</b></h1>
							<div class="row">
								<div class="row">
									<div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total User</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= count($users) ?></h1>
												<div class="mb-0">
													<span class="text-muted">Terdiri dari User Admin, Karyawan, dan Assigner.</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Objective</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="list"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= count($objectives) ?></h1>
												<div class="mb-0">
													<span class="text-muted">Jumlah semua objective karyawan.</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Key Result</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="list"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= count($keyResults) ?></h1>
												<div class="mb-0">
													<span class="text-muted">Jumlah semua key result karyawan.</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</main>
				<!-- Jika userRole adalah 2 (Karyawan) -->
			  	<?php elseif ($userRole['id_role'] == 2) : ?>
					<main class="content">
						<div class="container-fluid p-0">
							<h5 class="right-aligned" style="float: right">
								<a href="#">Home</a> / <a href="#">Karyawan</a> / Dashboard
							</h5>
							<h1 class="h3 mb-3"><b>Dashboard Karyawan</b></h1>
							<div class="row justify-content-center">
                            <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                <div class="row no-gutters" style="height: 40px">
                                    <h1 class="h3 mt-2">Nilai Pemeriksaan Key Result</h1>
                                </div>

                                <hr />
                                <div class="table-container">
                                    <table id="example"
                                    class="table table-striped"
                                    style="width: 100%">
                                    <thead>
                                        <tr style="text-align: center; vertical-align: middle">
                                            <th hidden></th>
                                            <th>Objective</th>
                                            <th>Key Result</th>
                                            <th colspan="2">Target</th>
                                            <th>Unit Target</th>
                                            <th>Complexity</th>
                                            <th colspan="2">Progress</th>
                                            <th>Unit Progres</th>
                                            <th colspan="2">Assignor Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <!-- Fetch Data Start -->
                                    <tbody>
                                    </tbody>
                                    <!-- Fetch Data End -->
                                    
                                    </table>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                    <div class="pagination">
                                        <button
                                        id="prevPageBtn"
                                        class="btn btn-primary">
                                        Previous
                                        </button>
                                        <span id="currentPage" class="mx-2">Halaman 1</span>
                                        <button
                                        id="nextPageBtn"
                                        class="btn btn-primary">
                                        Next
                                        </button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
						</div>
					</main>
				<!-- Jika userRole adalah 3 (Assigner) -->
				<?php elseif ($userRole['id_role'] == 3) : ?>
					<main class="content">
						<div class="container-fluid p-0">
							<h5 class="right-aligned" style="float: right">
								<a href="#">Home</a> / <a href="#">Assigner</a> / Dashboard
							</h5>
							<h1 class="h3 mb-3"><b>Dashboard Assigner</b></h1>
							<div class="row justify-content-center">
                            <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                <div class="row no-gutters" style="height: 40px">
                                    <h1 class="h3 mt-2">Nilai Pemeriksaan Key Result (Assign)</h1>
                                </div>

                                <hr />
                                <div class="table-container">
                                    <table id="example"
                                    class="table table-striped"
                                    style="width: 100%">
                                    <thead>
                                        <tr style="text-align: center; vertical-align: middle">
                                            <th hidden></th>
                                            <th>Karyawan</th>
                                            <th>Objective</th>
                                            <th>Key Result</th>
                                            <th colspan="2">Target</th>
                                            <th>Unit Target</th>
                                            <th>Complexity</th>
                                            <th colspan="2">Progress</th>
                                            <th>Unit Progres</th>
                                            <th colspan="2">Assignor Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <!-- Fetch Data Start -->
                                    <tbody>
                                    </tbody>
                                    <!-- Fetch Data End -->
                                    
                                    </table>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                    <div class="pagination">
                                        <button
                                        id="prevPageBtn"
                                        class="btn btn-primary">
                                        Previous
                                        </button>
                                        <span id="currentPage" class="mx-2">Halaman 1</span>
                                        <button
                                        id="nextPageBtn"
                                        class="btn btn-primary">
                                        Next
                                        </button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
						</div>
					</main>
				<!-- Jika userRole tidak terdeteksi -->
				<?php else : ?>
					<main class="content">
						<div class="container-fluid p-0">
							<h1 class="h3 mb-3">Blank Page</h1>
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Empty card</h5>
										</div>
										<div class="card-body">
										</div>
									</div>
								</div>
							</div>
						</div>
					</main>
                <?php endif; ?>

			<?= $this->include('content/footer') ?>