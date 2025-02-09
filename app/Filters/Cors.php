<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Cors implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get response service to set headers
        $response = service('response');
        $this->addCorsHeaders($response);

        // Handle preflight (OPTIONS) request
        if ($request->getMethod() === 'options') {
            return $response->setStatusCode(200)->setBody('OK');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Ensure CORS headers are always applied in response
        $this->addCorsHeaders($response);
    }

    private function addCorsHeaders(ResponseInterface $response)
    {
        $response->setHeader('Access-Control-Allow-Origin', '*');  // Use '*' for testing; restrict to 'http://localhost:8100' in production.
        $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE, PATCH');
        $response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->setHeader('Access-Control-Allow-Credentials', 'true');
        $response->setHeader('Access-Control-Max-Age', '3600');
    }
}