<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AccountRepository;

class UserController extends AbstractController{
    public function __construct(private readonly AccountRepository $accountRepository){}

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
    #[Route('/accounts', name: 'app_user_account')]
    public function showAllAccount(): Response
    {
        return $this->render('user/accounts.html.twig', [
            'accounts' => $this->accountRepository->findAll(),
        ]);
    }
}
