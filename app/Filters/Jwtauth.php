<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\Message;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Jwtauth implements FilterInterface
{
	/**
	 * Do whatever processing this filter needs to do.
	 * By default it should not return anything during
	 * normal execution. However, when an abnormal state
	 * is found, it should return an instance of
	 * CodeIgniter\HTTP\Response. If it does, script
	 * execution will end and that Response will be
	 * sent back to the client, allowing for error pages,
	 * redirects, etc.
	 *
	 * @param RequestInterface $request
	 * @param array|null       $arguments
	 *
	 * @return mixed
	 */
	public function before(RequestInterface $request, $arguments = null)
	{
		$key = getenv('TOKEN_SECRET');
		$header = $request->getServer('HTTP_AUTHORIZATION');
		$token = null;

		if (!empty($header)) {
			if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
				$token = $matches[1];
			}
		}

		// cek token null
		if (is_null($token) || empty($token)) {
			return Services::response()
				->setJSON([
					'message' => 'Token required',
					'error' => true
				])
				->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
		}

		try {
			$decode = JWT::decode($token, new Key($key, 'HS256'));
		} catch (\Throwable $e) {
			return Services::response()
				->setJSON([
					'message' => 'Invalid token',
					'error' => true
				])
				->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * Allows After filters to inspect and modify the response
	 * object as needed. This method does not allow any way
	 * to stop execution of other after filters, short of
	 * throwing an Exception or Error.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param array|null        $arguments
	 *
	 * @return mixed
	 */
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
