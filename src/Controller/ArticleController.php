<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArticleRepository;
//necessaire pour afficher dans la vue? 
use App\Repository\AccountRepository;
use App\Repository\CategoryRepository;

final class ArticleController extends AbstractController
{
    public function __construct(private readonly ArticleRepository $articleRepository){
    }
    
    #[Route('/article', name: 'app_article')]
    public function showAllArticles(): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $this->articleRepository->findAll(),
        ]);
    }
}
