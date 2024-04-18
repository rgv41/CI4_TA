<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KeyResultModel;
use App\Models\ObjectiveModel;

class Objective extends BaseController
{
	// Function for Get All Data
	public function getAllObject(): string
	{
		$objectiveModel = new ObjectiveModel();
		$data['objectives'] = $objectiveModel->getObjectWithRoles();

		return view('admin/objective_view', $data);
	}

	// Function for Get Data By Id
	public function getObjectiveById($idObjective): string 
	{
		$krModel = new KeyResultModel();
		$objectiveModel = new ObjectiveModel();
		$userModel = new UserModel();

		// Ambil semua data key_result yang memiliki id_objective yang sesuai
		$keyResults = $krModel->where('id_objective', $idObjective)->findAll();

		// Inisialisasi array untuk menyimpan hasil
		$data['keyResults'] = [];

		// Loop melalui setiap hasil
		foreach ($keyResults as $keyResult) {
			if (array_key_exists('id_user', $keyResult)) {
				$user = $userModel->find($keyResult['id_user']);
				$keyResult['nama_user'] = $user ? $user['nama_user'] : '';
			}
			// Pastikan kunci 'id_objective' ada sebelum mencoba mengaksesnya
			if (array_key_exists('id_objective', $keyResult)) {
				$objective = $objectiveModel->find($keyResult['id_objective']);
				$keyResult['objective'] = $objective ? $objective['objective'] : '';
			}
			$data['keyResults'][] = $keyResult;
		}
		return view('admin/objective_detail', $data);
	}

	// Function for Create Objective
	public function renderPageCreateObjective(): string
	{
		$objectiveModel = new ObjectiveModel();
		$data['objectives'] = $objectiveModel->findAll();

		$userModel = new UserModel();
		$data['users'] = $userModel->where('id_role', 2)->findAll();

		return view('admin/objective_create', $data);
	}

	public function createObjective()
	{
		$objectiveModel = new ObjectiveModel();
		$data = $this->request->getPost();

		if ($objectiveModel->createObjectiveModel($data)) {
			return redirect()->to('/dashboard/objective')->with('message', 'Objective berhasil ditambahkan');
		} else {
			return redirect()->back()->withInput()->with('errors', $userModel->errors());
		}
	}

	// Functin for Update Data
	public function renderPageUpdateObjective($id): string
	{
		$objectiveModel = new ObjectiveModel();

		$data['objectives'] = $objectiveModel->find($id);
		
		return view('admin/objective_update', $data);
	}

	public function updateObjective($id)
	{
		$objectiveModel = new ObjectiveModel();
		$data = $this->request->getPost();

		if ($objectiveModel->updateObjectiveModel($id, $data)) {
			return redirect()->to('/dashboard/objective')->with('message', 'Objective berhasil diupdate');
		} else {
			return redirect()->back()->withInput()->with('errors', $objectiveModel->errors());
		}
	}

	// Function untuk Delete Data
	public function deleteObjective($id)
	{
		$objectiveModel = new ObjectiveModel();
		if ($objectiveModel->deleteObjectiveModel($id)) {
			// Debugging message
			echo "Objective deleted successfully";
			return redirect()->to('/dashboard/objective')->with('message', 'Objective berhasil dihapus');
		} else {
			// Debugging message
			echo "Failed to delete objective";
			return redirect()->back()->with('message', 'Gagal menghapus objective');
		}
	}
}
