<?php

namespace App\Controllers\Api;

use App\Models\News as ModelsNews;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class News extends ResourceController
{
	use ResponseTrait;
	protected $news;
	protected $filePath;
	public function __construct()
	{
		$this->news = new ModelsNews();
		$this->filePath = ROOTPATH . 'public/assets/upload/';
	}
	public function index()
	{
		$defaultSize = 5;
		$news = $this->news->pagerNews();
		$pager = service('pager');
		$page = (int) (($this->request->getVar('page') !== null) ? $this->request->getVar('page') : 1) - 1;
		$perPage = (int) (($this->request->getVar('size') !== null) ? $this->request->getVar('size') : $defaultSize);
		$total = count($news);
		$pager->makeLinks($page + 1, $perPage + 1, $total);
		$offset = $page * $perPage;
		$data['newss'] = $this->news->pagerNews($perPage, $offset);
		$response = [
			'message' => 'news fetched successfully',
			'error' => false,
			'data' => $data['newss']
		];
		return $this->respond($response);
	}

	public function show($id = null)
	{
		$news = $this->news->getWhere(['id_news' => $id])->getResult();
		if ($news) {
			return $this->respond($news);
		} else {
			return $this->failNotFound('No data found with id ' . $id);
		}
	}

	public function create()
	{
		$data = [
			'title' => $this->request->getPost('title'),
			'id_category' => $this->request->getPost('id_category'),
			'author' => $this->request->getPost('author'),
			'slug' => $this->createSlug($this->request->getPost('title')),
			'content' => $this->request->getPost('content'),
			'created_at' => date('d-m-Y'),
			'poster' => $this->request->getPost('poster'),
		];

		$this->news->save($data);
		$response = [
			'status' => '201',
			'error' => false,
			'message' => [
				'success' => 'Data saved'
			]
		];

		// if (!$this->news->save($data)) {
		// 	return $this->fail($this->news->errors());
		// }
		return $this->respondCreated($data, 'News created');
	}

	public function update($id = null)
	{
		$json = $this->request->getJSON();
		if ($json) {
			$data = [
				'title' => $json->title,
				'id_category' => $json->id_category,
				'author' => $json->author,
				'slug' => $this->createSlug($json->title),
				'content' => $json->content,
			];
		} else {
			$input = $this->request->getRawInput();
			$data = [
				'title' => $input['title'],
				'id_category' => $input['id_category'],
				'author' => $input['author'],
				'slug' => $this->createSlug($input['title']),
				'content' => $input['content'],
			];
		}

		$this->news->update($id, $data);

		$response = [
			'status' => '201',
			'error' => false,
			'message' => [
				'success' => 'Data updated'
			]
		];
		return $this->respond($response);
	}

	public function delete($id = null)
	{
		$data = $this->news->where('id_news', $id)->find();
		if ($data) {
			@unlink($this->filePath . $data['poster']);
			$this->news->delete($id);
			$response = [
				'status' => '200',
				'error' => false,
				'message' => [
					'success' => 'Data deleted'
				]
			];
			return $this->respondDeleted($response);
		} else {
			return $this->failNotFound('Data not found with id ' . $id);
		}
	}

	public static function createSlug($str, $delimiter = '-')
	{
		$slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
		return $slug;
	}
}
