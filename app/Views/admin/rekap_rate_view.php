<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

			<main class="content">
                <div class="container-fluid p-0">
                <h5 class="right-aligned" style="float: right">
                    <a href="#">Home</a> / <a href="#">Admin</a> / Rekap Kinerja Karyawan
                </h5>
                <h1 class="h3 mb-3"><b>Rekap Kinerja Karyawan</b></h1>
                        <div class="row justify-content-center">
                            <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                <div class="row no-gutters" style="height: 40px">
                                    <h1 class="h3 mt-2">Rekap Kinerja Karyawan</h1>
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
                                            <th>Key Result</th>
                                            <th>Ouput Target Q1</th>
                                            <th>Rating Value Q1</th>
                                            <th>OKR Score Q1</th>
                                            <th>Ouput Target Q2</th>
                                            <th>Rating Value Q2</th>
                                            <th>OKR Score Q2</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <!-- Fetch Data Start -->
                                    <tbody>
                                        <?php foreach ($rating_outputs as $rating_output): ?>
                                            <tr>
                                                <td hidden></td>
                                                <td>
                                                    <?= $rating_output['nama_user']?>
                                                </td>
                                                <td>
                                                    <?= $rating_output['key_result']?>
                                                </td>
                                                <td>
                                                    <?= $rating_output['output_target_q1']?>
                                                </td>
                                                <td>
                                                    <?= $rating_output['rating_value_q1']?>
                                                </td>
                                                <td>
                                                    <?= $rating_output['okr_score_q1']?>
                                                </td>
                                                <td>
                                                    <?= $rating_output['output_target_q2']?>
                                                </td>
                                                <td>
                                                    <?= $rating_output['rating_value_q2']?>
                                                </td>
                                                <td>
                                                    <?= $rating_output['okr_score_q2']?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('rating_output/delete/' . $rating_output['id_ro']) ?>" class="btn btn-danger" onclick="return confirmDelete(event)">Hapus</a>
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
<script src="<?= base_url('js/rekap/delete.js')?>"></script>