<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

			<main class="content">
                <div class="container-fluid p-0">
                <h5 class="right-aligned" style="float: right">
                    <a href="#">Home</a> / <a href="broker_view.html">Admin</a> / Tambah Objective
                </h5>
                <h1 class="h3 mb-3"><b>Tambah Objective</b></h1>
                    <div class="row">
                        <div class="col-12">
                        <form id="createObjective" action="<?= base_url('objective/create') ?>" method="post">
                            <div class="card">
                            <div class="card-body">
                                <!-- Inputan Objective -->
                                <h5 class="card-title">Objective</h5>
                                <input
                                type="text"
                                class="form-control"
                                id="objective" name="objective"
                                placeholder="Masukkan Objective"
                                required/>

                                <!-- Inputan Karyawan -->
                                <h5 class="card-title mt-2">Karyawan</h5>
                                <select id="id_user" name="id_user" class="form-control">
                                    <option selected>Pilih Karyawan</option>
                                        <?php foreach ($users as $user): ?>
                                        <option value="<?= esc($user['id_user']); ?>">
                                        <?= esc($user['nama_user']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                
                                <!-- Button Submit -->
                                <div
                                style="
                                    position: relative;
                                    text-align: right;
                                    margin-top: 20px;
                                ">
                                <a href="#"
                                    type="button"
                                    onclick="history.back()"
                                    class="btn btn-info">
                                    Cancel
                                </a>
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    id="submitButton">
                                    Simpan
                                </button>
                                </div>
                            </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </main>

<?= $this->include('content/footer') ?>
<script src="<?= base_url('js/role/create.js')?>"></script>