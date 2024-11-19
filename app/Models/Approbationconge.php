<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approbationconge extends Model
{
    protected $table = 'APPROBATION_CONGES';
    protected $primaryKey = 'idApprobation';
    public $timestamps = false; 
    protected $fillable = ['niveauApprobation', 'dateApprobation', 'statutApprobation', 'idConge'];


    public function employe()
    {
        return $this->belongsTo('App\Models\Employe');
    }
}