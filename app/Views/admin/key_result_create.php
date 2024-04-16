<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

			<main class="content">
                <div class="container-fluid p-0">
                <h5 class="right-aligned" style="float: right">
                    <a href="#">Home</a> / <a href="#">Admin</a> / Tambah Key Result
                </h5>
                <h1 class="h3 mb-3"><b>Tambah Key Result</b></h1>
                    <div class="row">
                        <div class="col-12">
                        <form id="createKeyResult" action="<?= base_url('key_result/create') ?>" method="post">
                            <div class="card">
                            <div class="card-body">
                                <!-- Inputan Objective -->
                                <h5 class="card-title mt-2">Objective</h5>
                                <select id="id_objective" name="id_objective" class="form-control">
                                    <option selected>Pilih Objective</option>
                                        <?php foreach ($objectives as $objective): ?>
                                        <option value="<?= esc($objective['id_objective']); ?>">
                                        <?= esc($objective['objective']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>

                                <!-- Inputan Key Result -->
                                <h5 class="card-title mt-2">Key Result</h5>
                                <input
                                type="text"
                                class="form-control"
                                id="key_result" name="key_result"
                                placeholder="Masukkan Key Result"
                                required/>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <!-- Inputan Target Q1 -->
                                        <h5 class="card-title mt-2">Q1</h5>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="target_q1" name="target_q1"
                                            placeholder="Masukkan Target Q1"
                                            required/>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Target Q2 -->
                                        <h5 class="card-title mt-2">Q2</h5>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="target_q2" name="target_q2"
                                            placeholder="Masukkan Target Q2"
                                            required/>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <!-- Inputan Unit Target -->
                                        <h5 class="card-title mt-2">Unit Target</h5>
                                        <select id="unit_target" name="unit_target" class="form-control">
                                            <option selected>Pilih Unit Target</option>
                                            <option value="Rupiah">Rupiah</option>
                                            <option value="Laporan">Laporan</option>
                                            <option value="Persen">Persen</option>
                                            <option value="Kegiatan">Kegiatan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Complexity -->
                                        <h5 class="card-title mt-2">Complexity</h5>
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="complexity" name="complexity"
                                        placeholder="Masukkan Complexity"
                                        required/>
                                    </div>
                                </div>

                                <!-- Inputan Assigner -->
                                <h5 class="card-title mt-2">Assigner</h5>
                                <select id="id_assignor" name="id_assignor" class="form-control">
                                    <option selected>Pilih Assigner</option>
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
<script src="<?= base_url('js/key_result/create.js') ?>"></script>