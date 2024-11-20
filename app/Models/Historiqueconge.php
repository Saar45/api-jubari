<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historiqueconge extends Model
{

    protected $useTimestamps = false; 
    public function employe()
    {
        return $this->belongsTo('App\Models\Employe');
    }

    public function conge()
    {
        return $this->belongsTo('App\Models\Congeindispo');
    }
}