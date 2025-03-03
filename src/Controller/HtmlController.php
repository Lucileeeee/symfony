<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HtmlController extends AbstractController
{
    #[Route('/html', name: 'app_html')]
    public function index(): Response
    {
        return $this->render('html/index.html.twig', [
            'controller_name' => 'HtmlController',
        ]);
    }
}
