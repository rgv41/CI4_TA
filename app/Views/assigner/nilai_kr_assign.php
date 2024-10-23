<?= $this->include('content/sidebar') ?>

<?= $this->include('content/header') ?>

<main class="content">
    <div class="container-fluid p-0">
        <h5 class="right-aligned" style="float: right">
            <a href="#">Home</a> / <a href="#">Assigner</a> / Assign Nilai Pemeriksaan Key Result (Assign)
        </h5>
        <h1 class="h3 mb-3"><b>Assign Nilai Pemeriksaan Key Result (Assign)</b></h1>
        <div class="row">
            <div class="col-12">
                <form id="assignKeyResult" action="<?= base_url('assign/nilai_pemeriksaan/update/' . $key_results['id_kr']) ?>" method="post">
                    <div class="card">
                        <div class="card-body">
                            <!-- Inputan Karyawan -->
                            <h5 class="card-title">Karyawan</h5>
                            <input
                                type="text"
                                class="form-control"
                                id="nama_user" name="nama_user"
                                value="<?= esc($key_results['nama_user']) ?>"
                                disabled />

                            <!-- Inputan Objective -->
                            <h5 class="card-title mt-2">Objective</h5>
                            <input
                                type="text"
                                class="form-control"
                                id="objective" name="objective"
                                value="<?= esc($key_results['objective']) ?>"
                                disabled />

                            <!-- Inputan Key Result -->
                            <h5 class="card-title">Key Result</h5>
                            <input
                                type="text"
                                class="form-control"
                                id="key_result" name="key_result"
                                value="<?= esc($key_results['key_result']) ?>"
                                disabled />

                            <div class="row mt-1">
                                <h5 class="card-title mt-2">Progress (Karyawan)</h5>
                                <div class="col-md-6">
                                    <!-- Inputan Q1 -->
                                    <h5 class="card-title">Q1</h5>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="progress_q1" name="progress_q1"
                                        value="<?= is_null($key_results['progress_q1']) ? 'Belum Diisi' : esc($key_results['progress_q1']) ?>"
                                        disabled />
                                </div>
                                <div class="col-md-6">
                                    <!-- Inputan Q2 -->
                                    <h5 class="card-title">Q2</h5>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="progress_q2"
                                        name="progress_q2"
                                        value="<?= is_null($key_results['progress_q2']) ? 'Belum Diisi' : esc($key_results['progress_q2']) ?>"
                                        disabled />
                                </div>
                            </div>

                            <!-- Inputan Unit Progress -->
                            <h5 class="card-title mt-2">Unit Progress</h5>
                            <input
                                type="text"
                                class="form-control"
                                id="unit_progress" name="unit_progress"
                                value="<?= is_null($key_results['unit_progress']) ? 'Belum Diisi' : esc($key_results['unit_progress']) ?>"
                                disabled />

                            <div class="row mt-1">
                                <h5 class="card-title mt-2">Assignor Rating (Assignor)</h5>
                                <div class="col-md-6">
                                    <!-- Inputan Q1 -->
                                    <h5 class="card-title">Q1</h5>
                                    <select class="form-control" id="assignor_rate_q1" name="assignor_rate_q1">
                                        <option value="" disabled <?= empty($key_results['assignor_rate_q1']) ? 'selected' : '' ?>>Belum Diisi</option>
                                        <option value="1" <?= $key_results['assignor_rate_q1'] == 1 ? 'selected' : '' ?>>1 - Buruk</option>
                                        <option value="2" <?= $key_results['assignor_rate_q1'] == 2 ? 'selected' : '' ?>>2 - Cukup</option>
                                        <option value="3" <?= $key_results['assignor_rate_q1'] == 3 ? 'selected' : '' ?>>3 - Baik</option>
                                        <option value="4" <?= $key_results['assignor_rate_q1'] == 4 ? 'selected' : '' ?>>4 - Memuaskan</option>
                                        <option value="5" <?= $key_results['assignor_rate_q1'] == 5 ? 'selected' : '' ?>>5 - Sangat Memuaskan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <!-- Inputan Q2 -->
                                    <h5 class="card-title">Q2</h5>
                                    <select class="form-control" id="assignor_rate_q2" name="assignor_rate_q2">
                                        <option value="" disabled <?= empty($key_results['assignor_rate_q2']) ? 'selected' : '' ?>>Belum Diisi</option>
                                        <option value="1" <?= $key_results['assignor_rate_q2'] == 1 ? 'selected' : '' ?>>1 - Buruk</option>
                                        <option value="2" <?= $key_results['assignor_rate_q2'] == 2 ? 'selected' : '' ?>>2 - Cukup</option>
                                        <option value="3" <?= $key_results['assignor_rate_q2'] == 3 ? 'selected' : '' ?>>3 - Baik</option>
                                        <option value="4" <?= $key_results['assignor_rate_q2'] == 4 ? 'selected' : '' ?>>4 - Memuaskan</option>
                                        <option value="5" <?= $key_results['assignor_rate_q2'] == 5 ? 'selected' : '' ?>>5 - Sangat Memuaskan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Button Submit -->
                            <div
                                style="
                                    position: relative;
                                    text-align: right;
                                    margin-top: 20px;
                                ">
                                <a onclick="history.back()"
                                    type="button"
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
<script src="<?= base_url('js/nilai_key_result/assign.js') ?>"></script>