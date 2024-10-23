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
        return $this->select('
            users.id_user, users.nama_user, users.no_hp, users.id_role, users.username, users.password,
            objectives.id_objective, objectives.objective,
            key_results.id_kr, key_results.key_result, key_results.target_q1, key_results.target_q2,
            key_results.unit_target, key_results.complexity, key_results.progress_q1, key_results.progress_q2,
            key_results.unit_progress, key_results.assignor_rate_q1, key_results.assignor_rate_q2, key_results.id_assignor
        ')
            ->join('objectives', 'objectives.id_objective = key_results.id_objective')
            ->join('users', 'users.id_user = objectives.id_user')
            ->where('users.id_user', $userId)
            ->findAll();
    }

    // Function untuk ambil data key result karyawan yg belum diisi
    public function getKrUserWithoutAssign($userId)
    {
        return $this->select('
        users.id_user, users.nama_user, users.no_hp, users.id_role, users.username, users.password,
        objectives.id_objective, objectives.objective,
        key_results.id_kr, key_results.key_result, key_results.target_q1, key_results.target_q2,
        key_results.unit_target, key_results.complexity, key_results.progress_q1, key_results.progress_q2,
        key_results.unit_progress, key_results.assignor_rate_q1, key_results.assignor_rate_q2, key_results.id_assignor
    ')
            ->join('objectives', 'objectives.id_objective = key_results.id_objective')
            ->join('users', 'users.id_user = objectives.id_user')
            ->where('users.id_user', $userId)
            ->where('key_results.progress_q1 IS NULL')
            ->findAll();
    }

    // Function untuk get key result yg harus dinilai assigner
    public function getKeyResultByAssigner($assignId)
    {
        return $this->select('
            users.id_user, users.nama_user, users.no_hp, users.id_role, users.username, users.password,
            objectives.id_objective, objectives.objective,
            key_results.id_kr, key_results.key_result, key_results.target_q1, key_results.target_q2,
            key_results.unit_target, key_results.complexity, key_results.progress_q1, key_results.progress_q2,
            key_results.unit_progress, key_results.assignor_rate_q1, key_results.assignor_rate_q2, key_results.id_assignor
        ')
            ->join('objectives', 'objectives.id_objective = key_results.id_objective')
            ->join('users', 'users.id_user = objectives.id_user')
            ->where('key_results.id_assignor', $assignId)
            ->findAll();
    }

    // Function untuk get key result yg belum dinilai assigner
    public function getKrAssignerWithoutAssign($assignId)
    {
        return $this->select('
        users.id_user, users.nama_user, users.no_hp, users.id_role, users.username, users.password,
        objectives.id_objective, objectives.objective,
        key_results.id_kr, key_results.key_result, key_results.target_q1, key_results.target_q2,
        key_results.unit_target, key_results.complexity, key_results.progress_q1, key_results.progress_q2,
        key_results.unit_progress, key_results.assignor_rate_q1, key_results.assignor_rate_q2, key_results.id_assignor
    ')
            ->join('objectives', 'objectives.id_objective = key_results.id_objective')
            ->join('users', 'users.id_user = objectives.id_user')
            ->where('key_results.id_assignor', $assignId)
            ->where('key_results.assignor_rate_q1 IS NULL')
            ->findAll();
    }

    // Function untuk get data key result berdasarkan user dan id kr
    public function getKeyResultByUserById($userId, $krId)
    {
        return $this->select('users.id_user, users.nama_user, users.no_hp, users.id_role, users.username, users.password, objectives.id_objective, objectives.objective, key_results.id_kr, key_results.key_result, key_results.target_q1, key_results.target_q2, key_results.unit_target, key_results.complexity, key_results.progress_q1, key_results.progress_q2, key_results.unit_progress, key_results.assignor_rate_q1, key_results.assignor_rate_q2, key_results.id_assignor')
            ->join('objectives', 'objectives.id_objective = key_results.id_objective')
            ->join('users', 'users.id_user = objectives.id_user')
            ->where('users.id_user', $userId)
            ->where('key_results.id_kr', $krId)
            ->first();
    }

    // Functino untuk get data key result berdasarkan assigner dan id kr
    public function getKeyResultByAssignerById($assignId, $krId)
    {
        return $this->select('users.id_user, users.nama_user, users.no_hp, users.id_role, users.username, users.password, objectives.id_objective, objectives.objective, key_results.id_kr, key_results.key_result, key_results.target_q1, key_results.target_q2, key_results.unit_target, key_results.complexity, key_results.progress_q1, key_results.progress_q2, key_results.unit_progress, key_results.assignor_rate_q1, key_results.assignor_rate_q2, key_results.id_assignor')
            ->join('objectives', 'objectives.id_objective = key_results.id_objective')
            ->join('users', 'users.id_user = objectives.id_user')
            ->where('key_results.id_assignor', $assignId)
            ->where('key_results.id_kr', $krId)
            ->first();
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
