<?php

namespace App\Controller;

use App\Entity\Account;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;


final class ApiUserController extends AbstractController
{
    public function __construct(
        private AccountRepository $accountRepository,
        private readonly EntityManagerInterface $em,
        private readonly SerializerInterface $serializer
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

    #[Route('/api/accountOne/', name: 'app_account_one', methods: ['POST'])]
    public function addAccount(Request $request): Response
    {
        $request = $request->getContent();
        $account = $this->serializer->deserialize($request, Account::class, 'json'); 
       /*  if (!$this->accountRepository->findOneBy(["email" => $account->getEmail()])) {
            var_dump($account); */
        if (!$this->accountRepository->findOneBy(["email" => $account->getEmail()])) {
            $this->em->persist($account);
            $this->em->flush();
            $code = 201;
        }
        else {
            $account = "Ce Compte existe déjà";
            $code = 400;
        }
        return $this->json($account, $code, [
            "Access-Control-Allow-Origin" => "*",
            "Content-Type" => "application/json"
        ], []);
    }
}

