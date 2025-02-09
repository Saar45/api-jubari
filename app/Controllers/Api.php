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

    public function getService()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $model = new Service();
        $service = $model->find($id);

        if (!$service) {
            return $this->failNotFound('Service not found');
        }

        return $this->respond($service);
    }

    public function createService()
    {
        $model = new Service();
        $data = $this->request->getJSON(true);
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function updateService()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $model = new Service();
        $data = $this->request->getJSON(true);
        $model->update($id, $data);
        return $this->respond($data);
    }

    public function deleteService()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

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

    public function getMessage()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $model = new Message();
        $message = $model->find($id);

        if (!$message) {
            return $this->failNotFound('Message not found');
        }

        return $this->respond($message);
    }

    public function createMessage()
    {
        $model = new Message();
        $data = $this->request->getJSON(true);
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function updateMessage()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $model = new Message();
        $data = $this->request->getJSON(true);
        $model->update($id, $data);
        return $this->respond($data);
    }

    public function deleteMessage()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

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

    public function getHistoriqueconge()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $model = new Historiqueconge();
        $historiqueconge = $model->find($id);

        if (!$historiqueconge) {
            return $this->failNotFound('Historiqueconge not found');
        }

        return $this->respond($historiqueconge);
    }

    public function createHistoriqueconge()
    {
        $model = new Historiqueconge();
        $data = $this->request->getJSON(true);
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function updateHistoriqueconge()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $model = new Historiqueconge();
        $data = $this->request->getJSON(true);
        $model->update($id, $data);
        return $this->respond($data);
    }

    public function deleteHistoriqueconge()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

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

    public function createEmploye()
    {
        $model = new Employe();
        $data = $this->request->getJSON(true);
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function updateEmploye()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $model = new Employe();
        $data = $this->request->getJSON(true);
        $model->update($id, $data);
        return $this->respond($data);
    }

    public function deleteEmploye()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

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

    public function getConge()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $model = new Conge();
        $conge = $model->find($id);

        if (!$conge) {
            return $this->failNotFound('Conge not found');
        }

        return $this->respond($conge);
    }

    public function postConge()
    {
        $model = new Conge();
        $data = $this->request->getJSON(true);
        $model->insert($data);
        return $this->respondCreated($data);
    }

    public function updateConge()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->fail('ID parameter is required', 400);
        }

        $model = new Conge();
        $data = $this->request->getJSON(true);
        $model->update($id, $data);
        return $this->respond($data);
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
