<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'EMPLOYE';
    protected $primaryKey = 'idEmploye';
    public $timestamps = false;
    protected $fillable = [
        'nomEmploye', 'prenomEmploye', 'adresseEmploye', 'villeEmploye', 
        'codePostaleEmploye', 'salaireDeBaseEmploye', 'role', 'heuresSup', 
        'emailEmploye', 'motdepasse', 'idEmploye_chef_service'
    ];

    public function approbations()
    {
        return $this->belongsToMany(ApprobationConge::class, 'APPROUVER_DEMANDE', 'idEmploye', 'idApprobation');
    }

    public function congesIndispos()
    {
        return $this->hasMany(CongeIndispo::class, 'idEmploye');
    }

    public function chef()
    {
        return $this->belongsTo(Employe::class, 'idEmploye_chef_service');
    }
}