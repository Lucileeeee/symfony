<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoryRepository;
use App\Repository\ArticleRepository;
use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
//todo checker s'il manque des import



final class CategoryController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly EntityManagerInterface $em
        //todo..
        ){
    }

    #[Route('/category', name: 'app_category')]
    public function showAllCategories(): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $this->categoryRepository->findAll(),
        ]);
    }

    #[Route('/category/add', name: 'app_category_add')]
    public function addOneCategory(Request $request): Response
    {
        $cat = new Category();
        $form = $this->createForm(CategoryType::class, $cat);
        $form->handleRequest($request);
        $msg ="";
        $status ="";
        if($form->isSubmitted()){
            try{
                $this->em->persist($cat);
                $this->em->flush();
                $msg= "Toudo Buene";
                $status="succes";
            }catch (\Exception $e){
               $msg= "erreur";
               $status="danger";
            }
           
        }
        $this->addFlash($status, $msg);
        return $this->render('category/addCategory.html.twig',
             ['form'=>$form]);
    }
}
