<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'v_message';

    protected $useTimestamps = false; 


    // Un message appartient à un employé
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }
}