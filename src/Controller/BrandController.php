<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Form\BrandTypeFormType;
use App\Repository\BrandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BrandController extends AbstractController
{
    #[Route('/brand', name: 'app_brand')]
    public function index(BrandRepository $repo): Response
    {
        $brands = $repo->findAll();
        return $this->render('brand/index.html.twig', [
            'controller_name' => 'BrandController',
            'brands' => $brands,
        ]);
    }

    #[Route('/brand/new', name:'app_brand_new')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $brand = new Brand();
        $form = $this->createForm(BrandTypeFormType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imgFile = $form->get('imgBrand')->getData();
            if ($imgFile) {
                $newFilename = uniqid().'.'.$imgFile->guessExtension();
                $imgFile->move(
                    $this->getParameter('kernel.project_dir').'/public/img/brands',
                    $newFilename
                );
                $brand->setImgBrand($newFilename);
            } else {
                // Si le champ est obligatoire, tu peux lever une erreur ou mettre une image par défaut
                $brand->setImgBrand('default.png');
            }
            $entityManager->persist($brand);
            $entityManager->flush();
            $this->addFlash('success','La marque a bien été ajoutée');
            return $this->redirectToRoute('app_brand');
        }

        return $this->render('brand/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/brand/update/{id}', name:'app_brand_update')]
    public function update(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $brand = $entityManager->getRepository(Brand::class)->find($id);
        if (!$brand) {
            throw $this->createNotFoundException('Brand not found');
        }

        $form = $this->createForm(BrandTypeFormType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success','La marque a bien été mise à jour');
            return $this->redirectToRoute('app_brand');
        }

        return $this->render('brand/edit.html.twig', [
            'controller_name' => 'BrandController',
            'brand_form' => $form->createView(),
        ]);
    }

    #[Route('/brand/{id}/delete', name:'app_brand_delete')]
    public function delete(EntityManagerInterface $em, Request $request, Brand $brand, int $id): Response
    {
        $em->remove($brand);
        $em->flush();
        $this->addFlash('success','La marque a bien été supprimée');

        return $this->redirectToRoute('app_brand');
    }

    #[Route('/brand/{id}', name: 'app_brand_show')]
    public function show(BrandRepository $repo, int $id): Response
    {
        $brand = $repo->find($id);
        if (!$brand) {
            throw $this->createNotFoundException('Brand not found');
        }

        return $this->render('brand/show.html.twig', [
            'brand' => $brand,
        ]);
    }
}
