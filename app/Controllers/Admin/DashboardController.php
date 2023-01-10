<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
	public function index()
	{
		$data['active'] = 'active';
		$data['title'] = 'Dashboard';
		return view('admin/index', $data);
	}
}
