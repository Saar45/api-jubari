<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Employe extends Model
{
    protected $table = 'v_employe';

    protected $useTimestamps = false; 

    // Un employé appartient à un service
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    // Un employé peut diriger un service
    public function serviceDirige()
    {
        return $this->belongsTo(Service::class, 'dirige_service_id');
    }

    // Un employé peut avoir plusieurs congés
    public function conges()
    {
        return $this->hasMany(Conge::class, 'employe_id');
    }

    // Un employé peut avoir plusieurs historiques de congés
    public function historiquesConges()
    {
        return $this->hasMany(HistoriqueConge::class, 'employe_id');
    }

    // Un employé peut avoir plusieurs messages
    public function messages()
    {
        return $this->hasMany(Message::class, 'employe_id');
    }
}