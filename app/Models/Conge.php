<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    protected $table = 'v_conge';

    // Ensure this matches the actual primary key column in the database
    protected $primaryKey = 'id'; // Change 'id' to the actual primary key if different

    public $timestamps = false;

    // relationships
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    public function historiqueConge()
    {
        return $this->belongsTo(HistoriqueConge::class, 'historique_conge_id');
    }
}