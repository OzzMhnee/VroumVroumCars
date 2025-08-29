<?php

namespace App\Controller;

use App\Form\CarsTypeFormType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarsController extends AbstractController
{
    #[Route('/cars', name: 'app_car')]
    public function index(CarRepository $repo): Response
    {
        $cars = $repo->findAll();

        return $this->render('cars/index.html.twig', [
            'controller_name' => 'CarsController',
            'cars' => $cars,
        ]);
    }

    #[Route('/cars/new', name : 'app_car_new')]
    public function addCar(Request $request, EntityManagerInterface $em): Response
    {
        $car = new Car();
        $form = $this->createForm(CarsTypeFormType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imgFile = $form->get('imgCar')->getData();
            if ($imgFile) {
                $newFilename = uniqid().'.'.$imgFile->guessExtension();
                $imgFile->move(
                    $this->getParameter('kernel.project_dir').'/public/img/cars',
                    $newFilename
                );
                $car->setImgCar($newFilename);
            } else {
                $car->setImgCar('default.png');
            }
            $em->persist($car);
            $em->flush();
            $this->addFlash('success', 'La voiture a été ajoutée avec succès.');
            return $this->redirectToRoute('app_car');
        }

        return $this->render('cars/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/cars/update/{id}', name : 'app_car_update')]
    public function updateCar(Request $request, EntityManagerInterface $em, Car $car): Response
    {
        $form = $this->createForm(CarsTypeFormType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imgFile = $form->get('imgCar')->getData();
            if ($imgFile) {
                $newFilename = uniqid().'.'.$imgFile->guessExtension();
                $imgFile->move(
                    $this->getParameter('kernel.project_dir').'/public/img/cars',
                    $newFilename
                );
                $car->setImgCar($newFilename);
            }
            $em->flush();
            $this->addFlash('success', 'La voiture a été mise à jour avec succès.');
            return $this->redirectToRoute('app_car');
        }

        return $this->render('cars/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/cars/{id}/delete', name : 'app_car_delete')]
    public function deleteCar(EntityManagerInterface $em, Car $car): Response
    {
        $em->remove($car);
        $em->flush();
        $this->addFlash('success', 'La voiture a été supprimée avec succès.');
        return $this->redirectToRoute('app_car');
    }

    #[Route('/cars/{id}', name : 'app_car_show')]
    public function showCar(int $id, CarRepository $repo): Response
    {
        $car = $repo->find($id);
        if (!$car) {
            throw $this->createNotFoundException('Car not found');
        }
        return $this->render('cars/show.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('/All/Cars', name: 'app_car_all')]
    public function showAllCars(CarRepository $repo): Response
    {
        $cars = $repo->findAll();
        return $this->render('brand/showAllchildren.html.twig', [
            'cars' => $cars,
        ]);
    }
}
