<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController {
    #[Route(path: "/hello/{nom}", name:"app_home_hello")]
    public function hello($nom):Response {
        return new Response('Bonjour ' . $nom);
    }
}


