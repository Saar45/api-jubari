<?php

/*namespace App\Controllers;

use App\Models\Employe;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class Login extends ResourceController
{
    public function login()
    {
        $employe = new Employe();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $user = $employe->where('email', $email)->first();
        
        if (is_null($user)) {
            return $this->fail('Identifiants invalides', 401);
        }

        // Verify the password using password_verify
        if (!password_verify($password, $user->password)) {
            return $this->fail('Identifiants invalides', 401);
        }

        $key = getenv('JWT_SECRET');
        $iat = time();
        $exp = $iat + 3600;
        
        $payload = array(
            "sub"   => "API Jubari",
            "email" => $user->email,
            "iat"   => $iat,      
            "exp"   => $exp  
        );
        
        $token = JWT::encode($payload, $key, 'HS256');
        $response = [
            'message' => 'Connexion réussie', 
            'token' => $token, 
            'user_id' => $user->id
        ]; 
        
        return $this->respond($response);
    }
}*/

//<?php

namespace App\Controllers;

use App\Models\Employe;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class Login extends ResourceController
{
    public function login()
    {
        $employe = new Employe();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $user = $employe->where('email', $email)->first();
        if (is_null($user)) {
            return $this->fail('Identifiants invalides', 401);
        }
        if ($password != $user->password) {
            return $this->fail('Identifiants invalides', 401);
        }
        $key = getenv('JWT_SECRET');
        $iat = time();
        $exp = $iat + 3600;
        $payload = array(
            "sub"   => "API Jubari",
            "email" => $user->email,
            "iat"   => $iat, // Heure de création du jeton      
            "exp"   => $exp  // Heure d’expiration du jeton
        );
        $token = JWT::encode($payload, $key, 'HS256');
        $response = ['message' => 'Connexion réussie', 'token' => $token, 'user_id' => $user->id]; 
        return $this->respond($response);
    }
}
