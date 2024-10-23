<?php

namespace App\Controllers;

use App\Models\KeyResultModel;
use App\Models\KMeansModel;
use App\Models\RatingOutputModel;
use App\Models\ObjectiveModel;
use App\Models\UserModel;
use Phpml\Clustering\KMeans;

class Kmeansc extends BaseController
{
    public function performClustering()
    {
        $roModel = new RatingOutputModel();
        $krModel = new KeyResultModel();
        $objModel = new ObjectiveModel();
        $userModel = new UserModel();

        // Ambil data dari rating_outputs
        $ratings = $roModel->findAll();


        $data = [];
        $userNames = [];

        foreach ($ratings as $rating) {
            // Ambil ID User dari Rating Output
            $id_user = $rating['id_user'];

            // Ambil Nama User
            $user = $userModel->getUserName($id_user);
            $userNames[$id_user] = $user['nama_user'];

            // Ambil ID Key Result dari rating_outputs
            $id_kr = $rating['id_kr'];

            // Ambil data Key Result dari tabel key_results
            $keyResult = $krModel->find($id_kr);
            $id_objective = $keyResult['id_objective'];

            // Ambil data Objective dari tabel objectives
            $objective = $objModel->find($id_objective);

            // Tambahkan data ke array
            $data[] = [
                'id_user' => $id_user,
                'name' => $user['nama_user'],
                'objective' => $objective['objective'], // Nama objective
                'key_result' => $keyResult['key_result'], // Nama key result
                'overall_okr_score' => $rating['overall_okr_score'] // Ambil langsung dari tabel rating_outputs
            ];
        }

        // Persiapkan data untuk clustering
        $samples = [];
        $labels = [];
        foreach ($data as $entry) {
            $samples[] = [$entry['overall_okr_score']];
            $labels[] = $entry['id_user'];
        }

        // Tentukan jumlah cluster
        $k = 5;

        // Jalankan K-Means
        $kmeans = new KMeans($k);
        $clusters = $kmeans->cluster($samples);

        // Map clusters to users
        $clusteredData = [];
        $correctClusters = 0;
        $totalDataPoints = 0;

        foreach ($clusters as $clusterId => $cluster) {
            foreach ($cluster as $index => $sample) {
                $user_id = $labels[$index];
                $okr_score = $sample[0];

                // Temukan data terkait user_id
                $userData = array_filter($data, fn($item) => $item['id_user'] === $user_id);
                $userData = reset($userData); // Mengambil item pertama yang sesuai

                // Tentukan predikat dan Cluster ID sesuai dengan logika yang diinginkan
                $predikat = $this->determinePredikat($okr_score);
                $expectedClusterId = $this->determineClusterId($okr_score);

                // Sinkronkan Cluster ID dengan expectedClusterId jika berbeda
                if ($clusterId !== $expectedClusterId) {
                    $clusterId = $expectedClusterId;
                } else {
                    $correctClusters++; // Jika sesuai, tambah counter cluster yang benar
                }

                $totalDataPoints++; // Tambah total data points

                // Simpan data cluster beserta predikatnya
                $clusteredData[$clusterId][] = [
                    'id_user' => $user_id,
                    'name' => $userNames[$user_id],
                    'objective' => $userData['objective'],
                    'key_result' => $userData['key_result'],
                    'overall_okr_score' => $okr_score,
                    'predikat' => $predikat
                ];
                log_message('info', 'ID User di Rating Outputs: ' . $rating['id_user']);
                log_message('info', 'ID User yang Disimpan ke Kmeans: ' . $user_id);
                // Update id_user dan predikat pada tabel kmeans
                $this->updatePredikatInKmeans($user_id, $clusterId, $predikat);
            }
        }

        // Hitung persentase keberhasilan clustering
        $clusteringSuccessRate = $this->calculateClusteringEffectiveness($correctClusters, $totalDataPoints);

        if (empty($clusteredData)) {
            return view('admin/clustering_results', ['message' => 'Tidak ada data yang berhasil di-cluster']);
        } else {
            return view('admin/clustering_results', ['clusters' => $clusteredData, 'successRate' => $clusteringSuccessRate]);
        }
    }

    private function updatePredikatInKmeans($id_user, $clusterId, $predikat)
    {
        $kmeansModel = new KMeansModel();

        // Temukan catatan di tabel kmeans berdasarkan id_user
        $existingRecord = $kmeansModel->where('user_id', $id_user)->first();

        // Jika catatan ada, perbarui predikat dan Cluster ID
        if ($existingRecord) {
            $kmeansModel->update($existingRecord['id'], [
                'cluster_id' => $clusterId,
                'predikat' => $predikat
            ]);
        } else {
            // Jika catatan tidak ada, buat catatan baru
            $kmeansModel->insert([
                'user_id' => $id_user,
                'cluster_id' => $clusterId,
                'predikat' => $predikat
            ]);
        }
    }

    private function determinePredikat($score)
    {
        if ($score > 100) {
            return 'Sangat Memuaskan';
        } elseif ($score >= 90) {
            return 'Memuaskan';
        } elseif ($score >= 70) {
            return 'Baik';
        } elseif ($score >= 60) {
            return 'Cukup';
        } else {
            return 'Kurang';
        }
    }

    private function determineClusterId($score)
    {
        if ($score > 100) {
            return 0;
        } elseif ($score >= 90) {
            return 1;
        } elseif ($score >= 70) {
            return 2;
        } elseif ($score >= 60) {
            return 3;
        } else {
            return 4;
        }
    }

    private function calculateClusteringEffectiveness($correctClusters, $totalDataPoints)
    {
        if ($totalDataPoints == 0) return 0; // Menghindari pembagian dengan nol
        return ($correctClusters / $totalDataPoints) * 100; // Menghitung persentase keberhasilan
    }
}
