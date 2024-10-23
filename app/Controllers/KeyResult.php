<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KeyResultModel;
use App\Models\ObjectiveModel;
use App\Models\RatingOutputModel;

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
	public function getKeyResultById($id): string
	{
		$krModel = new KeyResultModel();
		$userId = session()->get('id_user');
		$key_result = $krModel->getKeyResultByUserById($userId, $id);

		$data['key_results'] = $key_result;
		return view('karyawan/nilai_kr_detail', $data);
	}

	// Function untuk Get Key Result By Id (Assign)
	public function getKeyResultByIdForAssign($id): string
	{
		$krModel = new KeyResultModel();
		$assignId = session()->get('id_user');
		$key_result = $krModel->getKeyResultByAssignerById($assignId, $id);

		$data['key_results'] = $key_result;
		return view('assigner/nilai_kr_detail', $data);
	}

	// Metode untuk menampilkan halaman pembuatan Key Result
	public function renderPageCreateKeyResult(): string
	{
		$krModel = new KeyResultModel();
		$data['key_results'] = $krModel->findAll();

		$objectiveModel = new ObjectiveModel();
		$data['objectives'] = $objectiveModel->getObjectWithRoles(); // Ambil data dengan nama user

		$userModel = new UserModel();
		$data['assignors'] = $userModel->where('id_role', 3)->findAll(); // Assignor
		$data['employees'] = $userModel->where('id_role', 2)->findAll(); // Karyawan

		return view('admin/key_result_create', $data);
	}


	// Metode untuk mengambil objectives berdasarkan ID karyawan
	public function getObjectivesByEmployee($employeeId)
	{
		$objectiveModel = new ObjectiveModel();
		$objectives = $objectiveModel->getObjectivesByEmployee($employeeId);
		return $this->response->setJSON($objectives);
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
		$roModel = new RatingOutputModel();
		$objModel = new ObjectiveModel(); // Tambahkan model Objective

		// Ambil data dari form
		$data = $this->request->getPost();

		// Ambil key result yang di-assign
		$keyResult = $krModel->find($id);

		// Ambil id_user dari tabel objectives berdasarkan key result id
		$objective = $objModel->find($keyResult['id_objective']);
		$userId = $objective['id_user']; // Ambil id_user dari objective

		// Hitung data Q1 dan Q2
		$output_target_q1 = ((($keyResult['target_q1'] / $keyResult['progress_q1']) * 100) * 60 >= 60) ? 60.00 : ((($keyResult['target_q1'] / $keyResult['progress_q1']) * 100) * 60);
		$output_target_q2 = ((($keyResult['target_q2'] / $keyResult['progress_q2']) * 100) * 60 >= 60) ? 60.00 : ((($keyResult['target_q2'] / $keyResult['progress_q2']) * 100) * 60);

		// Buat data untuk dimasukkan ke dalam tabel rating_outputs
		$ratingOutputData = [
			'id_kr' => $keyResult['id_kr'],
			'output_target_q1' => $output_target_q1,
			'output_target_q2' => $output_target_q2,
			'id_user' => $userId // Tambahkan id_user
		];

		// Masukkan data ke dalam tabel rating_outputs
		if ($roModel->createRatingOutputModel($ratingOutputData)) {
			// Ambil ID dari data rating_outputs yang baru saja dimasukkan
			$roId = $roModel->getInsertID();

			// Hitung rating_value_q1 dan rating_value_q2 berdasarkan ID yang baru saja dimasukkan
			$rating_value_q1 = ((($data['assignor_rate_q1'] * 10) + 60) * 0.4 < 25) ? "" : ((($data['assignor_rate_q1'] * 10) + 60) * 0.4);
			$rating_value_q2 = ((($data['assignor_rate_q2'] * 10) + 60) * 0.4 < 25) ? "" : ((($data['assignor_rate_q2'] * 10) + 60) * 0.4);

			// Hitung okr_score_q1 dan okr_score_q2
			if ($rating_value_q1 !== "" && $rating_value_q2 !== "") {
				$okr_score_q1 = $output_target_q1 + $rating_value_q1;
				$okr_score_q2 = $output_target_q2 + $rating_value_q2;
			} else {
				$okr_score_q1 = "";
				$okr_score_q2 = "";
			}

			// Hitung overall_okr_score
			if ($okr_score_q1 !== "" && $okr_score_q2 !== "") {
				$overall_okr_score = ($okr_score_q1 + $okr_score_q2) / 2;
			} else {
				$overall_okr_score = null;
			}

			// Update rating_value_q1, rating_value_q2, okr_score_q1, okr_score_q2, dan overall_okr_score berdasarkan ID yang baru saja dimasukkan
			$roModel->update($roId, [
				'rating_value_q1' => $rating_value_q1,
				'rating_value_q2' => $rating_value_q2,
				'okr_score_q1' => $okr_score_q1,
				'okr_score_q2' => $okr_score_q2,
				'overall_okr_score' => $overall_okr_score,
				'id_user' => $userId // Tambahkan id_user saat update
			]);

			// Update data di tabel key_results
			if ($krModel->updateKeyResultsModel($id, $data)) {
				return redirect()->to('/dashboard/assign/nilai_pemeriksaan')->with('message', 'Key Result berhasil diupdate');
			} else {
				return redirect()->back()->withInput()->with('errors', $krModel->errors());
			}
		} else {
			return redirect()->back()->withInput()->with('errors', $roModel->errors());
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
