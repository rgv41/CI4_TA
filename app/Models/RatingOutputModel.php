<?php

namespace App\Models;

use CodeIgniter\Model;

class RatingOutputModel extends Model
{
    protected $table = 'rating_outputs';
    protected $primaryKey = 'id_ro';
    protected $allowedFields = ['id_kr', 'output_target_q1', 'rating_value_q1', 'okr_score_q1', 'output_target_q2', 'rating_value_q2', 'okr_score_q2'];

    public function createRatingOuputModel($data)
    {
        return $this->insert($data);
    }

    public function updateRatingOuputModel($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteRatingOuputModel($id)
    {
        return $this->delete($id);
    }
}
