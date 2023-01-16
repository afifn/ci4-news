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

	public function get($id)
	{
		$contact = $this->contact->where('id_contact', $id)->get()->getRowArray();
		$data = json_encode($contact);
		return $data;
		// echo '<pre>';
		// print_r($data);
	}

	public function delete($id)
	{
		$this->contact->delete($id);
		session()->setFlashdata('message', 'Contact deleted');
		return redirect('admin/contact');
	}
}
