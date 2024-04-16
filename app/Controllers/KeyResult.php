<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KeyResultModel;
use App\Models\ObjectiveModel;

class KeyResult extends BaseController
{
	// Function for Get All Data
	public function getAllKeyResult(): string
	{
		$krModel = new KeyResultModel();
		$data['key_results'] = $krModel->getKeyResultWithAssign();

		return view('admin/key_result_view', $data);
	}

	// // Function for Get Data By Id
	// public function getUserById($id) : string 
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

	// Function for Create Key Result
	public function renderPageCreateKeyResult(): string
	{
		$krModel = new KeyResultModel();
		$data['key_results'] = $krModel->findAll();

		$objectiveModel = new ObjectiveModel();
		$data['objectives'] = $objectiveModel->findAll();

		$userModel = new UserModel();
		$data['users'] = $userModel->where('id_role', 3)->findAll();

		return view('admin/key_result_create', $data);
	}

	public function createKeyResult()
	{
		$krModel = new KeyResultModel();
		$data = $this->request->getPost();

		if ($krModel->createKeyResultsModel($data)) {
			return redirect()->to('/dashboard/key_result')->with('message', 'Key result berhasil ditambahkan');
		} else {
			return redirect()->back()->withInput()->with('errors', $krModel->errors());
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

	public function deleteKeyResult($id)
	{
		$krModel = new KeyResultModel();
		if ($krModel->deleteKeyResultsModel($id)) {
			// Debugging message
			echo "Key result deleted successfully";
			return redirect()->to('/dashboard/key_result')->with('message', 'Key result berhasil dihapus');
		} else {
			// Debugging message
			echo "Failed to delete key result";
			return redirect()->back()->with('message', 'Gagal menghapus key result');
		}
	}
}
