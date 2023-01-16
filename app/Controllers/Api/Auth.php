<?php

namespace App\Controllers\Api;

use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use DateTime;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth extends ResourceController
{
	use ResponseTrait;

	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function login()
	{
		$rules = [
			'email' => 'required|valid_email',
			'password' => 'required|min_length[6]'
		];
		if (!$this->validate($rules)) {
			return $this->fail($this->validator->getErrors());
		}
		$model = new User();
		$user = $model->where('email', $this->request->getVar('email'))->first();
		if ($user) {
			$isValidPassword = password_verify($this->request->getVar('password'), $user['password']);
			if ($isValidPassword) {
				$token = $this->generateToken($user);
				$reponse = [
					'message' => 'login successfully',
					'token' => $token
				];
				return $this->respond($reponse, 200);
			}
		} else {
			return $this->respond(['error' => 'Invalid email or password']);
		}
	}

	public function generateToken($user)
	{
		$key = getenv('TOKEN_SECRET');

		$now = time();
		$addDays = $now + (60 * 60 * 24 * 1); // tambah hari // tambah menit = (menit * 60)
		$endDate = date('m-d-Y H:i:s', $addDays);
		// $exp = DateTime::createFromFormat('d-m-Y H:i:s', $endDate);
		$exp = $now + 3600;

		$payload = [
			'iss' => 'news.id',
			'nbf' => $now,
			'iat' => $now,
			'exp' => $exp,
			'email' => $user['email'],
		];
		$token = JWT::encode($payload, $key, 'HS256');
		return $token;
	}

	public function register()
	{
		$rules = [
			'name' => 'required|string',
			'email' => 'required|string|valid_email',
			'password' => 'required|string'
		];
		$name = $this->request->getVar('name');
		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		if (!$this->validate($rules)) {
			return $this->fail($this->validator->getErrors());
		}
		$data = [
			'name' => $name,
			'email' => $email,
			'password' => password_hash($password, PASSWORD_BCRYPT)
		];
		$model = new User();
		$isEmail = $model->where('email', $this->request->getVar('email'))->first();
		if ($isEmail) {
			$reponse = [
				'message' => 'email has been used',
				'error' => true
			];
			return $this->respond($reponse);
		} else {
			$model->insert($data);
			return $this->respond(['message' => 'success', 'error' => false]);
		}
	}
}
