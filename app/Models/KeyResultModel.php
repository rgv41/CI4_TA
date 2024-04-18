<?php

namespace App\Models;

use CodeIgniter\Model;

class KeyResultModel extends Model
{
    protected $table = 'key_results';
    protected $primaryKey = 'id_kr';
    protected $allowedFields = ['key_result', 'target_q1', 'target_q2', 'unit_target', 'complexity', 'id_objective', 'progress_q1', 'progress_q2', 'unit_progress', 'assignor_rate_q1', 'assignor_rate_q2', 'id_assignor'];

    // Untuk Get All
    public function getKeyResultWithAssign()
    {
        return $this->select('key_results.*, users.nama_user, objectives.objective')
            ->join('users', 'users.id_user = key_results.id_assignor')
            ->join('objectives', 'objectives.id_objective = key_results.id_objective')
            ->findAll();
    }

    // Untuk Get Data By User
    public function getKeyResultWithAssignByUser($userId)
    {
        return $this->select('key_results.*, users.nama_user, objectives.objective')
            ->join('users', 'users.id_user = key_results.id_assignor')
            ->join('objectives', 'objectives.id_objective = key_results.id_objective')
            ->where('users.id_user', $userId)
            ->findAll();
    }

    public function createKeyResultsModel($data)
    {
        return $this->insert($data);
    }

    public function updateKeyResultsModel($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteKeyResultsModel($id)
    {
        return $this->delete($id);
    }
}
