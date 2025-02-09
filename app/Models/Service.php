<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'v_service';

    public $timestamps = false; 


    // Un service peut avoir plusieurs employés
    public function employes()
    {
        return $this->hasMany(Employe::class, 'service_id');
    }

    // Un service peut être dirigé par plusieurs employés (gestion multi-dirigeants)
    public function employesDirigeants()
    {
        return $this->hasMany(Employe::class, 'dirige_service_id');
    }
}