<?php

namespace App\Controllers;

use App\Models\Employe;
use CodeIgniter\RESTful\ResourceController;

class Registration extends ResourceController
{
    public function register()
    {
        $nom = $this->request->getVar('nom');
        $prenom = $this->request->getVar('prenom');
        $email = $this->request->getVar('email');
        $adresse = $this->request->getVar('adresse');
        $code_postal = $this->request->getVar('cp');
        $ville = $this->request->getVar('ville');
        $password = $this->request->getVar('password');

        if (!$nom || !$prenom || !$email || !$adresse || !$password || !$code_postal) {
            return $this->fail('Des informations sont manquantes', 400);
        }

        try {
            $employe = new Employe();
            $employe->nom = $nom;
            $employe->prenom = $prenom;
            $employe->email = $email;
            $employe->adresse = $adresse;
            $employe->code_postal = $code_postal;
            $employe->ville = $ville;
            $employe->password = password_hash($password, PASSWORD_DEFAULT);
            
            // Optional field
            if ($ville !== null) {
                $employe->ville = $ville;
            }

            $result = $employe->save();

            if ($result === 0) {
                return $this->fail('Employe non ajouté');
            } else {
                return $this->respondCreated('Employe ajouté avec succès');
            }
        } catch (\Exception $e) {
            return $this->fail('Erreur lors de l\'ajout : ' . $e->getMessage());
        }
    }
}
