<?php

namespace App\Form;

use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\CategoryRepository;
use App\Repository\ArticleRepository;
use App\Repository\AccountRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('lastname', TextType::class,
             ['label'=> 'Nom de Famille'],
             ['attr'=>['placeholder'=>'saisir votre nom de famille']])
            ->add('firstname', TextType::class,
                 ['label'=> 'Prénom' ],
                 ['attr'=>['placeholder'=>'saisir votre prénom']])
            ->add('email', EmailType::class,
                    ['label'=> 'Email' ],
                    ['attr'=>['placeholder'=>'saisir votre email']])
            ->add('password', PasswordType::class, 
                [ 'hash_property_path' => 'password',
                   'label'=> 'Mot De Passe'],
                ['attr'=>['placeholder'=>'saisir un mot de passe']])
            //todo verif d'email avec un deuxieme input
            ->add('save', SubmitType::class,
                 ['label'=> "S'inscrire"])
            
            //todo editer accountController avec une function qui retourne une nouvelle vue dans template et importer ce fichier dans le controller
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Account::class,
        ]);
    }

    
}
