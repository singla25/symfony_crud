<?php

namespace App\Controller;

use App\Entity\CRUD;
use App\Form\CRUDType;
use App\Repository\CRUDRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'read')]
    public function read(CRUDRepository $CRUDRepository): Response
    {
        $read = $CRUDRepository->findAll();

        return $this->render('pages/read.html.twig', [
            'crud' => $read,
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $create = new CRUD();
        $form = $this->createForm(CRUDType::class, $create);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($create);
            $em->flush();
            return $this->redirectToRoute('read');
        }
        return $this->render('pages/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Request $request, CRUDRepository $CRUDRepository, EntityManagerInterface $em, $id): Response
    {
        $edit = $CRUDRepository->find($id);
        $form = $this->createForm(CRUDType::class, $edit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($edit);
            $em->flush();
            return $this->redirectToRoute('read');
        }
        return $this->render('pages/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(CRUDRepository $CRUDRepository, EntityManagerInterface $em, $id): Response
    {
        $delete = $CRUDRepository->find($id);

        $em->remove($delete);
        $em->flush();

        return $this->redirectToRoute('read');
    }
}
