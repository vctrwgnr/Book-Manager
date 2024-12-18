<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use App\Factory\AuthorFactory;
use App\Factory\BookFactory;
use App\Factory\PublisherFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

//        $book = new Book();
//        $book->setTitle("Book 1");
//        $book->setPages(140);
//        $book->setGenre("Action");
//        $book->setPublishedAt(new \DateTime('now'));
//        $book->setAuthor();
//
//        $manager->persist($book);
        // $product = new Product();
        // $manager->persist($product);



//        BookFactory::createOne();
        // $manager->persist($product);
//        BookFactory::createMany(100);


        $publisher = new Publisher();
        PublisherFactory::createMany(10);
        $manager->persist($publisher);
        $manager->flush();

        $author = new Author();
        AuthorFactory::createMany(10);
        $manager->persist($author);
        $manager->flush();

        $book = new Book();
        BookFactory::createMany(10);
        $manager->persist($book);
        $manager->flush();


    }
}
