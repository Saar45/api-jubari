<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historiqueconge extends Model
{
    protected $table = 'v_historique_conge';

    protected $useTimestamps = false; 

    // Un historique de congé appartient à un employé
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    // Un historique de congé peut avoir plusieurs congés associés
    public function conges()
    {
        return $this->hasMany(Conge::class, 'historique_conge_id');
    }
}