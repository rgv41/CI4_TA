<?php

namespace App\Controllers;

use App\Models\RatingOutputModel;

class RatingOutput extends BaseController
{
	// Function Get All RatingOuput
	public function getAllRatingOuput(): string
	{
		$roModel = new RatingOutputModel();
		$data['rating_outputs'] = $roModel->getAllRatingOutput();

		return view('admin/rekap_rate_view', $data);
	}

	// Function Delete RatingOutput
	public function deleteRatingOutput($id)
	{
		$roModel = new RatingOutputModel();
		if ($roModel->deleteRatingOutputModel($id)) {
			// Debugging message
			echo "Rating output deleted successfully";
			return redirect()->to('/dashboard/rating_output')->with('message', 'Rating output berhasil dihapus');
		} else {
			// Debugging message
			echo "Failed to delete rating output";
			return redirect()->back()->with('message', 'Gagal menghapus rating output');
		}
	}
}
