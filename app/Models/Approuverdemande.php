<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approuverdemande extends Model
{
    protected $table = 'APPROUVER_DEMANDE';
    protected $primaryKey = ['idEmploye', 'idApprobation'];
    public $timestamps = false;
    protected $fillable = ['idEmploye', 'idApprobation'];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'idEmploye');
    }

    public function approbation()
    {
        return $this->belongsTo(ApprobationConge::class, 'idApprobation');
    }
}