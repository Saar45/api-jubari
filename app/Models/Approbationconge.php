<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approbationconge extends Model
{

    protected $useTimestamps = false; 

    
    public function employes()
    {
        return $this->belongsToMany('App\Models\Employe');
    }
}