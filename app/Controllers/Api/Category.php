<?php

namespace App\Controllers\Api;

use App\Models\Category as ModelsCategory;
use App\Models\News;
use CodeIgniter\HTTP\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Category extends ResourceController
{
	use ResponseTrait;
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$category = new ModelsCategory();
		$category = $category->findAll();

		$response = [
			'message' => 'successfully fetch data',
			'error' => false,
			'data' => $category
		];
		return $this->respond($response);
	}

	/**
	 * Return the properties of a resource object
	 *
	 * @return mixed
	 */
	public function show($name = null)
	{
		$news = new News();
		$category = $news->findCategoryByName($name);

		$response = [
			'message' => 'successfully fetch data',
			'error' => false,
			'data' => $category
		];
		return $this->respond($response);
	}
}
