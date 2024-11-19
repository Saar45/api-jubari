<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demanderconge extends Model
{
    protected $table = 'DEMANDER_CONGE';
    protected $primaryKey = ['idEmploye', 'idConge'];
    public $timestamps = false;
    protected $fillable = ['idEmploye', 'idConge'];


    public function employe()
    {
        return $this->belongsTo(Employe::class, 'idEmploye');
    }

    public function conge()
    {
        return $this->belongsTo(CongeIndispo::class, 'idConge');
    }
}