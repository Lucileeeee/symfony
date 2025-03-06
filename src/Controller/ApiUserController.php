<?php

namespace App\Controller;

use App\Entity\Account;
use App\Repository\AccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiUserController extends AbstractController
{
    public function __construct(
        private AccountRepository $accountRepository
    ) {}

    #[Route('/api/account', name: 'api_account_all')] 
    public function getAllUsers(): Response
    {
        return $this->json(
            $this->accountRepository->findAll(),
            200,
            ["Acces-Control-Allow-Origin" => '*'], //METTRE LE NOM DE DOMAINE DU FRONT
            ['groups' => 'account:read']
        );
    }
}

