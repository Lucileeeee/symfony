<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AccountRepository;
use App\Form\AccountType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Account;
use App\Service\AccountService;

class UserController extends AbstractController{
    public function __construct(
        private readonly AccountRepository $accountRepository,
        private readonly AccountService $accountService){}

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
            'accounts' => $this->accountService->getAll()  
        ]);
    }

    #[Route('/user/add', name: 'app_user_add')]
    public function addOneUser(Request $request): Response
    {
        $user = new Account();
        $form = $this->createForm(AccountType::class, $user);
        $form->handleRequest($request);
        $msg ="";
        $status ="";
        if($form->isSubmitted() && $form->isValid()) {
           try{ 
                $this->accountService->save($user);
                $status = "succes";
                $msg = "Utilisateur bien enregistré";
           }catch (\Exception $e){
                $status = "danger";
                $msg = $e->getMessage();
           } 
           $this->addFlash($status, $msg);
        }
        return $this->render('user/addUser.html.twig',
             ['formUser'=>$form]);//même nom de variable qu'on va utiliser dans la vue
    }
}

