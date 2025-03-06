<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\AccountRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

final class ApiArticleController extends AbstractController
{
    public function __construct(
        private ArticleRepository $articleRepository,
        private readonly SerializerInterface $serializer,
        private AccountRepository $accountRepository,
        private CategoryRepository $catRepository,
        private readonly EntityManagerInterface $em,
    ) {}

    #[Route('/api/articles', name: 'api_articles_all')]
    public function getAllArticles(): Response
    {
        return $this->json(
            $this->articleRepository->findAll(),
            200,
            [],
            ['groups' => 'article:read'],
        );
    }

    #[Route('/api/article/{id}', name: 'api_article_one')]
    public function getArticleById(int $id): Response {
        $article = $this->articleRepository->find($id);
        $code = 200;
        if(!$article){
            $article = "L'article n'existe pas";
            $code = 404;
        }
        return $this->json(
            $article,
            $code ,
            [   "Access-Control-Allow-Origin" => "*",
                 "Content-Type" => "application/json"
                ],
            ['groups' => 'article:read'],
        );
    }

    //todo
    #[Route('/api/articleOne/', name: 'app_addArticle_one', methods: ['POST'])]
    public function addArticle(Request $request): Response
    {
        $request = $request->getContent();
        $article = $this->serializer->deserialize($request, Article::class, 'json'); 
      
        if($article->getTitle() && $article->getContent() && $article->getCreateAt() && $article->getAuthor()){
            $article->getAuthor()->getEmail()
            if (!$this->articleRepository->findOneBy(["title" => $article->getTitle()] , ["content" => $article->getContent()])) {
                $this->em->persist($article);
                $this->em->flush();
                $code = 201;
            } 
            else {
                $article = "Cet Article existe déjà";
                 $code = 400;
            }
        }
        else {
            $article = "Tous les champs ne sont pas renseignés";
        }
        return $this->json($article, $code, [
            "Access-Control-Allow-Origin" => "*",
            "Content-Type" => "application/json"
        ], ["groups" => 'article:read', 'article:create']);
    }
}

