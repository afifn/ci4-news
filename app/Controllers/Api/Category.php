<?php

namespace App\Controllers\Api;

use App\Models\Category as ModelsCategory;
use App\Models\News;
use CodeIgniter\HTTP\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Category extends ResourceController
{
	use ResponseTrait;

	public function index()
	{
		$category = new ModelsCategory();
		$news = new News();

		$news = $news->category();
		// $data = $category->findAll();

		$map = [];
		foreach ($news as $cat) {
			$key = $cat['category'];
			if (!isset($map[$key])) {
				$map[$key] = [
					'id_category' => $cat['id_category'],
					'category' => $cat['category'],
				];
			}
			$map[$key]['news'][] = $cat;
		}

		$response = [
			'message' => 'successfully fetch data',
			'error' => false,
			'data' => $map
		];
		return $this->respond($response);
	}

	public function show($name = null)
	{
		$news = new News();
		$data = $news->findCategoryByName($name);

		$response = [
			'message' => 'successfully fetch data',
			'error' => false,
			'data' => $data,
		];
		return $this->respond($response);
	}
}
