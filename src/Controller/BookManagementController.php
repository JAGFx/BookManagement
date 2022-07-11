<?php

namespace App\Controller;

use App\Entity\User;
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

    #[Route("/BookManagement", name: 'homeConnected')]
    public function renderHome() {
        return $this->render('book_management/index.html.twig');
    }

}
