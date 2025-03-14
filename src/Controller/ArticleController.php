<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArticleRepository;


final class ArticleController extends AbstractController
{
    public function __construct(private readonly ArticleRepository $articleRepository){
    }
    
    #[Route('/articles', name: 'app_article_all')]
    public function showAllArticles(): Response
    {
        return $this->render('article/showAllArticles.html.twig', [
            'articles' => $this->articleRepository->findAll(),
        ]);
    }

    #[Route('/article/{id}', name: 'app_article_one')]
    public function showArticle(int $id): Response
    {
        return $this->render('article/showArticle.html.twig', [
            'article' => $this->articleRepository->find($id),
        ]);
    }

}
