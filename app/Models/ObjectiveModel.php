<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectiveModel extends Model
{
    protected $table = 'objectives';
    protected $primaryKey = 'id_objective';
    protected $allowedFields = ['objective', 'id_user'];

    // Untuk Get All
    public function getObjectWithRoles()
    {
        return $this->select('objectives.*, users.nama_user')
            ->join('users', 'users.id_user = objectives.id_user')
            ->findAll();
    }

    public function createObjeciveModel($data)
    {
        return $this->insert($data);
    }

    public function updateObjeciveModel($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteObjeciveModel($id)
    {
        return $this->delete($id);
    }
}
