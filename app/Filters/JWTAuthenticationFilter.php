<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\Config\Services;

class JWTAuthenticationFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');
        if (!$header) {
            return Services::response()->setJSON(['error' => 'Authorization header missing'])->setStatusCode(401);
        }

        $token = explode(' ', $header)[1] ?? null;

        if (!$token) {
            return Services::response()->setJSON(['error' => 'Token missing'])->setStatusCode(401);
        }

        try {
            $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
        } catch (\Exception $e) {
            return Services::response()->setJSON(['error' => 'Invalid token'])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
