<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookManagementController extends AbstractController
{

    #[Route("/", name: 'home')]
    public function home() {
        return $this->render('index.html.twig');
    }

    #[Route("/connected", name: 'homeConnected')]
    public function index() {
        return $this->render('book_management/index.html.twig');
    }

    #[Route("/profile/{id}", name: 'userProfil')]
    public function renderHome(EntityManagerInterface $manager) {
        // display all the books borrowed
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $userId = $user->getId();


         $books = $user->getBooks();

       

        return $this->render('book_management/showUser.html.twig', [
            'books' => $books,
        ]);


    }

    
    

}
