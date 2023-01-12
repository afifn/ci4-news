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
		$news = $this->news->pagerNews();
		$pager = service('pager');
		$page = (int) (($this->request->getVar('page') !== null) ? $this->request->getVar('page') : 1) - 1;
		$perPage = 5;
		$total = count($news);
		$pager->makeLinks($page + 1, $perPage, $total);
		$offset = $page * $perPage;
		$data['newss'] = $this->news->pagerNews($perPage, $offset);
		return view('home', $data);
	}

	public function view($slug)
	{
		$data['news'] = $this->news->findWithSlug($slug);
		return view('view_news', $data);
	}

	public function about()
	{
		$data = [
			'title' => 'About Page'
		];
		return view('about', $data);
	}
}
