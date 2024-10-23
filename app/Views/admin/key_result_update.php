<?= $this->include('content/sidebar') ?>

<?= $this->include('content/header') ?>

<main class="content">
    <div class="container-fluid p-0">
        <h5 class="right-aligned" style="float: right">
            <a href="#">Home</a> / <a href="#">Admin</a> / Update Key Result
        </h5>
        <h1 class="h3 mb-3"><b>Update Key Result</b></h1>
        <div class="row">
            <div class="col-12">
                <form id="updateKeyResult" action="<?= base_url('key_result/update/' . $key_results['id_kr']) ?>" method="post">
                    <div class="card">
                        <div class="card-body">

                            <!-- Inputan Key Result -->
                            <h5 class="card-title">Key Result</h5>
                            <input
                                type="text"
                                class="form-control"
                                id="key_result" name="key_result"
                                value="<?= esc($key_results['key_result']) ?>" />

                            <div class="row mt-1">
                                <h5 class="card-title mt-2">Target (Karyawan)</h5>
                                <div class="col-md-6">
                                    <!-- Inputan Q1 -->
                                    <h5 class="card-title">Q1</h5>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="target_q1" name="target_q1"
                                        value="<?= is_null($key_results['target_q1']) ? 'Belum Diisi' : esc($key_results['target_q1']) ?>" />
                                </div>
                                <div class="col-md-6">
                                    <!-- Inputan Q2 -->
                                    <h5 class="card-title">Q2</h5>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="target_q2"
                                        name="target_q2"
                                        value="<?= is_null($key_results['target_q2']) ? 'Belum Diisi' : esc($key_results['target_q2']) ?>" />
                                </div>
                            </div>

                            <!-- Inputan Unit Target -->
                            <h5 class="card-title mt-2">Unit Target</h5>
                            <input
                                type="text"
                                class="form-control"
                                id="unit_target" name="unit_target"
                                value="<?= is_null($key_results['unit_target']) ? 'Belum Diisi' : esc($key_results['unit_target']) ?>" />

                            <!-- Inputan Complexity -->
                            <h5 class="card-title mt-2">Complexity</h5>
                            <select class="form-control" id="complexity" name="complexity" required>
                                <option value="" disabled <?= is_null($key_results['complexity']) ? 'selected' : '' ?>>Belum Diisi</option>
                                <option value="1" <?= $key_results['complexity'] == 1 ? 'selected' : '' ?>>1</option>
                                <option value="2" <?= $key_results['complexity'] == 2 ? 'selected' : '' ?>>2</option>
                                <option value="3" <?= $key_results['complexity'] == 3 ? 'selected' : '' ?>>3</option>
                                <option value="4" <?= $key_results['complexity'] == 4 ? 'selected' : '' ?>>4</option>
                                <option value="5" <?= $key_results['complexity'] == 5 ? 'selected' : '' ?>>5</option>
                            </select>


                            <div class="row mt-1">
                                <h5 class="card-title mt-2">Progress (Karyawan)</h5>
                                <div class="col-md-6">
                                    <!-- Inputan Q1 -->
                                    <h5 class="card-title">Q1</h5>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="progress_q1" name="progress_q1"
                                        value="<?= is_null($key_results['progress_q1']) ? 'Belum Diisi' : esc($key_results['progress_q1']) ?>" />
                                </div>
                                <div class="col-md-6">
                                    <!-- Inputan Q2 -->
                                    <h5 class="card-title">Q2</h5>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="progress_q2"
                                        name="progress_q2"
                                        value="<?= is_null($key_results['progress_q2']) ? 'Belum Diisi' : esc($key_results['progress_q2']) ?>" />
                                </div>
                            </div>

                            <!-- Inputan Unit Progress -->
                            <h5 class="card-title mt-2">Unit Progress</h5>
                            <input
                                type="text"
                                class="form-control"
                                id="unit_progress" name="unit_progress"
                                value="<?= is_null($key_results['unit_progress']) ? 'Belum Diisi' : esc($key_results['unit_progress']) ?>" />

                            <div class="row mt-1">
                                <h5 class="card-title mt-2">Assignor Rating (Assigner)</h5>
                                <div class="col-md-6">
                                    <!-- Inputan Q1 -->
                                    <h5 class="card-title">Q1</h5>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="assignor_rate_q1" name="assignor_rate_q1"
                                        value="<?= esc($key_results['assignor_rate_q1']) ?>" />
                                </div>
                                <div class="col-md-6">
                                    <!-- Inputan Q2 -->
                                    <h5 class="card-title">Q2</h5>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="assignor_rate_q2"
                                        name="assignor_rate_q2"
                                        value="<?= esc($key_results['assignor_rate_q2']) ?>" />
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
<script src="<?= base_url('js/key_result/update.js') ?>"></script>