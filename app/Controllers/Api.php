<?php

namespace App\Controllers;

use App\Models\Service;
use App\Models\Message;
use App\Models\Historiqueconge;
use App\Models\Employe;
use App\Models\Conge;
use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{


    // CRUD operations for Service
    public function getServices()
    {
        $lesService = Service::all();
        return $this->respond($lesService);
    }

    public function getService($id)
    {
        $leService = Service::find($id);

        if ($leService) {
            return $this->respond($leService);
        } else {
            return $this->fail('Service introuvavle');
        }
    }

    public function postService()
    {
        $nom = $this->request->getPost('nom');

        if (!$nom) {
            return $this->fail('nom est requis');
        } else {
            $leService = new Service();
            $leService->nom = $nom;

            $result = $leService->save();

            if ($result === 0) {
                return $this->fail('Service non créé');
            } else {
                return $this->respondCreated('Service créé avec succès');
            }
        }
    }

    public function putService()
    {
        $data = $this->request->getRawInput();
        $id = $data['id'];
        $nom = $data['nom'];
        if (!$id || !$nom) {
            return $this->fail('Des informations sont manquantes', 400);
        } else {
            $leService = Service::find($id);

            if ($leService) {
                $leService->nom = $nom;
                $result = $leService->save();

                if ($result === 0) {
                    return $this->fail('Service non modifié');
                } else {
                    return $this->respondUpdated('Service modifié avec succès');
                }
            } else {
                return $this->fail('Service introuvable');
            }
        }
    }

    public function deleteService()
    {
        $data = $this->request->getRawInput();
        $id = $data['id'];

        if (!$id) {
            return $this->fail('Des informations sont manquantes', 400);
        } else {
            $leService = Service::find($id);

            if ($leService) {
                $result = $leService->delete();

                if ($result === 0) {
                    return $this->fail('Service non supprimé');
                } else {
                    return $this->respondDeleted('Service supprimé avec succès');
                }
            } else {
                return $this->fail('Service introuvable');
            }
        }
    }

    // CRUD operations for Message
    public function getMessages()
    {
        $lesMessages = Message::all();
        return $this->respond($lesMessages);
    }

    public function getMessage($id)
    {
        $leMessage = Message::find($id);

        if ($leMessage) {
            return $this->respond($leMessage);
        } else {
            return $this->fail('Service introuvavle');
        }
    }

    public function getMessageByEmploye($id)
    {
        $leMessage = Message::where('employe_id', $id)->get();
        return $this->respond($leMessage);
    }

    public function postMessage()
    {
        $date = $this->request->getPost('date');
        $description = $this->request->getPost('description');
        $idEmploye = $this->request->getPost('idE');

        if (!$date || !$description || !$idEmploye) {
            return $this->fail('nom est requis');
        } else {
            $leMessage = new Service();
            $leMessage->date_reclamation = $date;
            $leMessage->description = $description;
            $leMessage->employe_id = $idEmploye;

            $result = $leMessage->save();

            if ($result === 0) {
                return $this->fail('Message non ajouté');
            } else {
                return $this->respondCreated('Message ajouté avec succès');
            }
        }
    }

    public function putMessage()
    {
        $id = $this->request->getPost('id');
        $date = $this->request->getPost('date');
        $description = $this->request->getPost('description');
        // $idEmploye = $this->request->getPost('idE');

        if (!$date || !$description) {
            return $this->fail('Des informations sont manquantes', 400);
        } else {
            $message = Message::find($id);

            if ($message) {
                $message->date_reclamation = $date;
                $message->description = $description;
                $result = $message->save();
                if ($result === 0) {
                    return $this->fail('Message non modifié');
                } else {
                    return $this->respondUpdated('Message modifié avec succès');
                }
            }
        }
    }

    public function deleteMessage()
    {
        $data = $this->request->getRawInput();
        $id = $data['id'];
        $leMessage = Message::find($id);
        if (!$leMessage) {
            return $this->fail('Message non trouvé', 404);
        }
        $result = $leMessage->delete();
        if ($result === 0) {
            return $this->fail('Message non supprimé');
        } else {
            return $this->respondDeleted('Message supprimé avec succès');
        }
    }

    // CRUD operations for Historiqueconge
    public function getHistoriqueconges()
    {
        $historique = Message::all();
        return $this->respond($historique);
    }

    public function getHistoriqueconge($id)
    {
        $historique = Historiqueconge::find($id);

        if ($historique) {
            return $this->respond($historique);
        } else {
            return $this->fail('Service introuvable');
        }
    }

    public function getHistoriquecongeByEmploye($id)
    {
        $historique = Historiqueconge::where('employe_id', $id)->get();
        return $this->respond($historique);
    }

    public function postHistoriqueconge()
    {
        $data = $this->request->getRawInput();
        $dateDemande = $data['dateDemande'];
        $dateDecision = $data['dateDecision'];
        $etat = 'en attente';
        $idEmploye = $data['idE'];

        if (!$dateDemande || !$dateDecision || !$idEmploye) {
            return $this->fail('Des informations sont manquantes', 400);
        } else {
            //change fields accordingly to my database
            $historique = new Historiqueconge();
            $historique->dateDemande = $dateDemande;
            $historique->dateDecision = $dateDecision;
            $historique->etat = $etat;
            $historique->employe_id = $idEmploye;

            $result = $historique->save();

            if ($result === 0) {
                return $this->fail('Le congé n\'a pas été ajouté à l\'historique');
            } else {
                return $this->respondCreated('Le congé a été ajouté à l\'historique avec succès');
            }
        }
    }

    public function putHistoriqueconge()
    {
        $data = $this->request->getRawInput();
        $id = $data['id'];
        $dateDemande = $data['dateDemande'];
        $dateDecision = $data['dateDecision'];
        $etat = $data['etat'];
        $idEmploye = $data['idEmploye'];

        if (!$id || !$dateDemande || !$dateDecision || !$etat || !$idEmploye) {
            return $this->fail('Des informations sont manquantes', 400);
        } else {
            $historique = Historiqueconge::find($id);

            if ($historique) {
                $historique->dateDemande = $dateDemande;
                $historique->dateDecision = $dateDecision;
                $historique->etat = $etat;
                $historique->employe_id = $idEmploye;

                $result = $historique->save();

                if ($result === 0) {
                    return $this->fail('Historique non modifié');
                } else {
                    return $this->respondUpdated('Historique modifié avec succès');
                }
            } else {
                return $this->fail('Historique introuvable');
            }
        }
    }

    public function deleteHistoriqueconge()
    {
        $data = $this->request->getRawInput();
        $id = $data['id'];
        $historique = Historiqueconge::find($id);
        if ($historique) {
            $result = $historique->delete();
            if ($result === 0) {
                return $this->fail('Historique non supprimé');
            } else {
                return $this->respondDeleted('Historique supprimé avec succès');
            }
        } else {
            return $this->fail('Historique introuvable');
        }
    }

    // CRUD operations for Employe
    public function getEmployes()
    {
        $lesEmployes = Employe::all();
        return $this->respond($lesEmployes);
    }

    public function getEmploye()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $model = new Employe();
        $employe = $model->find($id);

        if (!$employe) {
            return $this->failNotFound('Employe not found');
        }

        return $this->respond($employe);
    }

    public function getEmployesByService($id)
    {
        $employe = Employe::where('service_id', $id)->get();
        return $this->respond($employe);
    }

    public function getEmployeByNom($nom)
    {
        $lesEmployes = Employe::where('nom', 'LIKE', '%' . $nom . '%')->get();
        return $this->respond($lesEmployes);
    }

    public function postEmploye()
    {
        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $service_id = $this->request->getPost('service_id');
        $dirige_service_id = $this->request->getPost('dirige_service_id');
        $email = $this->request->getPost('email');
        $motdepasse = $this->request->getPost('motdepasse');
        $adresse = $this->request->getPost('adresse');
        $role = $this->request->getPost('role');
        $code_postal = $this->request->getPost('cp');
        $salaire = $this->request->getPost('salaire');
        $heure_sup = $this->request->getPost('heure_sup');

        if (!$nom || !$prenom || !$service_id || !$email || !$motdepasse || !$adresse || !$role || !$code_postal) {
            return $this->fail('Des informations sont manquantes', 400);
        } else {
            $employe = new Employe();
            $employe->nom = $nom;
            $employe->prenom = $prenom;
            $employe->service_id = $service_id;
            $employe->email = $email;
            $employe->motdepasse = $motdepasse;
            $employe->adresse = $adresse;
            $employe->role = $role;
            $employe->code_postal = $code_postal;

            if ($dirige_service_id) {
                $employe->dirige_service_id = $dirige_service_id;
            }

            if ($salaire) {
                $employe->salaire = $salaire;
            }

            if ($heure_sup) {
                $employe->heure_sup = $heure_sup;
            }



            $result = $employe->save();

            if ($result === 0) {
                return $this->fail('Employe non ajouté');
            } else {
                return $this->respondCreated('Employe ajouté avec succès');
            }
        }
    }

    public function putEmploye()
    {

        //some fields should be optional KEEP IN MIND
        $data = $this->request->getRawInput();
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $service_id = $data['service_id'];
        $email = $data['email'];
        $motdepasse = $data['motdepasse'];
        $adresse = $data['adresse'];
        $role = $data['role'];
        $code_postal = $data['cp'];
        $dirige_service_id = $data['dirige_service_id'];
        $salaire = $data['salaire'];
        $heure_sup = $data['heure_sup'];
        $id = $data['id'];
        $employe = new Employe();
        $employe = $employe->find($id);
        if (!$employe) {
            return $this->fail('Employe non trouvé');
        }
        $employe->nom = $nom;
        $employe->prenom = $prenom;
        $employe->service_id = $service_id;
        $employe->email = $email;
        $employe->motdepasse = $motdepasse;
        $employe->adresse = $adresse;
        $employe->role = $role;
        $employe->code_postal = $code_postal;
        $employe->dirige_service_id = $dirige_service_id;
        $employe->salaire = $salaire;
        $employe->heure_sup = $heure_sup;
        $result = $employe->save();
        if ($result === 0) {
            return $this->fail('Employe non modifié');
        } else {
            return $this->respondUpdated('Employe modifié avec succès');
        }
    }

    public function putEmployePassword()
    {
        $data = $this->request->getRawInput();
        $motdepasse = $data['password'];
        $id = $data['id'];
        $employe = new Employe();
        $employe = $employe->find($id);
        if (!$employe) {
            return $this->fail('Employe non trouvé');
        }
        $employe->motdepasse = $motdepasse;
        $result = $employe->save();
        if ($result === 0) {
            return $this->fail('Mot de passe non modifié');
        } else {
            return $this->respondUpdated('Mot de passe modifié avec succès');
        }
    }

    public function deleteEmploye()
    {
        $data = $this->request->getRawInput();
        $id = $data['id'];
        $employe = Employe::find($id);

        if (!$employe) {
            return $this->fail('Employe non trouvé', 404);
        }
        $result = $employe->delete();
        if ($result === 0) {
            return $this->fail('Employe non supprimé');
        } else {
            return $this->respondDeleted('Employe supprimé avec succès');
        }
    }

    // CRUD operations for Conge
    public function getAllConges()
    {
        $lesConges = Conge::all();
        return $this->respond($lesConges);
    }

    public function getConge()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $conge = Conge::find($id);

        if (!$conge) {
            return $this->failNotFound('Conge not found');
        }

        return $this->respond($conge);
    }

    public function postConge()
    { //Add motif column in conge table in database
        $data = $this->request->getRawInput();
        $dateDebut = $data['dateD'];
        $dateFin = $data['dateF'];
        $motif = $data['motif'];
        $description = $data['description'];
        $paye = $data['paye'];
        $idEmploye = $data['idE'];

        // I think idhistorique will be automatically generated by the database / check the triggers 

        if (!$dateDebut || !$dateFin || !$motif || !$description || !$paye || !$idEmploye) {
            return $this->fail('Des informations sont manquantes', 400);
        } else {
            //modify fields accordingly
            $conge = new Conge();
            $conge->dateDebut = $dateDebut;
            $conge->dateFin = $dateFin;
            $conge->motif = $motif;
            $conge->description = $description;
            $conge->paye = $paye;
            $conge->employe_id = $idEmploye;

            $result = $conge->save();

            if ($result === 0) {
                return $this->fail('Congé non ajouté');
            } else {
                return $this->respondCreated('Congé ajouté avec succès');
            }
        }
    }

    public function putConge()
    {
        $data = $this->request->getRawInput();
        $id = $data['id'];
        $dateDebut = $data['dateD'];
        $dateFin = $data['dateF'];
        $motif = $data['motif'];
        $description = $data['description'];
        $paye = $data['paye'];
       // $idEmploye = $data['idE'];
       $idEmploye = $this->request->getHeader('idEmploye'); // get

    }

    public function deleteConge()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $model = new Conge();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }

    // Additional requests based on relationships
    public function getServiceEmployes()
    {
        $serviceId = $this->request->getGet('service_id');
        if (!$serviceId) {
            return $this->fail('Service ID parameter is required', 400);
        }

        $model = new Service();
        $service = $model->find($serviceId);
        return $this->respond($service->employes);
    }

    public function getServiceEmployesDirigeants()
    {
        $serviceId = $this->request->getGet('service_id');
        if (!$serviceId) {
            return $this->fail('Service ID parameter is required', 400);
        }

        $model = new Service();
        $service = $model->find($serviceId);
        return $this->respond($service->employesDirigeants);
    }

    public function getEmployeService()
    {
        $employeId = $this->request->getGet('employe_id');
        if (!$employeId) {
            return $this->fail('Employe ID parameter is required', 400);
        }

        $model = new Employe();
        $employe = $model->find($employeId);
        return $this->respond($employe->service);
    }

    public function getEmployeServiceDirige()
    {
        $employeId = $this->request->getGet('employe_id');
        if (!$employeId) {
            return $this->fail('Employe ID parameter is required', 400);
        }

        $model = new Employe();
        $employe = $model->find($employeId);
        return $this->respond($employe->serviceDirige);
    }

    public function getEmployeConges()
    {
        $employeId = $this->request->getGet('employe_id');
        if (!$employeId) {
            return $this->fail('Employe ID parameter is required', 400);
        }

        $model = new Employe();
        $employe = $model->find($employeId);
        return $this->respond($employe->conges);
    }

    public function getEmployeHistoriquesConges()
    {
        $employeId = $this->request->getGet('employe_id');
        if (!$employeId) {
            return $this->fail('Employe ID parameter is required', 400);
        }

        $model = new Employe();
        $employe = $model->find($employeId);
        return $this->respond($employe->historiquesConges);
    }

    public function getEmployeMessages()
    {
        $employeId = $this->request->getGet('employe_id');
        if (!$employeId) {
            return $this->fail('Employe ID parameter is required', 400);
        }

        $model = new Employe();
        $employe = $model->find($employeId);
        return $this->respond($employe->messages);
    }

    public function getHistoriquecongeConges()
    {
        $historiquecongeId = $this->request->getGet('historiqueconge_id');
        if (!$historiquecongeId) {
            return $this->fail('Historiqueconge ID parameter is required', 400);
        }

        $model = new Historiqueconge();
        $historiqueconge = $model->find($historiquecongeId);
        return $this->respond($historiqueconge->conges);
    }

    public function getCongeEmploye()
    {
        $congeId = $this->request->getGet('conge_id');
        if (!$congeId) {
            return $this->fail('Conge ID parameter is required', 400);
        }

        $model = new Conge();
        $conge = $model->find($congeId);
        return $this->respond($conge->employe);
    }

    public function getCongeHistoriqueconge()
    {
        $congeId = $this->request->getGet('conge_id');
        if (!$congeId) {
            return $this->fail('Conge ID parameter is required', 400);
        }

        $model = new Conge();
        $conge = $model->find($congeId);
        return $this->respond($conge->historiqueConge);
    }

    public function getMessageEmploye()
    {
        $messageId = $this->request->getGet('message_id');
        if (!$messageId) {
            return $this->fail('Message ID parameter is required', 400);
        }

        $model = new Message();
        $message = $model->find($messageId);
        return $this->respond($message->employe);
    }
}
