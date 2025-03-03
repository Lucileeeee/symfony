<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController {

    #[Route(path: "/addition/{nbr1}/{nbr2}", name:"app_accueil_addition")]
    public function addition(mixed $nbr1, mixed $nbr2):Response { //"mixed" comme any
        if($nbr1 < 0 && $nbr2 < 0){
            return new Response("Les nombres sont négatif");
        } else {
            $result = $nbr1 + $nbr2; 
            return new Response("L’addition de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $result);
        }
    }

//todo
    #[Route(path: "/calculatrice/{nbr1}/{nbr2}/{operateur}", name:"app_accueil_calculatrice")]
    public function calculatrice(int $nbr1, int $nbr2, string $operateur):Response { 
       if(is_numeric($nbr1) == true && is_numeric($nbr2) == true ){
            switch ($operateur){
                case  "add": 
                    return new Response("L’addition de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 + $nbr2);
                case  "sous": 
                    return new Response("La soustraction de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 - $nbr2);
                case "multi":
                    return new Response("La multiplication de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 * $nbr2);
                case "div":
                    if($nbr2 != 0){
                        return new Response("La division de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 / $nbr2);
                    }  else {
                       return new Response("le deuxieme nombre ne doit pas tere Zero");
                    } 
                default:
                    return new Response("L'opérateur n'est pas correct");
               } 
       } else {
            return new Response("Veuillez rentrer des nombres please");
        }
    }
      
}






/* #[Route(path: "/calculatrice/{nbr1}/{nbr2}/{operateur}", name:"app_accueil_calculatrice")]
public function calculatrice(mixed $nbr1, mixed $nbr2, string $operateur):Response { //si int ça se lance pas
    if(gettype($nbr1) == "integer" && gettype($nbr2) == "integer"){
       
        switch ($operateur){
            case  "add": 
                return new Response("L’addition de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 + $nbr2);
            case  "sous": 
                return new Response("La soustraction de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 - $nbr2);
            case "multi":
                return new Response("La multiplication de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 * $nbr2);
            case "div":
                if($nbr2 !=0){
                    return new Response("La division de ". $nbr1 . " et de " . $nbr2 . " est égale au résultat : " . $nbr1 / $nbr2);
                } /* else {
                    return new Response("le deuxieme nombre ne doit pas tere Zero");
                } //
            default:
                return new Response("L'opérateur n'est pas correct");
    
           }
    } else {
        return new Response(gettype($nbr1),  gettype($nbr2));
       // return new Response("Veuillez rentrer des nombres please");
    }
} */
  