<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class UserController extends BaseController
{
	protected $user;
	public function __construct()
	{
		$this->user = new User();
	}
	public function index()
	{
		$data['title'] = 'User';
		$data['users'] = $this->user->findAll();
		return view('admin/user', $data);
	}

	public function store()
	{
		$post = $this->request->getPost();
		$rules = [
			'name' => 'required|string',
			'email' => 'required|valid_email',
			'password' => 'required'
		];

		if (!$this->validate($rules)) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}

		$isEmail = $this->user->where('email', $post['email'])->first();

		if ($isEmail) {
			session()->setFlashdata('error', 'Email sudah digunakan, ganti dengan yang lain');
			return redirect()->back()->withInput();
		}

		$this->user->insert([
			'name' => $post['name'],
			'email' => $post['email'],
			'password' => password_hash($post['password'], PASSWORD_BCRYPT)
		]);

		session()->setFlashdata('success', 'User created');
		return redirect('admin/user');
	}

	public function update($id)
	{
		$post = $this->request->getPost();
		$pass = $post['old_password'];
		$npass = $post['password'];

		$isPassword = $this->user->findPassword($id);
		$old_password = $isPassword[0]['password'];

		$this->user->update($id, [
			'name' => $post['name'],
			'password' => password_hash($npass, PASSWORD_BCRYPT)
		]);
		session()->setFlashdata('success', 'User updated');
		return redirect('admin/user');
	}

	public function delete($id)
	{
		$this->user->delete($id);
		session()->setFlashdata('success', 'User deleted');
		return redirect('admin/user');
	}
}
