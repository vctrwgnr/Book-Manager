<?php

namespace App\Controller;

use App\Entity\Publisher;
use App\Form\PublisherType;
use App\Repository\PublisherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PublisherController extends AbstractController
{
    #[Route('/publisher', name: 'app_publisher')]
    public function index(PublisherRepository $publisherRepository): Response
    {
        $publishers = $publisherRepository->findAll();
        return $this->render('publisher/index.html.twig', [
            'publishers' => $publishers,
        ]);
    }

    #[Route('/publisher/show/{id}', name: 'app_publisher_show')]
    public function show($id, Publisher $publisher): Response
    {
        return $this->render('publisher/show.html.twig', [
            'publisher' => $publisher,
        ]);
    }
    #[Route('/publisher/delete/{id}', name: 'app_publisher_delete')]
    public function delete($id, EntityManagerInterface $entityManager, Publisher $publisher, Request $request): Response
    {
        $entityManager->remove($publisher);
        $entityManager->flush();
        return $this->redirect($this->generateUrl('app_publisher'));
    }

    #[Route('/publisher/edit/{id}', name: 'app_publisher_edit')]
    public function edit($id, EntityManagerInterface $entityManager, Publisher $publisher, Request $request): Response
    {
        $form = $this->createForm(PublisherType::class, $publisher);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($publisher);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('app_publisher'));

        }


        return $this->render('publisher/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/publisher/new', name: 'app_publisher_new')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $publisher = new Publisher();
        $form = $this->createForm(PublisherType::class, $publisher);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($publisher);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('app_publisher'));

        }

        return $this->render('publisher/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
