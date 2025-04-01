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

    // Un service est dirigé par un employé
    public function employeDirige()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }
}