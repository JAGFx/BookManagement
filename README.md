# BookManagement

## The objective 

The goal is to practice the Symfony framework. So I create a library simulation. Each user can borrow a book. There is an admin area where we can manage the books and the users.

## Description
The idea is to simulate a library.
Thus, everyone can register and borrow a book (then return it).

Each user has a space where he/she can see his/her borrowed books.

Note that a book cannot be borrowed by several users.

There is a back office to manage the books:
- add, modify and delete
- force a book to be borrowed or returned by a user

and also for users:
- add, modify and delete

I also created an API, which is not secured for the moment.
Thanks to this API, you can also perform CRUD tasks.



## Entities
So there are three entities:

1) The books
Each book has an ID, a title, a category ID, a boolean to know if it is borrowed or not, and the id of the borrower (if there is one).

2) The categories
Each category has an ID, a title and a collection of books.
Note that a category can have several books, but a book can only have one user.

3) Users
Each user has an ID, a name, a password, and a collection of books.
Each user can have several books, but a book can only have one user.


## How does it work?
### First Page
The arrival on the site is a page with two buttons: Connection and registration.
![](pictures_Github/firstpage.png)


### Connected
Once connected, we arrive on a page.

Two buttons: View your books, and view all books.

Note the menu where we can navigate :
- all books
- my books
- logout

![](pictures_Github/connected.png)

### My Books
On this page, we visualize all our borrowed books.
You can also click on "see more" to display the page of a book.

![](pictures_Github/yourbooks.png)

### Book Page
On this page, you can see the information of the book.
If it is borrowed and you are the borrower, you can return it.
If it is free, you can borrow it.

![](pictures_Github/bookPage.png)

### All Books
On this page, you can see the information about each book, and you can click on "see more" to display the book page.
![](pictures_Github/allbooks.png)

## Technologies used
To build this application, I used Symfony and Bootstrap.
I also added an api via api platform.

## What I learned from it ?

I applied Symfony, with more specifically the understanding of an entity, a controller, and the Doctrine ORM.
I also learned how to create a Back Office via EasyAdmin, and API Platform.

Nevertheless, for my next projects, I plan to secure the access to the API and publish the application.
