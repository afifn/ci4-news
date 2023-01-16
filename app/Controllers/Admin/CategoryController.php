<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;
use Config\Services;

class CategoryController extends BaseController
{
	protected $category;
	public function __construct()
	{
		$this->category = new Category();
	}
	public function index()
	{
		$data['category'] = $this->category->orderBy('name', 'ASC')->findAll();
		$data['active'] = 'active';
		$data['title'] = 'Category';
		return view('admin/category', $data);
	}
	public function store()
	{
		$name = $this->request->getPost('name');
		$slug = $this->createSlug($name);
		$this->category->insert([
			'name' => $name,
			'slug' => $slug
		]);
		session()->setFlashdata('message', 'Category created');
		return redirect('admin/category');
	}

	public function update($id)
	{
		$name = $this->request->getPost('name');
		$slug = $this->createSlug($name);
		$this->category->update($id, [
			'name' => $name,
			'slug' => $slug
		]);
		session()->setFlashdata('message', 'Category updated');
		return redirect('admin/category');
	}
	public function delete($id)
	{
		$this->category->delete($id);
		session()->setFlashdata('message', 'Category deleted');
		return redirect()->to('/admin/category');
	}

	public static function createSlug($str, $delimiter = '-')
	{
		$slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
		return $slug;
	}
}
