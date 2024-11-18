<?php

namespace App\Controllers;

use App\Models\Employe;


class Test extends BaseController
{
    public function getIndex()
    {
        $unemploye = Employe::find(1);
        
        echo "Nom de lemploye numero one : " . $unemploye->nomEmploye;
    }
}
