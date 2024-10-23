<?php

namespace App\Models;

use CodeIgniter\Model;

class KMeansModel extends Model
{
    protected $table = 'kmeans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'cluster_id', 'predikat'];

    // Contoh method getClusterData dalam KMeansModel
    public function getClusterSummary()
    {
        return $this->db->table($this->table)
            ->select('cluster_id, predikat, COUNT(user_id) as jumlah_anggota')
            ->groupBy('cluster_id, predikat')
            ->orderBy('cluster_id', 'ASC')
            ->get()
            ->getResultArray();
    }
    public function getTotalUserCount()
    {
        return $this->db->table($this->table)
            ->select('COUNT(user_id) as total_users')
            ->get()
            ->getRowArray();
    }
    /**
     * Mengambil data OKR dengan join dari beberapa tabel.
     *
     * @return array
     */
    public function getOkrData()
    {
        $builder = $this->db->table('rating_outputs')
            ->select('users.id_user, users.nama_user, rating_outputs.overall_okr_score')
            ->join('key_results', 'key_results.id_kr = rating_outputs.id_kr')
            ->join('objectives', 'objectives.id_objective = key_results.id_objective')
            ->join('users', 'users.id_user = objectives.id_user')
            ->groupBy('users.id_user'); // Menghindari duplikasi data jika ada

        $query = $builder->get();
        return $query->getResultArray();
    }

    /**
     * Membersihkan tabel kmeans.
     *
     * @return void
     */
    public function clearKmeansTable()
    {
        $this->db->table($this->table)->truncate();
    }

    /**
     * Menyimpan hasil clustering ke tabel kmeans.
     *
     * @param array $data
     * @return void
     */
    public function saveClusteringResults(array $data)
    {
        $this->insertBatch($data);
    }
}
