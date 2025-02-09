<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;

class CorsController extends BaseController
{
    public function preflight()
    {
        return $this->response
            ->setStatusCode(200)
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE, PATCH')
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->setHeader('Access-Control-Allow-Credentials', 'true')
            ->setHeader('Access-Control-Max-Age', '3600')
            ->setBody('OK');
    }
}