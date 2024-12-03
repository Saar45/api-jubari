<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Conge extends Model
{
    protected $table = 'v_conge';

    protected $useTimestamps = false; 


    // Un congé appartient à un employé
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    // Un congé est associé à un historique de congé
    public function historiqueConge()
    {
        return $this->belongsTo(HistoriqueConge::class, 'historique_conge_id');
    }
}