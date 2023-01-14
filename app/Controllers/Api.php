<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\News;
use CodeIgniter\API\ResponseTrait;

class Api extends BaseController
{
	use ResponseTrait;
	public function sesuatu()
	{
		$limit = $_POST['limit'];
		$offset = $_POST['offset'] * $limit;

		$db = new News();
		$q = $db->limit($limit)->offset($offset)->orderBy('id_news', 'ASC')->get()->getResultArray();
		$data['limit'] = $limit;
		$data['offset'] = $_POST['offset'];
		$data['data'] = $q;

		return $this->respond($data);
	}
}
