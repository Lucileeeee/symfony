<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController{
    #[Route(path: "/register", name:"app_home_user")]
    public function register():Response {
        return $this->render('html/registerUser.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route(path: "/connexion", name:"app_home_connexion")]
    public function connexion():Response {
        return $this->render('html/connexionUser.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
