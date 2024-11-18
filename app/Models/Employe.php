<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model 
{
    public $timestamps = false;
    protected $table   = 'EMPLOYE';
    protected $primaryKey = 'idEmploye';
   
    
}