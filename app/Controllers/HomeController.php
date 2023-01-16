<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Setting;
use DateTime;

class HomeController extends BaseController
{
	protected $news;
	protected $setting;
	public function __construct()
	{
		$this->news = new News();
		$this->setting = new Setting();
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

		//setting
		$data['setting'] = $this->setting->find();
		return view('home', $data);
	}

	public function view($slug)
	{
		$news = $this->news->pagerNews();
		$pager = service('pager');
		$page = (int) (($this->request->getVar('page') !== null) ? $this->request->getVar('page') : 1) - 1;
		$perPage = 5;
		$total = count($news);
		$pager->makeLinks($page + 1, $perPage, $total);
		$offset = $page * $perPage;
		$data['newss'] = $this->news->pagerNews($perPage, $offset);
		$data['setting'] = $this->setting->find();
		$data['news'] = $this->news->findWithSlug($slug);
		return view('view_news', $data);
	}

	public function about()
	{
		$galleries = new Gallery();
		$data['galleries'] = $galleries->findAll();
		$data['setting'] = $this->setting->find();
		$data['title'] = 'About Page';
		return view('about', $data);
	}

	public function contact()
	{
		return view('contact');
	}

	public function addContact()
	{
		$contact = new Contact();
		$post = $this->request->getPost();
		$data = [
			'name' => $post['name'],
			'email' => $post['email'],
			'message' => $post['message'],
		];
		$contact->insert($data);
		session()->setFlashdata('message', 'Message has been sent');
		return redirect('contact');
	}
}
