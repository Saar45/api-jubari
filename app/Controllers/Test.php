<?php

namespace App\Controllers;

use App\Models\Employe;
use App\Models\Conge;
use App\Models\Message;
use App\Models\Service;
use App\Models\Historiqueconge;


class Test extends BaseController
{
    public function getIndex()
    {
        $unemploye = Employe::find(10);

       // $unemploye->serviceDirige->nom;

        $unservice = Service::find(2);

        $lesemployes = $unservice->employes->all();

        foreach($lesemployes as $employe){
          echo $employe->nom . ' ' . $employe->prenom . ' travaille dans IT <br>';
        }
        
       /* $conges = $unemploye->conges->All();

        foreach($conges as $conge) {
          echo $conge->nom_signataire_chef;
          }$/
          

      //  echo $firstConge->description;

      /*  echo "<br>";

        $unconge = Congeindispo::find(101);

        echo "Conge 101: " . $unconge->description ;*/

        echo "<br>";

       //$unemploye = Message::find(3);

        echo "Message 3: " . Message::find(1)->employe->service->nom ;
    }
}

