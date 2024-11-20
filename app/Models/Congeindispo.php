<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Congeindispo extends Model
{

    protected $useTimestamps = false; // No need to use timestamps since the view doesn't have created_at or updated_at columns.

    public function employe()
    {
        return $this->belongsTo('App\Models\Employe');
    }

    //Penser à modifier le mcd, pour qu'on ait la clé étrangère employe_id. 1:N au lien de N:N
}