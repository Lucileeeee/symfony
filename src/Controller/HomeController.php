<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{
    #[Route(path: "/hello/{nom}", name:"app_home_hello")]
    public function hello($nom):Response {
        return new Response('Bonjour ' . $nom);
    }

    #[Route(path: "/indexBis", name:"indexBis")]
    public function c(): Response       
    {
        return $this->render('html/indexBis.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}


