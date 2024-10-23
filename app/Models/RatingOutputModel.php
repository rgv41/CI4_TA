<?php

namespace App\Models;

use CodeIgniter\Model;

class RatingOutputModel extends Model
{
    protected $table = 'rating_outputs';
    protected $primaryKey = 'id_ro';
    protected $allowedFields = ['id_kr', 'id_user', 'output_target_q1', 'rating_value_q1', 'okr_score_q1', 'output_target_q2', 'rating_value_q2', 'okr_score_q2', 'overall_okr_score', 'predikat'];

    public function getAllRatingOutput()
    {
        return $this->db->table('rating_outputs')
            ->select('rating_outputs.*, users.nama_user, key_results.key_result')  // Ensure key_result is selected
            ->join('key_results', 'rating_outputs.id_kr = key_results.id_kr')
            ->join('objectives', 'key_results.id_objective = objectives.id_objective')
            ->join('users', 'objectives.id_user = users.id_user')
            ->where('users.id_role', 2)  // Only include employees (id_role = 2)
            ->get()
            ->getResultArray();
    }
    public function createRatingOutputModel($data)
    {
        return $this->insert($data);
    }

    public function updateRatingOutputModel($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteRatingOutputModel($id)
    {
        return $this->delete($id);
    }
}
