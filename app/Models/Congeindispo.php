<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Congeindispo extends Model
{
    protected $table = 'CONGE_INDISPO';
    protected $primaryKey = 'idConge';
    public $timestamps = false;
    protected $fillable = ['descriptionDemande', 'dateEffectiveVoulue', 'dateRetourVoulue', 'paye_O_N', 'etat'];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'idEmploye');
    }
}