<?php

namespace App\Controller\Product;

use App\Entity\Product\ProductDetail;
use App\Form\ProductForm\ProductDetailType;
use App\Repository\Product\ProductDetailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function user(ProductDetailRepository $productDetailRepository): Response
    {
        $userView = $productDetailRepository->findAll();

        return $this->render('user/user.html.twig', [
            'products' => $userView,
        ]);

    }

    #[Route('/admin', name: 'create&ReadProduct')]
    public function admin(Request $request, ProductDetailRepository $productDetailRepository, EntityManagerInterface $em): Response
    {
        $productView = $productDetailRepository->findAll();
        $createProduct = new ProductDetail();
        $form = $this->createForm(ProductDetailType::class, $createProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($createProduct);
            $em->flush();
            return $this->redirectToRoute('create&ReadProduct');
        }
        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
            'products' => $productView,
        ]);
    }

    #[Route('/editProduct/{id}', name: 'edit&ReadProduct')]
    public function edit(Request $request, ProductDetailRepository $productDetailRepository, EntityManagerInterface $em, $id): Response
    {
        $editProductView = $productDetailRepository->findAll();
        $edit = $productDetailRepository->find($id);
        $form = $this->createForm(ProductDetailType::class, $edit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($edit);
            $em->flush();
            return $this->redirectToRoute('create&ReadProduct');
        }
        return $this->render('admin/editRegisterForm.html.twig', [
            'form' => $form->createView(),
            'products' => $editProductView
        ]);
    }

    #[Route('/deleteProduct/{id}', name: 'deleteProduct')]
    public function delete(ProductDetailRepository $productDetailRepository, EntityManagerInterface $em, $id): Response
    {
        $delete = $productDetailRepository->find($id);
        $em->remove($delete);
        $em->flush();
        return $this->redirectToRoute('create&ReadProduct');
    }
}

