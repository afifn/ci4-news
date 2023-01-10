<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
	protected $user;
	public function __construct()
	{
		$this->user = new User();
	}
	public function index()
	{
		if (session()->get('id_user')) {
			return redirect()->to('admin');
		}
		return view('admin/login');
	}

	public function auth()
	{
		$post = $this->request->getPost();
		$query = $this->user->where('email', $post['email'])->first();
		if ($query) {
			if (password_verify($post['password'], $query['password'])) {
				$param = [
					'id_user' => $query['id_user']
				];
				session()->set($param);

				return redirect('admin');
			} else {
				return redirect()->back()->with('message', 'Password salah');
			}
		} else {
			return redirect()->back()->with('message', 'User tidak ditemukan');
		}
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('login');
	}
}
