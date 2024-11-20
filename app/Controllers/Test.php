<?php

namespace App\Controllers;

use App\Models\Employe;
use App\Models\Congeindispo;
use App\Models\Message;


class Test extends BaseController
{
    public function getIndex()
    {
        $unemploye = Employe::find(20);
        
        echo "Nom de l'employe number 4 : " . $unemploye->id ;

        echo "<br>";

        $unconge = Congeindispo::find(101);

        echo "Conge 101: " . $unconge->description ;

        echo "<br>";

        $unmessage = Message::find(3);

        echo "Message 3: " . $unmessage->description ;
    }
}
