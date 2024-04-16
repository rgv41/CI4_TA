<?php

namespace App\Controllers;

use App\Models\UserModel;
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

	// // Function for Get Data By Id
	// public function getObjectiveById($id) : string 
	// {
	// 	$userModel = new UserModel();
	// 	$roleModel = new RoleModel();
	// 	$user = $userModel->find($id);

	// 	if (!$user) {
	// 		return 'User not found';
	// 	}

	// 	$role = $roleModel->find($user['id_role']);
	// 	$user['role_name'] = $role ? $role['nama_role'] : '';
	// 	$data['user'] = $user;
	// 	return view('admin/user_detail', $data);
	// }

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

		if ($objectiveModel->createObjeciveModel($data)) {
			return redirect()->to('/dashboard/objective')->with('message', 'Objective berhasil ditambahkan');
		} else {
			return redirect()->back()->withInput()->with('errors', $userModel->errors());
		}
	}

	// // Functin for Update Data
	// public function renderPageUpdateUser($id): string
	// {
	// 	$userModel = new UserModel();
	// 	$roleModel = new RoleModel();

	// 	$data['user'] = $userModel->find($id);
	// 	$data['roles'] = $roleModel->findAll();
		
	// 	return view('admin/user_update', $data);
	// }

	// public function updateUser($id)
	// {
	// 	$userModel = new UserModel();
	// 	$data = $this->request->getPost();

	// 	if ($userModel->updateUserModel($id, $data)) {
	// 		return redirect()->to('/dashboard/user')->with('message', 'User berhasil diupdate');
	// 	} else {
	// 		return redirect()->back()->withInput()->with('errors', $userModel->errors());
	// 	}
	// }

	public function deleteObjective($id)
	{
		$objectiveModel = new ObjectiveModel();
		if ($objectiveModel->deleteObjeciveModel($id)) {
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
