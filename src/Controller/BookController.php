<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;


class BookController extends AbstractController
{
    //Home page of Book, to render all the books
    #[Route('/book', name: 'app_book')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $books = $doctrine->getRepository(Book::class)->findAll();
        

        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'books' => $books,
        ]);
    }

    


}
