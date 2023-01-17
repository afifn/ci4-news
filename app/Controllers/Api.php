<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Setting;
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
	public function about()
	{
		$about = new Setting();
		$gallery = new Gallery();

		$data = $about->findAll();
		// $data['gallery'] = $gallery->findAll();
		$response = [
			'message' => 'success',
			'error' => false,
			'data' => $data
		];
		return $this->respond($response);
	}

	public function gallery()
	{
		$gallery = new Gallery();

		$data = $gallery->getGallery();
		$response = [
			'message' => 'success',
			'error' => false,
			'data' => $data
		];
		return $this->respond($response);
	}
}
