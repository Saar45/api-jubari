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
    // -------------------- Service CRUD Operations --------------------

    // Get all services
    public function getServices()
    {
        $lesServices = Service::all();
        $formattedServices = [];

        foreach ($lesServices as $service) {
            $formattedServices[] = [
                'id' => $service->id,
                'nom' => $service->nom,
                'chef' => $service->employeDirige ? [
                    'id' => $service->employeDirige->id,
                    'nom' => $service->employeDirige->nom,
                    'prenom' => $service->employeDirige->prenom,
                    'email' => $service->employeDirige->email
                ] : null
            ];
        }

        return $this->respond($formattedServices);
    }

    // Get a specific service by ID
    public function getService($id)
    {
        $leService = Service::find($id);

        if ($leService) {
            return $this->respond($leService);
        } else {
            return $this->fail('Service introuvavle');
        }
    }

    // Create a new service
    public function postService()
    {
        $description = $this->request->getVar('description');

        if (!$description) {
            return $this->fail('nom est requis');
        } else {
            $leService = new Service();
            $leService->nom = $description;

            $result = $leService->save();

            if ($result === 0) {
                return $this->fail('Service non créé');
            } else {
                return $this->respondCreated('Service créé avec succès');
            }
        }
    }

    // Update an existing service
    public function putService()
    {
        $id = $this->request->getVar('id');
        $description = $this->request->getVar('description');
        $chef = $this->request->getVar('chef_id');
        if (!$id || !$description) {
            return $this->fail('Des informations sont manquantes', 400);
        } else {
            $leService = Service::find($id);

            if ($leService) {
                $leService->nom = $description;
                $leService->employe_id = $chef;
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

    // Delete a service
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

    // -------------------- Message CRUD Operations --------------------

    // Get all messages
    public function getMessages()
    {
        $lesMessages = Message::all();
        return $this->respond($lesMessages);
    }

    // Get a specific message by ID
    public function getMessage($id)
    {
        $leMessage = Message::find($id);

        if ($leMessage) {
            return $this->respond($leMessage);
        } else {
            return $this->fail('Service introuvavle');
        }
    }

    // Get messages by employee ID
    public function getMessageByEmploye($id)
    {
        $leMessage = Message::where('employe_id', $id)->get();
        return $this->respond($leMessage);
    }

    // Create a new message
    public function postMessage()
    {
        $date = $this->request->getVar('date');
        $description = $this->request->getVar('description');
        $idEmploye = $this->request->getVar('idE');

        if (!$date || !$description || !$idEmploye) {
            return $this->fail('Des informations sont manquantes', 400);
        } else {
            $leMessage = new Message();
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

    // Update an existing message
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

    // Delete a message
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

    // -------------------- Historiqueconge CRUD Operations --------------------

    // Get all historiqueconges
    public function getHistoriqueconges()
    {
        $historique = Message::all();
        return $this->respond($historique);
    }

    // Get a specific historiqueconge by ID
    public function getHistoriqueconge($id)
    {
        $historique = Historiqueconge::find($id);

        if ($historique) {
            return $this->respond($historique);
        } else {
            return $this->fail('Service introuvable');
        }
    }

    // Get historiqueconges by employee ID
    public function getHistoriquecongeByEmploye($id)
    {
        $historique = Historiqueconge::where('employe_id', $id)->get();
        return $this->respond($historique);
    }

    // Create a new historiqueconge
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

    // Update the status of a historiqueconge
    public function putStatutConge()
    {
        $id = $this->request->getVar('id');
        $dateDecision = $this->request->getVar('dateDecision');
        $etat = $this->request->getVar('etat');

        if (!$id) {
            return $this->fail('ID de l\'historique manquant', 400);
        }

        $historique = Historiqueconge::find($id);

        if (!$historique) {
            return $this->fail('Historique introuvable');
        }

        // Update required fields if provided
        if ($dateDecision !== null) $historique->date_decision = $dateDecision;
        if ($etat !== null) $historique->etat = $etat;


        $result = $historique->save();

        if ($result === 0) {
            return $this->fail('Historique non modifié');
        } else {
            return $this->respondUpdated('Historique modifié avec succès');
        }
    }

    // Delete a historiqueconge
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

    // -------------------- Employe CRUD Operations --------------------

    // Get all employees
    public function getEmployes()
    {
        $lesEmployes = Employe::all();
        $formattedEmployes = [];

        foreach ($lesEmployes as $employe) {
            $formattedEmployes[] = [
                'id' => $employe->id,
                'nom' => $employe->nom,
                'prenom' => $employe->prenom,
                'role' => $employe->role,
                'email' => $employe->email,
                'service' => $employe->service,
                'serviceDirige' => $employe->serviceDirige,
                'adresse' => $employe->adresse,
                'code_postal' => $employe->code_postal,
                'ville' => $employe->ville,
                'nbre_conges' => $employe->conges->count(),
                'nb_conges_payes' => $employe->nb_conges_payes,
            ];
        }

        return $this->respond($formattedEmployes);
    }

    // Get a specific employee by ID
    public function getEmploye($id)
    {
        $employe = Employe::find($id);

        if ($employe) {
            $employeData = [
                'id' => $employe->id,
                'nom' => $employe->nom,
                'prenom' => $employe->prenom,
                'role' => $employe->role,
                'email' => $employe->email,
                'service' => $employe->service,
                'serviceDirige' => $employe->serviceDirige,
                'adresse' => $employe->adresse,
                'code_postal' => $employe->code_postal
            ];
            return $this->respond($employeData);
        } else {
            return $this->fail('Employe introuvable');
        }
    }

    // Get employees by service ID
    public function getEmployesByService($serviceId)
    {
        if (!$serviceId) {
            return $this->fail('Service ID is required', 400);
        }

        $employes = Employe::where('service_id', $serviceId)
            ->select([
                'id',
                'nom',
                'prenom',
                'email',
                'role',
                'adresse',
                'code_postal',
                'service_id'
            ])
            ->get();

        return $this->respond($employes);
    }

    // Get the count of employees in a service
    public function getServiceEmployeCount($serviceId)
    {
        if (!$serviceId) {
            return $this->fail('Service ID is required', 400);
        }

        $count = Employe::where('service_id', $serviceId)->count();

        return $this->respond(['total' => $count]);
    }

    // Search employees by name
    public function getEmployeByNom($nom)
    {
        $lesEmployes = Employe::where('nom', 'LIKE', '%' . $nom . '%')->get();
        return $this->respond($lesEmployes);
    }

    // Update an existing employee
    public function putEmploye()
    {
        $id = $this->request->getVar('id');
        $nom = $this->request->getVar('nom');
        $prenom = $this->request->getVar('prenom');
        $service_id = $this->request->getVar('service_id');
        $email = $this->request->getVar('email');
        $adresse = $this->request->getVar('adresse');
        $role = $this->request->getVar('role');
        $code_postal = $this->request->getVar('cp');
        // Optional fields
        $dirige_service_id = $this->request->getVar('dirige_service_id');
        $ville = $this->request->getVar('ville');

        if (!$id) {
            return $this->fail('ID de l\'employé manquant', 400);
        }

        $employe = Employe::find($id);
        if (!$employe) {
            return $this->fail('Employé introuvable');
        }

        // Update required fields if provided
        if ($nom !== null) $employe->nom = $nom;
        if ($prenom !== null) $employe->prenom = $prenom;
        if ($service_id !== null) $employe->service_id = $service_id;
        if ($email !== null) $employe->email = $email;
        if ($adresse !== null) $employe->adresse = $adresse;
        if ($role !== null) $employe->role = $role;
        if ($code_postal !== null) $employe->code_postal = $code_postal;

        // Update optional fields only if provided
        if ($dirige_service_id !== null) $employe->dirige_service_id = $dirige_service_id;
        if ($ville !== null) $employe->ville = $ville;

        $result = $employe->save();

        if ($result === 0) {
            return $this->fail('Employé non modifié');
        } else {
            return $this->respondUpdated('Employé modifié avec succès');
        }
    }

    // Update an employee's password
    public function putEmployePassword()
    {
        //$data = $this->request->getRawInput();
        $old_password = $this->request->getVar('old_password');
        $new_password = $this->request->getVar('new_password');
        $id = $this->request->getVar('id');

        $employe = Employe::find($id);
        if (!$employe) {
            return $this->fail('Employe non trouvé');
        }

        // Verify old password
        if (!password_verify($old_password, $employe->motdepasse)) {
            return $this->fail('Ancien mot de passe incorrect', 401);
        }

        // Hash and save new password
        $employe->motdepasse = password_hash($new_password, PASSWORD_DEFAULT);
        $result = $employe->save();

        if ($result === 0) {
            return $this->fail('Mot de passe non modifié');
        } else {
            return $this->respondUpdated('Mot de passe modifié avec succès');
        }
    }

    // Delete an employee
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

    // Assign an employee as the chief of a service
    public function putEmployeServiceDirige()
    {
        $employe_id = $this->request->getVar('employe_id');
        $service_id = $this->request->getVar('service_id');

        if (!$employe_id || !$service_id) {
            return $this->fail('Des informations sont manquantes', 400);
        }

        $employe = Employe::find($employe_id);
        if (!$employe) {
            return $this->fail('Employe non trouvé', 404);
        }

        $employe->dirige_service_id = $service_id;
        $result = $employe->save();

        if ($result === 0) {
            return $this->fail('Service dirigé non modifié');
        } else {
            return $this->respondUpdated('Service dirigé modifié avec succès');
        }
    }

    // Clear the chief of a service
    public function putClearServiceChief()
    {
        $serviceId = $this->request->getVar('service_id');
        $excludeEmployeId = $this->request->getVar('exclude_employe_id');

        if (!$serviceId) {
            return $this->fail('Service ID manquant', 400);
        }

        // Fix the query syntax
        $employes = Employe::where('dirige_service_id', $serviceId);
        if ($excludeEmployeId) {
            $employes->where('id', '!=', $excludeEmployeId);
        }

        $employes->update(['dirige_service_id' => null]);

        return $this->respondUpdated('Chef de service précédent retiré avec succès');
    }

    // -------------------- Conge CRUD Operations --------------------

    // Get all conges
    public function getAllConges()
    {
        $lesConges = Conge::all();
        $formattedConges = [];

        foreach ($lesConges as $conge) {
            $formattedConges[] = [
                'id' => $conge->id,
                'dateDebut' => $conge->date_effective,
                'dateFin' => $conge->date_retour,
                'motif' => $conge->motif,
                'description' => $conge->description,
                'paye' => $conge->paye,
                'nom_signataire_chef' => $conge->nom_signataire_chef,
                'prenom_signataire_chef' => $conge->prenom_signataire_chef,
                'employe' => [
                    'id' => $conge->employe->id,
                    'nom' => $conge->employe->nom,
                    'prenom' => $conge->employe->prenom,
                    'serviceDirige' => $conge->employe->serviceDirige ? [
                        'id' => $conge->employe->serviceDirige->id,
                        'nom' => $conge->employe->serviceDirige->nom
                    ] : null,
                ],
                'historiqueConge' => [
                    'id' => $conge->historiqueConge->id,
                    'dateDemande' => $conge->historiqueConge->date_demande,
                    'dateDecision' => $conge->historiqueConge->date_decision,
                    'etat' => $conge->historiqueConge->etat
                ],
            ];
        }

        return $this->respond($formattedConges);
    }

    // Get a specific conge by ID
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

    // Create a new conge
    public function postConge()
    {
        $dateDebut = $this->request->getPost('dateD');
        $dateFin = $this->request->getPost('dateF');
        $description = $this->request->getPost('description');
        $paye = $this->request->getPost('paye');
        $idEmploye = $this->request->getPost('idE');

        if ($dateDebut === null || $dateFin === null || $description === null || $paye === null || $idEmploye === null) {
            return $this->fail('Des informations sont manquantes', 400);
        } else {
            $data = [
                'date_effective' => $dateDebut,
                'date_retour' => $dateFin,
                'description' => $description,
                'paye' => $paye,
                'employe_id' => $idEmploye,
            ];

            try {
                $result = Conge::insert($data);

                if (!$result) {
                    return $this->fail('Congé non ajouté');
                } else {
                    return $this->respondCreated('Congé ajouté avec succès');
                }
            } catch (\Exception $e) {
                // Log the error for debugging
                log_message('error', $e->getMessage());
                return $this->fail('Erreur lors de l\'ajout du congé: ' . $e->getMessage());
            }
        }
    }

    // Update an existing conge
    public function putConge()
    {
        $id = $this->request->getVar('id');
        $dateDebut = $this->request->getVar('dateD');
        $dateFin = $this->request->getVar('dateF');
        $description = $this->request->getVar('description');
        $paye = $this->request->getVar('paye');
        // Optional fields
        $avis_chef_direct = $this->request->getVar('avisCD');
        $prenom_chef_direct = $this->request->getVar('prenomCD');
        $nom_chef_direct = $this->request->getVar('nomCD');
        $date_decision_chef_direct = $this->request->getVar('dateDCD');

        if (!$id) {
            return $this->fail('ID du congé manquant', 400);
        }

        $leConge = Conge::find($id);

        if (!$leConge) {
            return $this->fail('Le congé est inexistant');
        }

        // Update required fields if provided
        if ($dateDebut !== null) $leConge->date_effective = $dateDebut;
        if ($dateFin !== null) $leConge->date_retour = $dateFin;
        if ($description !== null) $leConge->description = $description;
        if ($paye !== null) $leConge->paye = $paye;

        // Update optional fields only if provided
        if ($avis_chef_direct !== null) $leConge->avis_chef_direct = $avis_chef_direct;
        if ($prenom_chef_direct !== null) $leConge->prenom_signataire_chef = $prenom_chef_direct;
        if ($nom_chef_direct !== null) $leConge->nom_signataire_chef = $nom_chef_direct;
        if ($date_decision_chef_direct !== null) $leConge->date_decision_chef_direct = $date_decision_chef_direct;

        $result = $leConge->save();

        if ($result === 0) {
            return $this->fail('Congé non modifié');
        } else {
            return $this->respondUpdated('Congé modifié avec succès');
        }
    }

    // Update the decision of the direct chief for a conge
    public function putPriseDecisionChef()
    {
        $id = $this->request->getVar('id');
        $avis_chef_direct = $this->request->getVar('avisChefDirect');
        $prenom_chef_direct = $this->request->getVar('prenomChefDirect');
        $nom_chef_direct = $this->request->getVar('nomChefDirect');
        $date_decision_chef_direct = $this->request->getVar('datePriseDecisionChefDirect');
        $motif_refus = $this->request->getVar('motifRefus');

        if (!$id) {
            return $this->fail('ID du congé manquant', 400);
        }

        $leConge = Conge::find($id);

        if (!$leConge) {
            return $this->fail('Le congé est inexistant');
        }

        // Update chef direct decision fields
        $leConge->avis_chef_direct = $avis_chef_direct;
        $leConge->prenom_signataire_chef = $prenom_chef_direct;
        $leConge->nom_signataire_chef = $nom_chef_direct;
        $leConge->date_decision_chef_direct = $date_decision_chef_direct;

        // Only set motif_refus if decision is negative
        if ($avis_chef_direct === 0 && $motif_refus !== null) {
            $leConge->motif_refus = $motif_refus;
        }

        $result = $leConge->save();

        if ($result === 0) {
            return $this->fail('Décision non enregistrée');
        } else {
            return $this->respondUpdated('Décision enregistrée avec succès');
        }
    }

    // Update the decision of the HR for a conge
    public function putPriseDecisionRH()
    {
        $id = $this->request->getVar('id');
        $avis_rh = $this->request->getVar('avisRH');
        $prenom_rh = $this->request->getVar('prenomRH');
        $nom_rh = $this->request->getVar('nomRH');
        $date_decision_rh = $this->request->getVar('datePriseDecisionRH');
        $motif_refus = $this->request->getVar('motifRefus');

        if (!$id) {
            return $this->fail('ID du congé manquant', 400);
        }

        $leConge = Conge::find($id);

        if (!$leConge) {
            return $this->fail('Le congé est inexistant');
        }

        // Update RH decision fields
        $leConge->avis_chef_rh = $avis_rh;
        $leConge->prenom_signataire_rh = $prenom_rh;
        $leConge->nom_signataire_rh = $nom_rh;
        $leConge->date_decision_rh = $date_decision_rh;

        // Only set motif_refus if decision is negative
        if ($avis_rh === 0 && $motif_refus !== null) {
            $leConge->motif_refus = $motif_refus;
        }

        $result = $leConge->save();

        if ($result === 0) {
            return $this->fail('Décision RH non enregistrée');
        } else {
            return $this->respondUpdated('Décision RH enregistrée avec succès');
        }
    }

    // Delete a conge
    public function deleteConge()
    {
        $data = $this->request->getRawInput();
        $id = $data['id'];
        $conge = Conge::find($id);

        if (!$conge) {
            return $this->fail('Congé non trouvé', 404);
        }
        $result = $conge->delete();
        if ($result === 0) {
            return $this->fail('Congé non supprimé');
        } else {
            return $this->respondDeleted('Congé supprimé avec succès');
        }
    }

    // -------------------- Additional Operations --------------------

    // Get the count of employees currently on leave
    public function getCurrentEmployesOnLeaveCount()
    {
        $today = date('Y-m-d');

        $count = Conge::where('date_effective', '<=', $today)
            ->where('date_retour', '>=', $today)
            ->where(function ($query) {
                $query->whereNotNull('avis_chef_direct')
                    ->where('avis_chef_direct', '=', 1);
            })
            ->where(function ($query) {
                $query->whereNotNull('avis_chef_rh')
                    ->where('avis_chef_rh', '=', 1);
            })
            ->count();

        return $this->respond([
            'count' => $count
        ]);
    }

    // Get all current conges
    public function getCurrentConges()
    {
        $today = date('Y-m-d');
        $formattedConges = [];

        $historiques = Historiqueconge::where('etat', 'Accepte')
            ->with(['conges' => function ($query) use ($today) {
                $query->where('date_effective', '<=', $today)
                    ->where('date_retour', '>=', $today);
            }])
            ->get();

        foreach ($historiques as $historique) {
            foreach ($historique->conges as $conge) {
                $formattedConges[] = [
                    'id' => $conge->id,
                    'dateDebut' => $conge->date_effective,
                    'dateFin' => $conge->date_retour,
                    'description' => $conge->description,
                    'paye' => $conge->paye,
                    'employe' => [
                        'id' => $conge->employe->id,
                        'nom' => $conge->employe->nom,
                        'prenom' => $conge->employe->prenom,
                        'service' => $conge->employe->service
                    ],
                    'historiqueConge' => [
                        'id' => $historique->id,
                        'dateDemande' => $historique->date_demande,
                        'dateDecision' => $historique->date_decision,
                        'etat' => $historique->etat
                    ]
                ];
            }
        }

        return $this->respond($formattedConges);
    }

    // Get conges by service ID
    public function getCongesByService($serviceId)
    {
        if (!$serviceId) {
            return $this->fail('Service ID is required', 400);
        }

        $employes = Employe::where('service_id', $serviceId)->get();
        $formattedConges = [];

        foreach ($employes as $employe) {
            $conges = $employe->conges;
            foreach ($conges as $conge) {
                $formattedConges[] = [
                    'id' => $conge->id,
                    'dateDebut' => $conge->date_effective,
                    'dateFin' => $conge->date_retour,
                    // 'motif' => $conge->motif,
                    'description' => $conge->description,
                    'paye' => $conge->paye,
                    'employe' => [
                        'id' => $employe->id,
                        'nom' => $employe->nom,
                        'prenom' => $employe->prenom,
                        'service' => $employe->service,
                        'role' => $employe->role,
                    ],
                    'historiqueConge' => [
                        'id' => $conge->historiqueConge->id,
                        'dateDemande' => $conge->historiqueConge->date_demande,
                        'dateDecision' => $conge->historiqueConge->date_decision,
                        'etat' => $conge->historiqueConge->etat
                    ],
                ];
            }
        }

        return $this->respond($formattedConges);
    }

    // Get conge statistics
    public function getCongeStats()
    {
        $enAttente = Historiqueconge::where('etat', 'En attente')->count();
        $rejete = Historiqueconge::where('etat', 'Rejete')->count();
        $accepte = Historiqueconge::where('etat', 'Accepte')->count();

        $stats = [
            'en_attente' => $enAttente,
            'rejete' => $rejete,
            'accepte' => $accepte
        ];

        return $this->respond($stats);
    }

    // Get conge statistics for a specific employee
    public function getEmployeCongeStats($employeId)
    {

        if (!$employeId) {
            return $this->fail('Employe ID parameter is required', 400);
        }
        $joursRestants = Employe::where('id', $employeId)->value('nb_conges_payes');

        $enAttente = Historiqueconge::where('employe_id', $employeId)
            ->where('etat', 'en attente')
            ->count();
        $rejete = Historiqueconge::where('employe_id', $employeId)
            ->where('etat', 'rejete')
            ->count();
        $accepte = Historiqueconge::where('employe_id', $employeId)
            ->where('etat', 'accepte')
            ->count();

        $stats = [
            'joursRestants' => $joursRestants,
            'en_attente' => $enAttente,
            'rejete' => $rejete,
            'accepte' => $accepte
        ];

        return $this->respond($stats);
    }

    // -------------------- Relationship-Based Operations --------------------

    // Get employees of a service
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

    // Get the service of an employee
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

    // Get the service directed by an employee
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

    // Get conges of an employee
    public function getEmployeConges($employeId)
    {

        if (!$employeId) {
            return $this->fail('Employe ID parameter is required', 400);
        }

        $model = new Employe();
        $employe = $model->find($employeId);
        $employeConges = $employe->conges;

        $formattedConges = [];

        foreach ($employeConges as $conge) {
            $formattedConges[] = [
                'id' => $conge->id,
                'dateDebut' => $conge->date_effective,
                'dateFin' => $conge->date_retour,
                //'motif' => $conge->motif,
                'description' => $conge->description,
                'paye' => $conge->paye,
                'motif_refus' => $conge->motif_refus,
                'employe' => [
                    'id' => $conge->employe->id,
                    'nom' => $conge->employe->nom,
                    'prenom' => $conge->employe->prenom
                ],
                'historiqueConge' => [
                    'id' => $conge->historiqueConge->id,
                    'dateDemande' => $conge->historiqueConge->date_demande,
                    'dateDecision' => $conge->historiqueConge->date_decision,
                    'etat' => $conge->historiqueConge->etat
                ]
            ];
        }

        return $this->respond($formattedConges);
    }

    // Get historiqueconges of an employee
    public function getEmployeHistoriqueConges()
    {
        $data = $this->request->getRawInput();
        $employeId = $data['employe_id'];
        if (!$employeId) {
            return $this->fail('Employe ID parameter is required', 400);
        }

        $model = new Employe();
        $employe = $model->find($employeId);
        return $this->respond($employe->historiquesConges);
    }

    // Get messages of an employee
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

    // Get conges of a historiqueconge
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

    // Get the employee of a conge
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

    // Get the historiqueconge of a conge
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

    // Get the employee of a message
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
