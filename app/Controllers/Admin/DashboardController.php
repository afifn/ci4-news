<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\News;

class DashboardController extends BaseController
{
	public function index()
	{
		$data['title'] = 'Dashboard';
		$news = new News();
		$db = db_connect();
		$query = $db->query("SELECT count(id_news) as count, date_part('month', created_at) as month FROM news GROUP BY date_part('month', created_at) ORDER BY month ASC");
		$data['news'] = $query->getResultArray();

		// echo '<pre>';
		// print_r($query);
		// die();
		return view('admin/index', $data);
	}

	public function getChart()
	{
	}
}
