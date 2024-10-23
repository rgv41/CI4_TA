<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<main class="content">
    <div class="container-fluid p-0">
        <h5 class="right-aligned" style="float: right">
            <a href="#">Home</a> / <a href="#">Clustering Results</a>
        </h5>
        <h1 class="h3 mb-3"><b>Clustering Results</b></h1>
        <!-- Tampilkan tingkat keberhasilan clustering -->
        <?php if (isset($successRate)) : ?>
            <div class="alert alert-info">
                <strong>Presentase Clustering:</strong> <?= round($successRate, 2) ?>%
            </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h3 mt-2">Clustering Results</h1>
                        <hr />
                        <div class="table-container">
                            <table id="example" class="table table-striped" style="width: 100%">
                                <thead>
                                    <tr style="text-align: center; vertical-align: middle">
                                        <th>Cluster ID</th>
                                        <th>Karyawan</th>
                                        <th>Rata-rata OKR Score</th>
                                        <th>Predikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($clusters) && !empty($clusters)) : ?>
                                        <?php foreach ($clusters as $clusterId => $cluster) : ?>
                                            <?php foreach ($cluster as $employee) : ?>
                                                <tr>
                                                    <td><?= $clusterId ?></td>
                                                    <td><?= esc($employee['name']) ?></td>
                                                    <td><?= number_format($employee['overall_okr_score'], 2) ?></td>
                                                    <td><?= esc($employee['predikat']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6">Tidak ada data cluster yang tersedia.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function() {
                                    $('#example').DataTable({
                                        "paging": true, // Enable pagination
                                        "searching": true, // Enable search
                                        "ordering": true, // Enable sorting
                                        "info": true // Show table information
                                    });
                                });
                            </script>

                        </div>
                        <hr />
                        <h2>Clustering Visualization</h2>
                        <canvas id="clusteringChart"></canvas>
                        <hr />
                        <h3>Distribusi Pengguna berdasarkan Predikat</h3>
                        <p>Di bawah ini adalah distribusi pengguna di berbagai kategori predikat berdasarkan hasil pengelompokan.</p>
                        <ul>
                            <?php
                            $predikatLabels = ['Sangat Memuaskan', 'Memuaskan', 'Baik', 'Cukup', 'Kurang'];
                            foreach ($predikatLabels as $index => $label) : ?>
                                <li><?= $label ?>: <?= isset($clusters[$index]) ? count($clusters[$index]) : 0 ?> users</li>
                            <?php endforeach; ?>
                        </ul>

                        <h3>Pilih Cluster ID untuk Melihat Detail Pengguna</h3>
                        <select id="clusterDropdown">
                            <option value="">Pilih Cluster ID</option>
                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                <option value="<?= $i ?>">Cluster ID <?= $i ?></option>
                            <?php endfor; ?>
                        </select>

                        <div id="clusterTables">
                            <?php foreach ($clusters as $clusterId => $users) : ?>
                                <div class="cluster-table" id="cluster-<?= $clusterId ?>" style="display: none;">
                                    <h4>Cluster ID: <?= $clusterId ?></h4>
                                    <input type="text" id="search-<?= $clusterId ?>" placeholder="Cari nama karyawan...">
                                    <table border="1" cellpadding="5" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Karyawan</th>
                                                <th>Objective</th>
                                                <th>Key Result</th>
                                                <th>OKR Score</th>
                                                <th>Predikat</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body-<?= $clusterId ?>">
                                            <?php foreach ($users as $index => $user) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= $user['name'] ?></td>
                                                    <td><?= $user['objective'] ?></td>
                                                    <td><?= $user['key_result'] ?></td>
                                                    <td><?= $user['overall_okr_score'] ?></td>
                                                    <td><?= $user['predikat'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const dropdown = document.getElementById('clusterDropdown');
                                const tables = document.querySelectorAll('.cluster-table');

                                dropdown.addEventListener('change', function() {
                                    const selectedValue = dropdown.value;
                                    tables.forEach(function(table) {
                                        const clusterId = table.id.split('-')[1];
                                        const searchInput = document.getElementById(`search-${clusterId}`);
                                        const tableBody = document.getElementById(`table-body-${clusterId}`);

                                        table.style.display = (table.id === `cluster-${selectedValue}` || selectedValue === '') ? 'block' : 'none';

                                        // Filter table on search input
                                        if (selectedValue === clusterId) {
                                            searchInput.addEventListener('input', function() {
                                                const searchTerm = searchInput.value.toLowerCase();
                                                const rows = tableBody.getElementsByTagName('tr');

                                                Array.from(rows).forEach(row => {
                                                    const nameCell = row.cells[1];
                                                    const name = nameCell.textContent || nameCell.innerText;

                                                    if (name.toLowerCase().indexOf(searchTerm) > -1) {
                                                        row.style.display = '';
                                                    } else {
                                                        row.style.display = 'none';
                                                    }
                                                });
                                            });
                                        }
                                    });
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->include('content/footer') ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const clusters = <?= json_encode($clusters) ?>;

    // Labels and colors for different predikat
    const predikatLabels = ['Sangat Memuaskan', 'Memuaskan', 'Baik', 'Cukup', 'Kurang'];
    const colors = [
        'rgba(0, 128, 0, 0.5)', // Green
        'rgba(0, 255, 0, 0.5)', // Lime
        'rgba(255, 255, 0, 0.5)', // Yellow
        'rgba(255, 165, 0, 0.5)', // Orange
        'rgba(255, 0, 0, 0.5)' // Red
    ];

    // Map clusters to data for Chart.js
    const clusterData = [];

    Object.keys(clusters).forEach(clusterId => {
        const cluster = clusters[clusterId];
        const clusterIndex = parseInt(clusterId);
        clusterData.push({
            label: predikatLabels[clusterIndex], // Assigning appropriate labels
            data: cluster.map(employee => ({
                x: employee.overall_okr_score,
                y: clusterIndex,
                employeeName: employee.name // Add employee name to data point
            })),
            backgroundColor: colors[clusterIndex], // Assigning appropriate colors
            borderColor: colors[clusterIndex].replace('0.5', '1'),
            borderWidth: 1
        });
    });

    // Render the chart using Chart.js
    const ctx = document.getElementById('clusteringChart').getContext('2d');
    new Chart(ctx, {
        type: 'scatter',
        data: {
            datasets: clusterData
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        // Customize the tooltip label
                        label: function(tooltipItem) {
                            const datasetLabel = tooltipItem.dataset.label || '';
                            const dataPoint = tooltipItem.raw;
                            return `${dataPoint.employeeName} : ${datasetLabel}, Score: ${dataPoint.x}, ClusterId: ${dataPoint.y}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Rata-rata OKR Score'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Cluster ID / Predikat'
                    },
                    ticks: {
                        stepSize: 1,
                        min: 0,
                        max: 4,
                        callback: function(value, index, values) {
                            return predikatLabels[value]; // Display predikat instead of numeric cluster ID
                        }
                    }
                }
            }
        }
    });
</script>