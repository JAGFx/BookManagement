<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookManagementController extends AbstractController
{
    #[Route("/", name: 'home')]
    public function home() {
        return $this->render('index.html.twig', [
            'title' => "",
        ]);
    }
}
