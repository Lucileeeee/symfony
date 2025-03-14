<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CalculatriceController extends AbstractController
{
    #[Route(path: "/calculatrix/{nbr1}/{nbr2}/{operateur}", name:"app_calculatrix")]
    public function calculatrix(mixed $nbr1, mixed $nbr2, string $operateur):Response{ //si int ça se lance pas
       if(is_numeric($nbr1) && is_numeric($nbr2) ){
        $resultat ="jambon";
            switch ($operateur){
                case  "add": 
                    $resultat = "L’addition de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 + $nbr2;
                    break;
                case  "sous": 
                     $resultat = "La soustraction de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 - $nbr2;
                     break;
                case "multi":
                     $resultat = "La multiplication de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 * $nbr2;
                     break;
                case "div":
                    if($nbr2 != 0){
                         $resultat = "La division de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 / $nbr2;
                    }  else {
                        $resultat = "le deuxieme nombre ne doit pas tere Zero";
                    } 
                    break;
                default:
                    $resultat = "L'opérateur n'est pas correct";
               } 
       } else {
           $resultat = "Veuillez rentrer des nombres please";
        }
        return new Response (
            $this->render('calculatrix/index.html.twig', [
            'nbr1' => $nbr1,
            'nbr2' => $nbr2,
            'operateur' => $operateur,
            'resultat' => $resultat
            ])
        );
    }
}
