<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

			<main class="content">
                <div class="container-fluid p-0">
                <h5 class="right-aligned" style="float: right">
                    <a href="#">Home</a> / <a href="#">Admin</a> / Detail Objective
                </h5>
                <h1 class="h3 mb-3"><b>Detail Objective</b></h1>
                        <div class="row justify-content-center">
                            <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                <div class="row no-gutters" style="height: 40px">
                                    <h1 class="h3 mt-2">Detail Key Result Berdasarkan Objective</h1>
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
                                        </tr>
                                    </thead>

                                    <!-- Fetch Data Start -->
                                    <tbody>
                                        <?php foreach ($keyResults as $key_result): ?>
                                            <tr>
                                                <td hidden></td>
                                                <td>
                                                    <?= $key_result['objective'] ?>
                                                </td>
                                                <td>
                                                    <?= $key_result['key_result'] ?>
                                                </td>
                                                <td>
                                                    <?= isset($key_result['target_q1']) ? $key_result['target_q1'] : 0 ?>
                                                </td>
                                                <td>
                                                    <?= isset($key_result['target_q2']) ? $key_result['target_q2'] : 0 ?>
                                                </td>
                                                <td>
                                                    <?= $key_result['unit_target'] ?>
                                                </td>
                                                <td>
                                                    <?= $key_result['complexity'] ?>
                                                </td>
                                                <td>
                                                    <?= isset($key_result['progress_q1']) ? $key_result['progress_q1'] : 0 ?>
                                                </td>
                                                <td>
                                                    <?= isset($key_result['progress_q2']) ? $key_result['progress_q2'] : 0 ?>
                                                </td>
                                                <td>
                                                    <?= isset($key_result['unit_progress']) ? $key_result['unit_progress'] : 0 ?>
                                                </td>
                                                <td>
                                                    <?= isset($key_result['assignor_rate_q1']) ? $key_result['assignor_rate_q1'] : 0 ?>
                                                </td>
                                                <td>
                                                    <?= isset($key_result['assignor_rate_q2']) ? $key_result['assignor_rate_q2'] : 0 ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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

<?= $this->include('content/footer') ?>
<script src="<?= base_url('js/key_result/delete.js')?>"></script>