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
    public function getAllServices()
    {
        $model = new Service();
        return $this->respond($model->all());
    }

    public function getService($id)
    {
        $model = new Service();
        return $this->respond($model->find($id));
    }

    public function createService()
    {
        $model = new Service();
        $data = $this->request->getPost();
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function updateService($id)
    {
        $model = new Service();
        $data = $this->request->getRawInput();
        $model->update($id, $data);
        return $this->respond($data);
    }

    public function deleteService($id)
    {
        $model = new Service();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }

    // CRUD operations for Message
    public function getAllMessages()
    {
        $model = new Message();
        return $this->respond($model->all());
    }

    public function getMessage($id)
    {
        $model = new Message();
        return $this->respond($model->find($id));
    }

    public function createMessage()
    {
        $model = new Message();
        $data = $this->request->getPost();
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function updateMessage($id)
    {
        $model = new Message();
        $data = $this->request->getRawInput();
        $model->update($id, $data);
        return $this->respond($data);
    }

    public function deleteMessage($id)
    {
        $model = new Message();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }

    // CRUD operations for Historiqueconge
    public function getAllHistoriqueconges()
    {
        $model = new Historiqueconge();
        return $this->respond($model->all());
    }

    public function getHistoriqueconge($id)
    {
        $model = new Historiqueconge();
        return $this->respond($model->find($id));
    }

    public function createHistoriqueconge()
    {
        $model = new Historiqueconge();
        $data = $this->request->getPost();
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function updateHistoriqueconge($id)
    {
        $model = new Historiqueconge();
        $data = $this->request->getRawInput();
        $model->update($id, $data);
        return $this->respond($data);
    }

    public function deleteHistoriqueconge($id)
    {
        $model = new Historiqueconge();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }

    // CRUD operations for Employe
    public function getAllEmployes()
    {
        $model = new Employe();
        return $this->respond($model->all());
    }

    public function getEmploye($id)
    {
        $model = new Employe();
        return $this->respond($model->find($id));
    }

    public function createEmploye()
    {
        $model = new Employe();
        $data = $this->request->getPost();
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function updateEmploye($id)
    {
        $model = new Employe();
        $data = $this->request->getRawInput();
        $model->update($id, $data);
        return $this->respond($data);
    }

    public function deleteEmploye($id)
    {
        $model = new Employe();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }

    // CRUD operations for Conge
    public function getAllConges()
    {
        $model = new Conge();
        return $this->respond($model->all());
    }

    public function getConge($id)
    {
        $model = new Conge();
        return $this->respond($model->find($id));
    }

    public function createConge()
    {
        $model = new Conge();
        $data = $this->request->getPost();
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function updateConge($id)
    {
        $model = new Conge();
        $data = $this->request->getRawInput();
        $model->update($id, $data);
        return $this->respond($data);
    }

    public function deleteConge($id)
    {
        $model = new Conge();
        $model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }

    // Additional requests based on relationships
    public function getServiceEmployes($serviceId)
    {
        $model = new Service();
        $service = $model->find($serviceId);
        return $this->respond($service->employes);
    }

    public function getServiceEmployesDirigeants($serviceId)
    {
        $model = new Service();
        $service = $model->find($serviceId);
        return $this->respond($service->employesDirigeants);
    }

    public function getEmployeService($employeId)
    {
        $model = new Employe();
        $employe = $model->find($employeId);
        return $this->respond($employe->service);
    }

    public function getEmployeServiceDirige($employeId)
    {
        $model = new Employe();
        $employe = $model->find($employeId);
        return $this->respond($employe->serviceDirige);
    }

    public function getEmployeConges($employeId)
    {
        $model = new Employe();
        $employe = $model->find($employeId);
        return $this->respond($employe->conges);
    }

    public function getEmployeHistoriquesConges($employeId)
    {
        $model = new Employe();
        $employe = $model->find($employeId);
        return $this->respond($employe->historiquesConges);
    }

    public function getEmployeMessages($employeId)
    {
        $model = new Employe();
        $employe = $model->find($employeId);
        return $this->respond($employe->messages);
    }

    public function getHistoriquecongeConges($historiquecongeId)
    {
        $model = new Historiqueconge();
        $historiqueconge = $model->find($historiquecongeId);
        return $this->respond($historiqueconge->conges);
    }

    public function getCongeEmploye($congeId)
    {
        $model = new Conge();
        $conge = $model->find($congeId);
        return $this->respond($conge->employe);
    }

    public function getCongeHistoriqueconge($congeId)
    {
        $model = new Conge();
        $conge = $model->find($congeId);
        return $this->respond($conge->historiqueConge);
    }

    public function getMessageEmploye($messageId)
    {
        $model = new Message();
        $message = $model->find($messageId);
        return $this->respond($message->employe);
    }
}
