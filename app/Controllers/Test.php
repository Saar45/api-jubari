<?php

namespace App\Controllers;

use App\Models\Employe;
use App\Models\Conge;
use App\Models\Message;


class Test extends BaseController
{
    public function getIndex()
    {
        $unemploye = Employe::find(19);
        
        echo "Nom de l'employe number 4 : " . $unemploye->ville ;

      /*  echo "<br>";

        $unconge = Congeindispo::find(101);

        echo "Conge 101: " . $unconge->description ;*/

        echo "<br>";

       //$unemploye = Message::find(3);

        echo "Message 3: " . Message::find(1)->employe->service->nom ;
    }
}
