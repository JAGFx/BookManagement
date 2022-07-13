<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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

    // Show a book 
    #[Route("/book/{id}", name: 'book_show')]
    public function show(Book $book, EntityManagerInterface $manager , Request $request, $id){
        
        $repo = $manager->getRepository(Book::class);
        $book = $repo->find($id);

        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $userName = $user->getName();

        // we need to check that the user is the borrower
        $IdBorrower = $book->getUserId();
        if($IdBorrower == $userName){
            return $this->render('book/show.html.twig', [
                'book' => $book,
                'borrower' => true,
            ]);

        }
        else{
            return $this->render('book/show.html.twig', [
                'book' => $book,
                'borrower' => false,
                
            ]);
        }


        

    }

    // Display the borrow form
    #[Route("/book/borrow/{id}", name: 'borrow_book')]
    public function RenderBorrow(Book $book, EntityManagerInterface $manager, $id){
        
        $repo = $manager->getRepository(Book::class);
        $book = $repo->find($id);

        return $this->render('book/borrow.html.twig', [
            'book' => $book,
            
            
        ]);

    }
    // method to actually borrow the book, then redirect to the book page
    #[Route("/book/borrowed/{id}", name: 'book_borrowed')]
    public function borrow(Book $book, EntityManagerInterface $manager, $id){

        // if available, then the user can borrow it.
        if(!$book->isBorrowed()){
            // we get the user.

            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            
            $user->addBook($book);
           
            // the book borrow becomes borrowed.
            $book->setBorrowed(true);

        
            $manager->flush();


        }
        return $this->redirectToRoute('book_show', ['id' => $book->getId()]);

    }

    // Display the borrow form, only if the user is the borrower
    #[Route("/book/return/{id}", name: 'borrow_return')]
    public function RenderReturn(Book $book, EntityManagerInterface $manager, $id){
        
        $repo = $manager->getRepository(Book::class);
        $book = $repo->find($id);

        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $userName = $user->getName();

        // we need to check that the user is the borrower
        $IdBorrower = $book->getUserId();
        if($IdBorrower == $userName){

            return $this->render('book/return.html.twig', [
                'book' => $book,
                
                
            ]);

        }

        else{
            return $this->redirectToRoute('book_show', ['id' => $book->getId()]);
        }


       

    }
    // method to actually borrow the book, then redirect to the book page
    #[Route("/book/returned/{id}", name: 'book_returned')]
    public function return(Book $book, EntityManagerInterface $manager, $id){

        // if not available, then the user can return it.
        if($book->isBorrowed()){
            // we get the user.
            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            $userName = $user->getName();

            // we need to check that the user is the borrower
            $IdBorrower = $book->getUserId();
            if($IdBorrower == $userName){
                $user->removeBook($book);
           
                // the book borrow becomes unborrowed.
                $book->setBorrowed(false);
    
            
                $manager->flush();

            }
            

        }
        return $this->redirectToRoute('book_show', ['id' => $book->getId()]);

    }

   

    


}
