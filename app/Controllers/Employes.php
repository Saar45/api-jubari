<?php
namespace App\Controllers;

use App\Models\Employe;

class Employes extends BaseController
{
    // POST - Add an employee
    public function postEmploye() {
        $data = $this->request->getPost();
        if (!$data['nom'] || !$data['prenom'] || !$data['emailEmploye']) {
            return $this->fail("Des informations sont manquantes");
        }

        $employe = new Employe();
        $employe->fill($data);

        if ($employe->save()) {
            return $this->respondCreated("Employé ajouté");
        } else {
            return $this->fail("Erreur d'enregistrement");
        }
    }

    // PUT - Update an employee
    public function putEmploye() {
        $inputs = $this->request->getRawInput();
        $id = $inputs['idEmploye'];
        if (!$id) {
            return $this->fail("L'identifiant est manquant");
        }

        $employe = Employe::find($id);
        if ($employe) {
            $employe->fill($inputs);

            if ($employe->save()) {
                return $this->respond("Employé modifié");
            } else {
                return $this->fail("Erreur d'enregistrement");
            }
        } else {
            return $this->fail("Employé inconnu");
        }
    }

    // DELETE - Delete an employee
    public function deleteEmploye() {
        $id = $this->request->getRawInput('idEmploye');
        if (!$id) {
            return $this->fail("L'identifiant est manquant");
        }

        $employe = Employe::find($id);
        if ($employe && $employe->delete()) {
            return $this->respond("Employé supprimé");
        } else {
            return $this->fail("Erreur de suppression");
        }
    }

    // GET - Get all employees
    public function getEmployes() {
        $employes = Employe::all();
        return $this->respond($employes);
    }

    // GET - Get an employee by ID
    public function getEmployeById($id) {
        $employe = Employe::find($id);
        if ($employe) {
            return $this->respond($employe);
        } else {
            return $this->failNotFound("Employé introuvable");
        }
    }
}