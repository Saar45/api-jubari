<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    //protected $table      = 'employes'; // Define the view name as the table

    protected $useTimestamps = false; 

    public function approbations()
    {
        return $this->belongsToMany('App\Models\Approbationconge');
    }

    public function conges()
    {
        return $this->hasMany('App\Models\Congeindispo');
    }

    public function chef()
    {
        return $this->belongsTo('App\Models\Employe');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Employe');
    }

}