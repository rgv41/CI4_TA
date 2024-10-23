<?php

namespace App\Controllers;

use App\Models\RatingOutputModel;
use App\Models\UserModel;

class RatingOutput extends BaseController
{
	// Function Get All RatingOuput
	public function getAllRatingOutput(): string
	{
		$roModel = new RatingOutputModel();
		$ratingOutputs = $roModel->getAllRatingOutput();
		$data['rating_outputs'] = $ratingOutputs;
		return view('admin/rekap_rate_view', $data);
	}


	// Function Delete RatingOutput
	public function deleteRatingOutput($id)
	{
		$roModel = new RatingOutputModel();
		if ($roModel->deleteRatingOutputModel($id)) {
			return redirect()->to('/dashboard/rating_output')->with('message', 'Rating output berhasil dihapus');
		} else {
			return redirect()->back()->with('message', 'Gagal menghapus rating output');
		}
	}
}
