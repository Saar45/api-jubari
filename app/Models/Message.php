<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $useTimestamps = false; 

    public function employe()
    {
        return $this->belongsTo('App\Models\Employe');
    }
}