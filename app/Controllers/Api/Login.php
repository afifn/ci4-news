<?php

namespace App\Controllers\Api;

use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use DateTime;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Login extends ResourceController
{
	use ResponseTrait;

	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$rules = [
			'email' => 'required|string',
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

	/**
	 * Return the properties of a resource object
	 *
	 * @return mixed
	 */
	public function show($id = null)
	{
		//
	}

	/**
	 * Return a new resource object, with default properties
	 *
	 * @return mixed
	 */
	public function new()
	{
		//
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		//
	}

	/**
	 * Return the editable properties of a resource object
	 *
	 * @return mixed
	 */
	public function edit($id = null)
	{
		//
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		//
	}

	/**
	 * Delete the designated resource object from the model
	 *
	 * @return mixed
	 */
	public function delete($id = null)
	{
		//
	}
}
