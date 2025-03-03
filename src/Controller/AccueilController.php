<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController {

    #[Route(path: "/calcul/{nbr1}/{nbr2}", name:"app_accueil_calcul")]
    public function calcul(mixed $nbr1, mixed $nbr2):Response { //"mixed" comme any
        if($nbr1 < 0 || $nbr2 < 0){
            return new Response("Les nombres sont négatif");
        } else {
            $result = $nbr1 + $nbr2; 
            return new Response("L’addition de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $result);
        }
    }
      
}

