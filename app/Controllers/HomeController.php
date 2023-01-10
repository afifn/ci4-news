<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\News;

class HomeController extends BaseController
{
	protected $news;
	public function __construct()
	{
		$this->news = new News();
	}
	public function index()
	{
		$data['title'] = 'News Today';
		$data['news'] = $this->news->orderBy('id_news', 'DESC')->category();
		return view('home', $data);
	}

	public function view($slug)
	{
		$data['news'] = $this->news->findWithSlug($slug);
		return view('view_news', $data);
	}
}
