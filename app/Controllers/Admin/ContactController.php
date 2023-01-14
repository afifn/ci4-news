<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Contact;

class ContactController extends BaseController
{
	protected $contact;
	public function __construct()
	{
		$this->contact = new Contact();
	}
	public function index()
	{
		$data['contacts'] = $this->contact->findAll();
		return view('admin/contact', $data);
	}
}
