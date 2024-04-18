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

	// Function for Get All Data By User
	public function getKeyResultByUser(): string
    {
        $krModel = new KeyResultModel();
		$userId = session()->get('id_user');

        $data['key_results'] = $krModel->getKeyResultWithAssignByUser($userId);

        return view('karyawan/nilai_kr_view', $data);
    }

	public function getKeyResultByAssign(): string
	{
		$krModel = new KeyResultModel();
		$assignId = session()->get('id_user');

		$data['key_results'] = $krModel->getKeyResultByAssigner($assignId);

		return view('assigner/nilai_kr_view', $data);
	}

	// Function for Get Key Result By Id
	public function getKeyResultById($id) : string 
	{
		$krModel = new KeyResultModel();
		$userId = session()->get('id_user');
		$key_result = $krModel->getKeyResultByUserById($userId, $id);

		$data['key_results'] = $key_result;
		return view('karyawan/nilai_kr_detail', $data);
	}

	// Function untuk Get Key Result By Id (Assign)
	public function getKeyResultByIdForAssign($id) : string 
	{
		$krModel = new KeyResultModel();
		$assignId = session()->get('id_user');
		$key_result = $krModel->getKeyResultByAssignerById($assignId, $id);

		$data['key_results'] = $key_result;
		return view('assigner/nilai_kr_detail', $data);
	}

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

	// Function Update Key Result for Admin
	public function renderPageUpdateKeyResultByAdmin($id): string
	{
		$krModel = new KeyResultModel();

		$data['key_results'] = $krModel->find($id);
		
		return view('admin/key_result_update', $data);
	}

	// Function for Assign Data
	public function renderPageAssignKeyResult($id): string
	{
		$krModel = new KeyResultModel();
		$assignId = session()->get('id_user');
		$key_result = $krModel->getKeyResultByAssignerById($assignId, $id);

		$data['key_results'] = $key_result;
		return view('assigner/nilai_kr_assign', $data);
	}

	// Functin for Update Data
	public function renderPageUpdateKeyResult($id): string
	{
		$krModel = new KeyResultModel();
		$userId = session()->get('id_user');
		$key_result = $krModel->getKeyResultByUserById($userId, $id);

		$data['key_results'] = $key_result;
		return view('karyawan/nilai_kr_update', $data);
	}

	// Function Update Key Result by Admin
	public function updateKeyResultByAdmin($id)
	{
		$krModel = new KeyResultModel();
		$data = $this->request->getPost();

		if ($krModel->updateKeyResultsModel($id, $data)) {
			return redirect()->to('/dashboard/key_result')->with('message', 'Key result berhasil diupdate');
		} else {
			return redirect()->back()->withInput()->with('errors', $krModel->errors());
		}
	}

	public function updateKeyResult($id)
	{
		$krModel = new KeyResultModel();
		$data = $this->request->getPost();

		if ($krModel->updateKeyResultsModel($id, $data)) {
			return redirect()->to('/dashboard/karyawan/nilai_pemeriksaan')->with('message', 'Key Result berhasil diupdate');
		} else {
			return redirect()->back()->withInput()->with('errors', $krModel->errors());
		}
	}

	public function assignKeyResult($id)
	{
		$krModel = new KeyResultModel();
		$data = $this->request->getPost();

		if ($krModel->updateKeyResultsModel($id, $data)) {
			return redirect()->to('/dashboard/assign/nilai_pemeriksaan')->with('message', 'Key Result berhasil diupdate');
		} else {
			return redirect()->back()->withInput()->with('errors', $krModel->errors());
		}
	}

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
