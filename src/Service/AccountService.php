<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Account;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManager;

final class AccountService {
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly AccountRepository $accountRepository)
    {}
    public function save(Account $account){
        if($account->getFirstname() != "" && $account->getLastname() != "" && $account->getEmail() != "" && $account->getPassword() != ""){
            if(!$this->accountRepository->findOneBy(['email'=> $account->getEmail()])){
                $account->setRoles("ROLES_USER");
                $this->em->persist($account);
                $this->em->flush();
            }
            else {
                throw new \Exception("Le compte existe déjà", 400);
            }
        }
        else {
            throw new \Exception("Les champs ne sont pas remplis", 400);

        }
    }
    public function getAll()/* :List <Account> */{
            if($this->accountRepository->findAll()){
                return $this->accountRepository->findAll();
            }
            else {
                throw new \Exception("Problemos, aucun comptes trouvés", 400);
            }//regarder depot de Mathieu avec un affichag conditionnel dans la vue
    }

    public function getById(int $id):Account{
            if($account = $this->accountRepository->find($id)){
                return $account ;
            }
            else {
                throw new \Exception("aucun compte trouvé", 400);
            }
    }
}


