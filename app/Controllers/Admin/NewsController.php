<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\News;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\I18n\Time;
use SebastianBergmann\CodeCoverage\Report\Xml\File;

class NewsController extends BaseController
{
	protected $news;
	protected $category;
	public	$filePath;
	public function __construct()
	{
		$this->news = new News();
		$this->category = new Category();
		$this->filePath = ROOTPATH . 'public/assets/upload/';
	}
	public function index()
	{
		$data['title'] = 'News';
		$data['newss'] = $this->news->orderBy('id_news', 'DESC')->category();

		$data['category'] = $this->category->findAll();
		return view('admin/news', $data);
	}

	public function get($id)
	{
		$data = $this->news->where('id_news', $id)->category();
		$data = $this->news->first();
		// echo '<pre>';
		// print_r($data);
		return $data['content'];
	}

	public function store()
	{
		$title = $_POST['title'];
		$slug =  $this->createSlug($title);

		if (!$this->validate([
			'poster' => [
				'rules' => 'uploaded[poster]'
					. '|mime_in[poster,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
			]
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
		$img = $this->request->getFile('poster');
		$img->move($this->filePath);

		$this->news->insert([
			'title' => $title,
			'id_category' => $_POST['id_category'],
			'author' => $_POST['author'],
			'slug' => $slug,
			'content' => $_POST['content'],
			'poster' => $img->getName(),
			'created_at' => date('d-m-Y'),
		]);
		session()->setFlashdata('success', 'News created');
		return redirect('admin/news');
	}

	public function update($id)
	{
		$title = $_POST['title'];
		$slug = $this->createSlug($title);

		$img = $this->request->getFile('poster');
		if (!empty($_FILES['poster']['name'])) {
			if (!$this->validate([
				'poster' => [
					'rules' => 'uploaded[poster]'
						. '|mime_in[poster,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
				]
			])) {
				session()->setFlashdata('error', $this->validator->listErrors());
				return redirect()->back()->withInput();
			}
			$img->move($this->filePath);

			$baseFile = $this->news->where('id_news', $id)->find();
			@unlink($this->filePath . $baseFile[0]['poster']);

			$this->news->update($id, [
				'title' => $title,
				'id_category' => $_POST['id_category'],
				'author' => $_POST['author'],
				'slug' => $slug,
				'content' => $_POST['content'],
				'poster' => $img->getName()
			]);
		} else {
			$this->news->update($id, [
				'title' => $title,
				'id_category' => $_POST['id_category'],
				'author' => $_POST['author'],
				'slug' => $slug,
				'content' => $_POST['content']
			]);
		}
		session()->setFlashdata('success', 'News updated');
		return redirect('admin/news');
	}
	public function delete($id)
	{
		$poster = $this->news->where('id_news', $id)->find();
		@unlink($this->filePath . $poster[0]['poster']);
		$this->news->delete($id);
		session()->setFlashdata('success', 'News deleted');
		return redirect('admin/news');
	}

	public function view($id)
	{
		$data['newss'] = $this->news->findWithCategory($id);
		$data['title'] = $data['newss'][0]['title'];
		if (!$data['newss']) {
			throw PageNotFoundException::forPageNotFound();
		}
		return view('admin/view_news', $data);
	}

	public static function createSlug($str, $delimiter = '-')
	{
		$slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
		return $slug;
	}
}
