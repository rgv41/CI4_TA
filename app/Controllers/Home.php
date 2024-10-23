<?php

namespace App\Controllers;

use App\Models\KMeansModel;
use App\Models\UserModel;
use App\Models\ObjectiveModel;
use App\Models\KeyResultModel;

class Home extends BaseController
{
	public function index(): string
	{
		// Instantiate the model
		$kmeansModel = new KMeansModel();
		$userModel = new UserModel();
		$objectiveModel = new ObjectiveModel();
		$keyResultModel = new KeyResultModel();

		// Fetch data
		$clusterSummary = $kmeansModel->getClusterSummary();
		$totalUserCount = $kmeansModel->getTotalUserCount();
		$userCount = $userModel->countAll();
		$objectiveCount = $objectiveModel->countAll();
		$keyResultCount = $keyResultModel->countAll();

		// Prepare data to be passed to the view
		$data = [
			'users' => $userCount,
			'objectives' => $objectiveCount,
			'keyResults' => $keyResultCount,
			'totalUsers' => $totalUserCount['total_users'],
			'clusterSummary' => $clusterSummary
		];

		return view('index', $data);
	}
}
