<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AccountRepository;
use App\Form\AccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Account;


class UserController extends AbstractController{
    public function __construct(private readonly AccountRepository $accountRepository,
    private readonly EntityManagerInterface $em){}

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

    //todo
    #[Route('/user/add', name: 'app_user_add')]
    public function addOneUser(Request $request): Response
    {
        $user = new Account();
        $form = $this->createForm(AccountType::class, $user);
        $form->handleRequest($request);
        $msg ="";
        $status ="";
        if($form->isSubmitted()){
            try{
                $user->setRoles("ROLE_USER");
                $this->em->persist($user);
                $this->em->flush();
                $msg= "Toudo Buene";
                $status="succes";
            }catch (\Exception $e){
               $msg= "erreur";
               $status="danger";
            }
           
        }
        $this->addFlash($status, $msg);
        return $this->render('user/addUser.html.twig',
             ['form'=>$form]);
    }
    
}
