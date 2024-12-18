<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(AuthorRepository $authorRepository): Response
    {
        $authors = $authorRepository->findAll();
        return $this->render('author/index.html.twig', [
            'authors' => $authors,
        ]);
    }

    #[Route('/author/new', name: 'app_author_new')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($author);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('app_author'));
        }


        return $this->render('author/new.html.twig', [
            'form' => $form->createView(),
            ]);
    }

    #[Route('/author/show/{id}', name: 'app_author_show')]
    public function show($id, Author $author): Response
    {
        return $this->render('author/show.html.twig', [
            'author' => $author,
        ]);
    }


    #[Route('/author/delete/{id}', name: 'app_author_delete')]
    public function delete($id, EntityManagerInterface $entityManager, Author $author, Request $request): Response
    {
        $entityManager->remove($author);
        $entityManager->flush();
        return $this->redirect($this->generateUrl('app_author'));
    }

    #[Route('/author/edit/{id}', name: 'app_author_edit')]
    public function edit($id, EntityManagerInterface $entityManager, Author $author, Request $request): Response
    {
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($author);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('app_author', ['id' => $author->getId()] ));
        }


        return $this->render('author/edit.html.twig', [
            'form' => $form->createView(),
        ]);


    }





}
