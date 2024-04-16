<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KeyResultModel;

class KeyResult extends BaseController
{
	// Function for Get All Data
	public function getAllKeyResult(): string
	{
		$krModel = new KeyResultModel();
		$data['key_results'] = $krModel->getKeyResultWithAssign();

		return view('admin/key_result_view', $data);
	}
}
